<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialsController extends Controller
{
    // Show all testimonials
    public function index()
    {
        $testimonials = Testimonial::orderBy('id', 'desc')->get();
        return view('pages.admin-side.Testimonials.index', compact('testimonials'));
    }

    // Show create form
    public function create()
    {
        return view('pages.admin-side.Testimonials.create');
    }

    // Store new testimonial
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'review'   => 'required|string',
            'design'   => 'nullable|string|max:255',
            'company'  => 'nullable|string|max:255',
            'rating'   => 'required|integer|min:1|max:5',
            'status'   => 'required|boolean',
            'image'    => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $data = $request->only(['name', 'review', 'design', 'company', 'rating', 'status']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('pages.admin-side.testimonials.edit', compact('testimonial'));
    }

    // Update testimonial
    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'review'   => 'required|string',
            'design'   => 'nullable|string|max:255',
            'company'  => 'nullable|string|max:255',
            'rating'   => 'required|integer|min:1|max:5',
            'status'   => 'required|boolean',
            'image'    => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $data = $request->only(['name', 'review', 'design', 'company', 'rating', 'status']);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    // Delete testimonial
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
            Storage::disk('public')->delete($testimonial->image);
        }

        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }
}
