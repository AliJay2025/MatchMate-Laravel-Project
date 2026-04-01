<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:manager']);
    }

    public function index()
    {
        $user = Auth::user();
        $team = $user->managedTeam;

        if (!$team) {
            abort(403, 'You are not assigned to any team.');
        }

        $players = $team->players;
        $nextMatch = null;
        $lastResult = null;

        return view('manager.dashboard', compact('team', 'players', 'nextMatch', 'lastResult'));
    }
}