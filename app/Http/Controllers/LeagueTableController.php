<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class LeagueTableController extends Controller
{
    public function index()
    {
        $teams = Team::orderBy('points', 'desc')
                     ->orderByRaw('(goals_for - goals_against) desc')
                     ->orderBy('goals_for', 'desc')
                     ->get();
        
        return view('league.index', compact('teams'));
    }
}