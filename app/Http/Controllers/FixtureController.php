<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    public function index()
    {
        $upcomingMatches = Fixture::with(['homeTeam', 'awayTeam'])
            ->where('match_date', '>=', now())
            ->where('status', 'scheduled')
            ->orderBy('match_date', 'asc')
            ->get();
        
        $recentResults = Fixture::with(['homeTeam', 'awayTeam'])
            ->where('status', 'completed')
            ->orderBy('match_date', 'desc')
            ->take(10)
            ->get();
        
        $allFixtures = Fixture::with(['homeTeam', 'awayTeam'])
            ->orderBy('match_date', 'desc')
            ->paginate(15);
            
        return view('fixtures.index', compact('upcomingMatches', 'recentResults', 'allFixtures'));
    }
}