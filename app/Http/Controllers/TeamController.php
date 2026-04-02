<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin')->except(['index', 'show']);
    }

    public function index()
    {
        $teams = Team::with('manager')->orderBy('points', 'desc')->get();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        $managers = User::where('role', 'manager')->get();
        return view('teams.create', compact('managers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:teams',
            'short_name' => 'nullable|string|max:10',
            'home_ground' => 'nullable|string|max:255',
            'manager_id' => 'nullable|exists:users,id',
        ]);

        Team::create($validated);
        return redirect()->route('teams.index')->with('success', 'Team created successfully!');
    }

    public function show(Team $team)
    {
        $team->load('players', 'manager');
        return view('teams.show', compact('team'));
    }

    public function edit(Team $team)
    {
        $managers = User::where('role', 'manager')->get();
        return view('teams.edit', compact('team', 'managers'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:teams,name,' . $team->id,
            'short_name' => 'nullable|string|max:10',
            'home_ground' => 'nullable|string|max:255',
            'manager_id' => 'nullable|exists:users,id',
        ]);

        $team->update($validated);
        return redirect()->route('teams.index')->with('success', 'Team updated successfully!');
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Team deleted successfully!');
    }
}