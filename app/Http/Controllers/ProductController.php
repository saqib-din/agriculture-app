<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
// use App\Models\ProductSpecification;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Variable;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function list()
    {
        $variables = Variable::all();

        $categories = Category::withCount('products')->get();

        $products = Product::where('status', 1)
            ->with(['images', 'category'])
            ->latest()
            ->paginate(9);

        return view('pages.products.product-list', compact(
            'products',
            'variables',
            'categories'
        ));
    }

    public function showBySlug($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->with(['images', 'category', 'specifications'])
            ->firstOrFail();

        $variables = Variable::all();

        return view('pages.products.single-product', compact('product', 'variables'));
    }

    public function create()
    {
        $product = null;
        $categories = Category::all();

        return view('pages.admin-side.products.createorupdate', compact('product', 'categories'));
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'specifications', 'category']);
        $categories = Category::all();

        return view('pages.admin-side.products.createorupdate', compact('product', 'categories'));
    }

    public function storeOrUpdate(Request $request, Product $product = null)
    {
        $isUpdate = $product && $product->exists;

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . ($product->id ?? 'NULL'),
            'category_id' => 'nullable|exists:categories,id',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'brief_details' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'specifications.*.name' => 'nullable|string|max:255',
            'specifications.*.value' => 'nullable|string',
        ]);

        // Generate SKU only on create
        if (!$product) {
            do {
                $sku = 'SKU-' . strtoupper(Str::random(4));
            } while (Product::where('sku', $sku)->exists());
        }

        // Generate / sanitize slug
        $slug = $request->slug;
        if (empty($slug)) {
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $count = 1;
            while (
                Product::where('slug', $slug)
                ->where('id', '!=', $product?->id)
                ->exists()
            ) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
        } else {
            $slug = Str::slug($slug);
        }

        // Create or update product
        $product = Product::updateOrCreate(
            ['id' => $product?->id],
            [
                'name' => $request->name,
                'slug' => $slug,
                'sku' => $product?->sku ?? $sku,
                'category_id' => $request->category_id,
                'model' => $request->model,
                'brand' => $request->brand,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'brief_details' => $request->brief_details,
                'description' => $request->description,
                'status' => $request->status ?? 1,
            ]
        );

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->images()->create([
                    'image' => $image->store('products', 'public'),
                ]);
            }
        }

        // Handle specifications
        if ($request->has('specifications')) {
            // Delete old specifications if updating
            if ($isUpdate) {
                $product->specifications()->delete();
            }

            // Add new specifications
            foreach ($request->specifications as $index => $spec) {
                if (!empty($spec['name']) && !empty($spec['value'])) {
                    $product->specifications()->create([
                        'name' => $spec['name'],
                        'value' => $spec['value'],
                        'order' => $index,
                    ]);
                }
            }
        }

        $msg = $isUpdate
            ? 'Product Updated Successfully'
            : 'Product Added Successfully';

        return redirect()->route('products.list')->with('success', $msg);
    }

    public function index()
    {
        $products = Product::with(['images', 'category'])->latest()->get();
        return view('pages.admin-side.products.index', compact('products'));
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'ids' => 'required|string',
            'quantity_display' => 'nullable|in:hide,availability,full',
            'price_display' => 'nullable|in:hide,price,call',
            'status' => 'nullable|in:0,1',
        ]);

        $ids = explode(',', $request->ids);
        $updateData = [];

        if ($request->filled('quantity_display')) {
            $updateData['quantity_display'] = $request->quantity_display;
        }

        if ($request->filled('price_display')) {
            $updateData['price_display'] = $request->price_display;
        }

        if ($request->filled('status')) {
            $updateData['status'] = $request->status;
        }

        if (!empty($updateData)) {
            Product::whereIn('id', $ids)->update($updateData);
        }

        return response()->json([
            'success' => true,
            'message' => 'Products updated successfully',
            'updated_count' => count($ids)
        ]);
    }

    public function updateQuantityDisplay(Request $request, Product $product)
    {
        $request->validate([
            'type' => 'required|in:hide,availability,full'
        ]);

        $product->update(['quantity_display' => $request->type]);

        return response()->json([
            'ok' => true,
            'message' => 'Quantity display updated',
            'new_value' => $request->type
        ]);
    }

    public function updatePriceDisplay(Request $request, Product $product)
    {
        $request->validate([
            'type' => 'required|in:hide,price,call'
        ]);

        $product->update(['price_display' => $request->type]);

        return response()->json([
            'ok' => true,
            'message' => 'Price display updated',
            'new_value' => $request->type
        ]);
    }

    public function updateStatus(Product $product)
    {
        $newStatus = !$product->status;
        $product->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'message' => 'Status updated successfully'
        ]);
    }

    public function destroy(Product $product)
    {
        // Delete all images
        foreach ($product->images as $image) {
            if (file_exists(storage_path('app/public/' . $image->image))) {
                unlink(storage_path('app/public/' . $image->image));
            }
        }

        // Delete specifications
        $product->specifications()->delete();

        // Delete product
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function imageDestroy(ProductImage $image)
    {
        if (file_exists(storage_path('app/public/' . $image->image))) {
            unlink(storage_path('app/public/' . $image->image));
        }

        $image->delete();

        return back()->with('success', 'Image deleted successfully');
    }
}
