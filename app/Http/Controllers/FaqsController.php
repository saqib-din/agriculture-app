<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    // Show all FAQs
    public function index()
    {
        $faqs = Faq::all();
        return view('pages.admin-side.faqs.index', compact('faqs'));
    }

    // Show create form
    public function create()
    {
        return view('pages.admin-side.faqs.create');
    }

    // Store FAQ
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'status'  => 'required|boolean',
        ]);

        Faq::create([
            'title'   => $request->title,
            'content' => $request->content,
            'status'  => $request->status,
        ]);

        return redirect()->back()->with('success', 'FAQ added successfully!');
    }

    // Edit form
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('pages.admin-side.edit', compact('faq'));
    }

    // Update FAQ
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'status'  => 'required|boolean',
        ]);

        $faq = Faq::findOrFail($id);

        $faq->update([
            'title'   => $request->title,
            'content' => $request->content,
            'status'  => $request->status,
        ]);

        return redirect()->back()->with('success', 'FAQ updated successfully!');
    }

    // Delete FAQ
    public function destroy($id)
    {
        Faq::destroy($id);

        return redirect()->back()->with('success', 'FAQ deleted successfully!');
    }
}
