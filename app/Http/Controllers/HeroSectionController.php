<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSection;
use App\Models\Faq;
use App\Models\Testimonial;


class HeroSectionController extends Controller
{
  
    public function index()
    {
        // Get all hero sections from DB
        $heroSections = HeroSection::all();
        $faqs = Faq::all(); // or Faq::where('status', 1)->get() for active only
        $testimonials = Testimonial::where('status', 1)->get(); // only active testimonials

        return view('pages.landing.index', compact('heroSections', 'faqs', 'testimonials'));
    }



    // Combined create/update form
    public function form($id = null)
    {
        $hero = $id ? HeroSection::findOrFail($id) : null; // null for Add, existing record for Edit
        return view('pages.admin-side.hero-section.createorupdate', compact('hero'));
    }

    public function save(Request $request, $id = null)
    {
        $hero = $id ? HeroSection::findOrFail($id) : new HeroSection();

        $request->validate([
            'hero_title'    => 'required|string|max:255',
            'status'        => 'required',
            'image'         => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // delete old image if updating
            if ($id && $hero->image && file_exists(public_path('uploads/hero/' . $hero->image))) {
                unlink(public_path('uploads/hero/' . $hero->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/hero'), $imageName);
            $hero->image = $imageName;
        }

        $hero->hero_title    = $request->hero_title;
        $hero->hero_subtitle = $request->hero_subtitle;
        $hero->description   = $request->description;
        $hero->status        = $request->status;
        $hero->save();

        $message = $id ? 'Hero Section Updated Successfully' : 'Hero Section Added Successfully';
        return redirect()->route('hero-section.index')->with('success', $message);
    }

    public function destroy($id)
    {
        $hero = HeroSection::findOrFail($id);

        // Delete image from server if exists
        if ($hero->image && file_exists(public_path('uploads/hero/' . $hero->image))) {
            unlink(public_path('uploads/hero/' . $hero->image));
        }

        // Delete the record
        $hero->delete();

        return redirect()->route('hero-section.index')->with('success', 'Hero Section Deleted Successfully');
    }
}
