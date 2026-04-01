@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Manager Dashboard</h1>
            <p>Welcome, {{ Auth::user()->name }}! You are managing <strong>{{ $team->name }}</strong>.</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Squad</div>
                <div class="card-body">
                    @if($players->count())
                        <table class="table table-sm">
                            <thead>
                                <tr><th>Name</th><th>Available</th><th></th></tr>
                            </thead>
                            <tbody>
                            @foreach($players as $player)
                                <tr>
                                    <td>{{ $player->name }}</td>
                                    <td>
                                        <form action="{{ route('players.availability', $player) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm {{ $player->is_available ? 'btn-success' : 'btn-secondary' }}">
                                                {{ $player->is_available ? 'Available' : 'Unavailable' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('players.edit', $player) }}" class="btn btn-sm btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No players yet.</p>
                    @endif
                    <a href="{{ route('players.create') }}" class="btn btn-primary btn-sm">Add New Player</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Quick Links</div>
                <div class="card-body">
                    <ul>
                        <li><a href="{{ route('players.index') }}">Manage Squad</a></li>
                        <li><a href="#">View League Table</a></li> <!-- Replace with actual route when available -->
                        <li><a href="#">Upcoming Fixtures</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Next Match</div>
                <div class="card-body">
                    @if($nextMatch)
                        <p>{{ $nextMatch->homeTeam->name }} vs {{ $nextMatch->awayTeam->name }}</p>
                        <p>Date: {{ $nextMatch->match_date }}</p>
                    @else
                        <p>No upcoming matches scheduled.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Last Result</div>
                <div class="card-body">
                    @if($lastResult)
                        <p>{{ $lastResult->homeTeam->name }} {{ $lastResult->home_score }} - {{ $lastResult->away_score }} {{ $lastResult->awayTeam->name }}</p>
                    @else
                        <p>No results yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection