<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    public function index()
    {
        $upcomingMatches = Fixture::with(['homeTeam', 'awayTeam'])
            ->where('status', 'scheduled')
            ->where('match_date', '>=', now())
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

    public function create()
    {
        $teams = Team::all();
        return view('fixtures.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'home_team_id' => 'required|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id',
            'match_date' => 'required|date',
            'venue' => 'nullable|string',
            'home_score' => 'nullable|integer',
            'away_score' => 'nullable|integer',
            'status' => 'required|in:scheduled,completed,cancelled'
        ]);

        Fixture::create($request->all());

        if ($request->status == 'completed') {
            return redirect()->route('fixtures.index')->with('success', 'Result added successfully!');
        }

        return redirect()->route('fixtures.index')->with('success', 'Fixture added successfully!');
    }

    public function show(Fixture $fixture)
    {
        return view('fixtures.show', compact('fixture'));
    }

    public function edit(Fixture $fixture)
    {
        $teams = Team::all();
        return view('fixtures.edit', compact('fixture', 'teams'));
    }

    public function update(Request $request, Fixture $fixture)
    {
        $request->validate([
            'home_team_id' => 'required|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id',
            'match_date' => 'required|date',
            'venue' => 'nullable|string',
            'home_score' => 'nullable|integer',
            'away_score' => 'nullable|integer',
            'status' => 'required|in:scheduled,completed,cancelled'
        ]);

        $fixture->update($request->all());
        return redirect()->route('fixtures.index')->with('success', 'Fixture updated successfully!');
    }

    public function destroy(Fixture $fixture)
    {
        $fixture->delete();
        return redirect()->route('fixtures.index')->with('success', 'Fixture deleted successfully!');
    }
}