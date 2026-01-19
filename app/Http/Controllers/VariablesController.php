<?php

namespace App\Http\Controllers;

use App\Models\Variable;
use Illuminate\Http\Request;

class VariablesController extends Controller
{
    // public function index()
    // {
    //     $variables = Variable::orderBy('id', 'desc')->get();
    //     return view('pages.admin-side.variables.index', compact('variables'));
    // }

    // Quick access method - toggle between create and edit
    // public function quickAccess()
    // {
    //     // Check if any variable exists
    //     $latestVariable = Variable::latest()->first();

    //     if ($latestVariable) {
    //         // If variable exists, redirect to edit
    //         return redirect()->route('variables.edit', $latestVariable->id);
    //     } else {
    //         // If no variable exists, redirect to create
    //         return redirect()->route('variables.create');
    //     }
    // }

    // public function create()
    // {
    //     return view('pages.admin-side.variables.createorupdate');
    // }

    // public function edit($id)
    // {
    //     $variable = Variable::findOrFail($id);
    //     return view('pages.admin-side.variables.createorupdate', compact('variable'));
    // }

    public function create()
    {
        $variables = Variable::pluck('value', 'key');
        return view('pages.admin-side.variables.createorupdate', compact('variables'));
    }


    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:20',
            'email' => 'required|email|max:40',
            'phone' => 'required|string|max:20',

            'fax'             => 'nullable|string|max:40',
            'working_hours'   => 'nullable|string|max:40',
            'linkedin'        => 'nullable|string|max:100',
            'facebook'        => 'nullable|string|max:100',
            'instagram'       => 'nullable|string|max:100',
            'youtube'         => 'nullable|string|max:100',
            'twitter'         => 'nullable|string|max:100',
            'map'             => 'nullable|string|max:255',
            'slogan'          => 'nullable|string|max:40',
            'reg'             => 'nullable|string|max:50',
            'about_us'        => 'nullable|string|max:500',
            'company_mission' => 'nullable|string|max:500',
            'company_vision'  => 'nullable|string|max:500',
            'address'         => 'nullable|string|max:500',
        ]);

        $map = [
            'name' => 'company_name',
            'email' => 'company_email',
            'phone' => 'company_phone',
            'fax' => 'company_fax',
            'working_hours' => 'working_hours',
            'linkedin' => 'linkedin',
            'facebook' => 'facebook',
            'instagram' => 'instagram',
            'youtube' => 'youtube',
            'twitter' => 'twitter',
            'map' => 'company_map',
            'slogan' => 'company_slogan',
            'reg' => 'registration_number',
            'about_us' => 'about_us',
            'company_mission' => 'company_mission',
            'company_vision' => 'company_vision',
            'address' => 'company_address',
        ];

        foreach ($map as $input => $key) {
            Variable::updateOrCreate(
                ['key' => $key],
                ['value' => $request->input($input)]
            );
        }

        return back()->with('success', 'Variables saved successfully');
    }

    // public function show($id)
    // {
    //     $variable = Variable::findOrFail($id);
    //     return view('pages.admin-side.variables.show', compact('variable'));
    // }

    // public function destroy($id)
    // {
    //     $variable = Variable::findOrFail($id);
    //     $variable->delete();

    //     return redirect()->route('variables.index')
    //         ->with('success', 'Variable Deleted!');
    // }
}
