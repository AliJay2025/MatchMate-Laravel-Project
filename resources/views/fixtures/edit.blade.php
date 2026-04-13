@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Fixture</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('fixtures.update', $fixture) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label>Home Team</label>
                            <select name="home_team_id" class="form-control @error('home_team_id') is-invalid @enderror" required>
                                <option value="">Select Home Team</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ $fixture->home_team_id == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('home_team_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Away Team</label>
                            <select name="away_team_id" class="form-control @error('away_team_id') is-invalid @enderror" required>
                                <option value="">Select Away Team</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ $fixture->away_team_id == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('away_team_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Match Date & Time</label>
                            <input type="datetime-local" name="match_date" class="form-control" value="{{ $fixture->match_date->format('Y-m-d\TH:i') }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Venue</label>
                            <input type="text" name="venue" class="form-control" value="{{ $fixture->venue }}">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('fixtures.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Fixture</button>
                        </div>
                    </form>

                    @can('delete', $fixture)
                        <hr>
                        <form action="{{ route('fixtures.destroy', $fixture) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this fixture?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Fixture</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection