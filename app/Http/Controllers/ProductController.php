<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Variable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

        return view('pages.products.product-list', compact('products', 'variables', 'categories'));
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
        $categories = Category::all();
        return view('pages.admin-side.products.createorupdate', compact('categories'));
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'specifications', 'category']);
        $categories = Category::all();
        return view('pages.admin-side.products.createorupdate', compact('product', 'categories'));
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        $product = $id ? Product::findOrFail($id) : null;
        $isUpdate = $product !== null;

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
        $sku = $product?->sku;
        if (!$isUpdate) {
            do {
                $sku = 'SKU-' . strtoupper(Str::random(8)) . time();
            } while (Product::where('sku', $sku)->exists());
        }

        // Generate / sanitize slug
        $slug = $request->slug;
        if (empty($slug)) {
            $slug = Str::slug($request->name);
        } else {
            $slug = Str::slug($slug);
        }

        // Ensure unique slug
        $originalSlug = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->where('id', '!=', $product?->id)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Create or update product
        if ($isUpdate) {
            $product->update([
                'name' => $request->name,
                'slug' => $slug,
                'category_id' => $request->category_id,
                'model' => $request->model,
                'brand' => $request->brand,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'brief_details' => $request->brief_details,
                'description' => $request->description,
                'status' => $request->status ?? 1,
            ]);
        } else {
            $product = Product::create([
                'name' => $request->name,
                'slug' => $slug,
                'sku' => $sku,
                'category_id' => $request->category_id,
                'model' => $request->model,
                'brand' => $request->brand,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'brief_details' => $request->brief_details,
                'description' => $request->description,
                'status' => $request->status ?? 1,
            ]);
        }

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('products', 'public');
                $product->images()->create([
                    'image' => $imagePath,
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

        $msg = $isUpdate ? 'Product Updated Successfully' : 'Product Added Successfully';
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
        $request->validate(['type' => 'required|in:hide,availability,full']);
        $product->update(['quantity_display' => $request->type]);

        return response()->json([
            'ok' => true,
            'message' => 'Quantity display updated',
            'new_value' => $request->type
        ]);
    }

    public function updatePriceDisplay(Request $request, Product $product)
    {
        $request->validate(['type' => 'required|in:hide,price,call']);
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
        try {
            // Delete all images from storage
            foreach ($product->images as $image) {
                if (Storage::disk('public')->exists($image->image)) {
                    Storage::disk('public')->delete($image->image);
                }
                $image->delete();
            }

            // Delete specifications
            $product->specifications()->delete();

            // Delete product
            $product->delete();

            return redirect()->back()->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }

    public function imageDestroy($id)
    {
        try {
            $image = ProductImage::findOrFail($id);

            // Delete image file from storage
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }

            // Delete image record
            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting image: ' . $e->getMessage()
            ], 500);
        }
    }
}
