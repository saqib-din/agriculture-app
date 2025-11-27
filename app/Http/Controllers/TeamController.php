<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function createorupdate()
    {
        return view('pages.admin-side.teams.createorupdate');
    }

    public function index()
    {
        return view('pages.admin-side.teams.index');
    }

    public function show()
    {
        return view('pages.teams.team');
    }
}
