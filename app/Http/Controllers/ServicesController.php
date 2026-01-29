<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Variable;

class ServicesController extends Controller
{
    public function show()
    {
        $variables = Variable::all();
        $services = Service::where('status', 'active')->get();
        return view('pages.services.services', compact('services', 'variables'));
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
            'service_name'     => 'required|string|max:30',
            'description'      => 'nullable|string|max:255',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'main_service'     => 'nullable|boolean',
            'featured_service' => 'nullable|boolean',
            'status'           => 'required',
        ]);

        // Commented out: A service can now be both Main and Featured
        // if ($request->main_service == 1 && $request->featured_service == 1) {
        //     return back()->with('error', 'A service cannot be both Main and Featured at the same time.');
        // }

        // Only one Main Service allowed - user must manually unset the existing one first
        if ($request->main_service == 1) {
            $existingMainService = Service::where('main_service', 1)
                ->where('id', '!=', $id)
                ->first();

            if ($existingMainService) {
                return back()->with('error', 'A Main Service already exists. Please remove it first before setting a new one.');
            }
        }

        // Removed: Featured service limit - now unlimited featured services allowed
        // if ($request->featured_service == 1) {
        //     $alreadyFeatured = Service::where('featured_service', 1)
        //         ->where('id', '!=', $id)
        //         ->count();
        //
        //     if ($alreadyFeatured >= 3) {
        //         return back()->with('error', 'Only 3 Featured Services are allowed.');
        //     }
        // }

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
        $service->main_service     = $request->main_service ?? 0;
        $service->featured_service = $request->featured_service ?? 0;

        $service->save();

        $msg = $id ? 'Service Updated Successfully' : 'Service Added Successfully';

        return redirect()->route('services.index')->with('success', $msg);
    }


    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if ($service->image && file_exists(public_path('uploads/services/' . $service->image))) {
            unlink(public_path('uploads/services/' . $service->image));
        }

        $service->delete();

        return back()->with('success', 'Service Deleted Successfully');
    }
}
