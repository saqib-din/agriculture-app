<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    // Show all pages
    public function index()
    {
        $pages = Page::latest()->get();
        return view('pages.admin-side.pages.index', compact('pages'));
    }

    // Show create/edit form
    public function createOrUpdate($id = null)
    {
        $page = $id ? Page::findOrFail($id) : null;
        return view('pages.admin-side.pages.createorupdate', compact('page'));
    }

    // Save (create or update)
    public function save(Request $request, $id = null)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $id,
            'content' => 'required',
            'status' => 'required|in:Active,Inactive',
            'display_in_footer' => 'required|in:yes,no'
        ]);

        // Auto-generate slug if empty
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($id) {
            $page = Page::findOrFail($id);
            $page->update($validated);
            $message = 'Page updated successfully!';
        } else {
            Page::create($validated);
            $message = 'Page created successfully!';
        }

        return redirect()->route('pages.index')->with('success', $message);
    }

    // Delete page
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect()->route('pages.index')->with('success', 'Page deleted successfully!');
    }

    // Show single page by slug (for frontend)
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->where('status', 'Active')->firstOrFail();
        return view('pages.landing.index', compact('page'));
    }
}
