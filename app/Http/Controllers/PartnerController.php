<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    // Show all partners
    public function index()
    {
        $partners = Partner::orderBy('id', 'desc')->get();
        return view('pages.admin-side.partners.index', compact('partners'));
    }

    // Show create form
    public function create()
    {
        return view('pages.admin-side.partners.create');
    }

    // Store new partner
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'image'  => 'required|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $path = $request->file('image')->store('partners', 'public');

        Partner::create([
            'name' => $request->name,
            'status' => $request->status,
            'image' => $path,
        ]);

        return redirect()->route('partners.index')->with('success', 'Partner added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('pages.admin-side.partners.edit', compact('partner'));
    }

    // Update partner
    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        $request->validate([
            'name'   => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'image'  => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'status' => $request->status,
        ];

        if ($request->hasFile('image')) {
            if ($partner->image && Storage::disk('public')->exists($partner->image)) {
                Storage::disk('public')->delete($partner->image);
            }

            $data['image'] = $request->file('image')->store('partners', 'public');
        }

        $partner->update($data);

        return redirect()->route('partners.index')->with('success', 'Partner updated successfully!');
    }

    // Delete partner
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);

        if ($partner->image && Storage::disk('public')->exists($partner->image)) {
            Storage::disk('public')->delete($partner->image);
        }

        $partner->delete();

        return redirect()->route('partners.index')->with('success', 'Partner deleted successfully!');
    }
}
