<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\Variable;

class TeamController extends Controller
{
    public function show()
    {
        $variables = Variable::all();
        $teams = Team::where('status', 'active')->get();
        return view('pages.teams.team', compact('teams', 'variables'));
    }

    public function index()
    {
        $teams = Team::latest()->get();
        return view('pages.admin-side.teams.index', compact('teams'));
    }

    public function createorupdate($id = null)
    {
        $team = $id ? Team::findOrFail($id) : null;
        return view('pages.admin-side.teams.createorupdate', compact('team'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'status' => 'required',
        ]);

        $team = $request->id ? Team::findOrFail($request->id) : new Team();

        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->status = $request->status;
        $team->description = $request->description;
        $team->phone = $request->phone;
        $team->email = $request->email;
        $team->linkedin = $request->linkedin;
        $team->facebook = $request->facebook;
        $team->instagram = $request->instagram;
        $team->is_ceo = $request->is_ceo;

        if ($request->hasFile('image')) {

            if ($team->image && file_exists(public_path('uploads/teams/' . $team->image))) {
                unlink(public_path('uploads/teams/' . $team->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/teams'), $imageName);

            $team->image = $imageName;
        }

        $team->save();

        return redirect()->route('teams.index')
            ->with('success', $request->id ? 'Team updated successfully' : 'Team added successfully');
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        if ($team->image && file_exists(public_path('uploads/teams/' . $team->image))) {
            unlink(public_path('uploads/teams/' . $team->image));
        }

        $team->delete();

        return redirect()->back()->with('success', 'Team deleted successfully');
    }
}
