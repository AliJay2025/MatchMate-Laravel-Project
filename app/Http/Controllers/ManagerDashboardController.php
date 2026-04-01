<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fixture; // only if Fixture model exists (Abdirahman's work). If not, skip dummy data.

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

        // If Fixture model exists (from Abdirahman's work), we can fetch real data
        if (class_exists('App\Models\Fixture')) {
            $nextMatch = Fixture::where(function($q) use ($team) {
                $q->where('home_team_id', $team->id)
                  ->orWhere('away_team_id', $team->id);
            })->where('match_date', '>=', now())
              ->orderBy('match_date')
              ->first();

            $lastResult = Fixture::where(function($q) use ($team) {
                $q->where('home_team_id', $team->id)
                  ->orWhere('away_team_id', $team->id);
            })->where('status', 'played')
              ->orderBy('match_date', 'desc')
              ->first();
        }

        return view('manager.dashboard', compact('team', 'players', 'nextMatch', 'lastResult'));
    }
}