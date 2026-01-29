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
    public function list(Request $request)
    {
        $variables = Variable::all();
        $categories = Category::withCount('products')->get();

        // Popular products (sidebar)
        $popularProducts = Product::where('status', 1)
            ->whereHas('quoteRequests', function ($q) {
                $q->whereDate('quote_requests.created_at', '>=', now()->subDays(30));
            })
            ->withCount(['quoteRequests' => function ($q) {
                $q->whereDate('quote_requests.created_at', '>=', now()->subDays(30));
            }])
            ->orderBy('quote_requests_count', 'desc')
            ->take(3)
            ->get();

        // Main products query
        $query = Product::where('status', 1)
            ->with(['images', 'category']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    // ->orWhere('description', 'LIKE', "%{$search}%")
                    // ->orWhere('brief_details', 'LIKE', "%{$search}%")
                    // ->orWhere('brand', 'LIKE', "%{$search}%")
                    // ->orWhere('model', 'LIKE', "%{$search}%")
                    ->orWhere('sku', 'LIKE', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Sorting
        $sort = $request->get('sort', 'recent');
        switch ($sort) {
            case 'popular':
                $query->withCount('quoteRequests')
                    ->orderBy('quote_requests_count', 'desc');
                break;

            // case 'price_low':
            //     $query->orderBy('price', 'asc');
            //     break;

            // case 'price_high':
            //     $query->orderBy('price', 'desc');
            //     break;

            // case 'name_asc':
            //     $query->orderBy('name', 'asc');
            //     break;

            // case 'name_desc':
            //     $query->orderBy('name', 'desc');
            //     break;

            default:
                $query->latest();
        }

        $products = $query->paginate(9);

        // logger($products);

        // AJAX response
        if ($request->ajax()) {
            $productsHtml = view('pages.products.partials.product-grid', compact('products'))->render();
            $paginationHtml = view('pages.products.partials.pagination', compact('products'))->render();

            return response()->json([
                'success' => true,
                'html' => $productsHtml,
                'pagination' => $paginationHtml
            ]);
        }

        return view('pages.products.product-list', compact(
            'products',
            'variables',
            'categories',
            'popularProducts'
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
                $sku = strtoupper(Str::random(4));
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
        if ($isUpdate) {
            // Always delete old specs first
            $product->specifications()->delete();
        }

        if ($request->has('specifications')) {
            foreach ($request->specifications as $index => $spec) {
                // Create spec even if name or value is empty (nullable)
                if (!is_null($spec['name']) || !is_null($spec['value'])) {
                    $product->specifications()->create([
                        'name' => $spec['name'] ?? null,
                        'value' => $spec['value'] ?? null,
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
            'type' => $request->type,
            'new_quantity' => $product->quantity
        ]);
    }

    public function updatePriceDisplay(Request $request, Product $product)
    {
        $request->validate(['type' => 'required|in:hide,price,call']);
        $product->update(['price_display' => $request->type]);

        return response()->json([
            'ok' => true,
            'message' => 'Price display updated',
            'type' => $request->type,
            'new_price' => $product->price
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

            if ($product->category) {
                return redirect()->back()->with('error', 'Cannot delete product: it is linked to a category.');
            }

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
