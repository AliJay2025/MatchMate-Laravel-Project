@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Match Fixtures</h1>
        @can('create', App\Models\Fixture::class)
            <div>
                <a href="{{ route('fixtures.create') }}" class="btn btn-primary">Add New Fixture</a>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#generateModal">
                    Generate Season Fixtures
                </button>
            </div>
        @endcan
    </div>

    <div class="row">
        <!-- Upcoming Fixtures -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"> Upcoming Matches</h5>
                </div>
                <div class="card-body">
                    @forelse($upcomingFixtures as $fixture)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-5 text-end">
                                        <strong>{{ $fixture->homeTeam->name }}</strong>
                                    </div>
                                    <div class="col-2 text-center">
                                        <span class="badge bg-secondary">VS</span>
                                    </div>
                                    <div class="col-5">
                                        <strong>{{ $fixture->awayTeam->name }}</strong>
                                    </div>
                                </div>
                                <div class="text-center mt-2">
                                    <small class="text-muted">
                                         {{ $fixture->venue ?? 'TBD' }} | 
                                         {{ $fixture->match_date->format('D, M j - g:i A') }}
                                    </small>
                                </div>
                                <div class="text-center mt-2">
                                    <a href="{{ route('fixtures.show', $fixture) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                    @can('reportResult', $fixture)
                                        <a href="{{ route('fixtures.edit', $fixture) }}" class="btn btn-sm btn-success">Report Result</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No upcoming fixtures scheduled.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Results -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"> Recent Results</h5>
                </div>
                <div class="card-body">
                    @forelse($playedFixtures as $fixture)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-5 text-end">
                                        <strong>{{ $fixture->homeTeam->name }}</strong>
                                    </div>
                                    <div class="col-2 text-center">
                                        <span class="badge bg-primary">{{ $fixture->home_score }} - {{ $fixture->away_score }}</span>
                                    </div>
                                    <div class="col-5">
                                        <strong>{{ $fixture->awayTeam->name }}</strong>
                                    </div>
                                </div>
                                <div class="text-center mt-2">
                                    <small class="text-muted">
                                        {{ $fixture->match_date->format('D, M j, Y') }}
                                    </small>
                                </div>
                                <div class="text-center mt-2">
                                    <a href="{{ route('fixtures.show', $fixture) }}" class="btn btn-sm btn-outline-primary">Match Details</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No results recorded yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Generate Fixtures Modal -->
@can('create', App\Models\Fixture::class)
<div class="modal fade" id="generateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('fixtures.generate') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Generate Season Fixtures</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Start Date</label>
                        <input type="datetime-local" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Select Teams</label>
                        <select name="teams[]" class="form-control" multiple required>
                            @foreach(\App\Models\Team::all() as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Hold Ctrl to select multiple teams</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Generate Fixtures</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection