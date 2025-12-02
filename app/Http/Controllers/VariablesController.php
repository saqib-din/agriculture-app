<?php

namespace App\Http\Controllers;

use App\Models\Variable;
use Illuminate\Http\Request;

class VariablesController extends Controller
{
    public function index()
    {
        $variables = Variable::orderBy('id', 'desc')->get();
        return view('pages.admin-side.variables.index', compact('variables'));
    }

    public function create()
    {
        return view('pages.admin-side.variables.createorupdate');
    }

    public function edit($id)
    {
        $variable = Variable::findOrFail($id);
        return view('pages.admin-side.variables.createorupdate', compact('variable'));
    }

    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:20',
            'email' => 'required|email|max:40',
            'phone' => 'required|string|max:20',

            // all others nullable
            'fax'            => 'nullable|string|max:40',
            'working_hours'  => 'nullable|string|max:40',
            'linkedin'       => 'nullable|string|max:100',
            'facebook'       => 'nullable|string|max:100',
            'instagram'      => 'nullable|string|max:100',
            'youtube'        => 'nullable|string|max:100',
            'twitter'        => 'nullable|string|max:100',
            'map'            => 'nullable|string|max:255',
            'slogan'         => 'nullable|string|max:40',
            'reg'            => 'nullable|string|max:50',
            'about_us'       => 'nullable|string|max:500',
            'company_mission' => 'nullable|string|max:500',
            'company_vision' => 'nullable|string|max:500',
            'address'        => 'nullable|string|max:500',
        ]);

        Variable::updateOrCreate(
            ['id' => $request->id],
            $validated
        );

        return redirect()->route('variables.index')
            ->with('success', $request->id ? 'Variable Updated!' : 'Variable Added!');
    }

    public function show($id)
    {
        $variable = Variable::findOrFail($id);
        return view('pages.admin-side.variables.show', compact('variable'));
    }

    public function destroy($id)
    {
        $variable = Variable::findOrFail($id);
        $variable->delete();

        return redirect()->route('variables.index')
            ->with('success', 'Variable Deleted!');
    }
}
