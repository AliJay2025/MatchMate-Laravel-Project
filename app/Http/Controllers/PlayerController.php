<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $players = Player::with('team')->get();
        } else {
            $team = $user->managedTeam;
            if (!$team) {
                abort(403, 'You are not assigned to any team.');
            }
            $players = $team->players;
        }
        return view('players.index', compact('players'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $teams = Team::all();
        } else {
            $teams = collect([$user->managedTeam]);
        }
        return view('players.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'team_id' => 'required|exists:teams,id',
            'is_available' => 'sometimes|boolean',
        ]);

        $user = Auth::user();
        $team = Team::find($validated['team_id']);
        if ($user->role !== 'admin' && $user->managedTeam->id !== $team->id) {
            abort(403, 'You can only add players to your own team.');
        }

        Player::create($validated);
        return redirect()->route('players.index')->with('success', 'Player added successfully.');
    }

    public function show(Player $player)
    {
        $user = Auth::user();
        if ($user->role !== 'admin' && $user->managedTeam->id !== $player->team_id) {
            abort(403);
        }
        return view('players.show', compact('player'));
    }

    public function edit(Player $player)
    {
        $user = Auth::user();
        if ($user->role !== 'admin' && $user->managedTeam->id !== $player->team_id) {
            abort(403);
        }
        $teams = ($user->role === 'admin') ? Team::all() : collect([$user->managedTeam]);
        return view('players.edit', compact('player', 'teams'));
    }

    public function update(Request $request, Player $player)
    {
        $user = Auth::user();
        if ($user->role !== 'admin' && $user->managedTeam->id !== $player->team_id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'team_id' => 'required|exists:teams,id',
            'is_available' => 'sometimes|boolean',
        ]);

        $player->update($validated);
        return redirect()->route('players.index')->with('success', 'Player updated.');
    }

    public function destroy(Player $player)
    {
        $user = Auth::user();
        if ($user->role !== 'admin' && $user->managedTeam->id !== $player->team_id) {
            abort(403);
        }

        $player->delete();
        return redirect()->route('players.index')->with('success', 'Player removed.');
    }

    public function toggleAvailability(Player $player)
    {
        $user = Auth::user();
        if ($user->role !== 'admin' && $user->managedTeam->id !== $player->team_id) {
            abort(403);
        }

        $player->update(['is_available' => !$player->is_available]);
        return redirect()->back()->with('success', 'Availability updated.');
    }
}