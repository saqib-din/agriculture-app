<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->latest()->get();
        return view('pages.admin-side.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('index')->with('success', 'Category created successfully');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:30|unique:categories,name,' . $id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        // Check if category is used in products
        if ($category->products()->exists()) {
            return redirect()->back()
                ->with('info', 'This category cannot be deleted because it is linked to products. Delete the products first, then you can delete this category..');
        }

        // Safe to delete
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
