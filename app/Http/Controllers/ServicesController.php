<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServicesController extends Controller
{
    public function show()
    {
        $services = Service::all();
        return view('pages.services.services', compact('services'));
    }

    // Show services list
    public function index()
    {
        $services = Service::all();
        return view('pages.admin-side.services.index', compact('services'));
    }

    // Create or Edit Form
    public function form($id = null)
    {
        $service = $id ? Service::findOrFail($id) : null;
        return view('pages.admin-side.services.createorupdate', compact('service'));
    }

    // Create or Update
    public function save(Request $request, $id = null)
    {
        $service = $id ? Service::findOrFail($id) : new Service();

        $request->validate([
            'service_name'     => 'required|string|max:255',
            'description'      => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'main_service'     => 'nullable|boolean',
            'featured_service' => 'nullable|boolean',
            'status'           => 'required',
        ]);

        if ($request->main_service == 1) {
            Service::where('main_service', 1)
                ->where('id', '!=', $id)
                ->update(['main_service' => 0]);
        }

        if ($request->featured_service == 1) {
            $alreadyFeatured = Service::where('featured_service', 1)
                ->where('id', '!=', $id)
                ->count();

            if ($alreadyFeatured >= 3) {
                return back()->with('error', 'Only 3 Featured Services are allowed.');
            }
        }

        if ($request->hasFile('image')) {

            if ($id && $service->image && file_exists(public_path('uploads/services/' . $service->image))) {
                unlink(public_path('uploads/services/' . $service->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/services'), $imageName);
            $service->image = $imageName;
        }

        $service->service_name     = $request->service_name;
        $service->description      = $request->description;
        $service->status           = $request->status;
        $service->main_service     = $request->main_service ?? 0;          // default 0
        $service->featured_service = $request->featured_service ?? 0;      // default 0

        $service->save();

        $msg = $id ? 'Service Updated Successfully' : 'Service Added Successfully';

        return redirect()->route('services.index')->with('success', $msg);
    }

    // ===== DELETE SERVICE =====
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        // delete image
        if ($service->image && file_exists(public_path('uploads/services/' . $service->image))) {
            unlink(public_path('uploads/services/' . $service->image));
        }

        $service->delete();

        return back()->with('success', 'Service Deleted Successfully');
    }
}
