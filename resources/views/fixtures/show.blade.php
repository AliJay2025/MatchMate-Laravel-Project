@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h4>Match Details</h4>
        </div>
        <div class="card-body">
            <div class="row text-center mb-4">
                <div class="col-5">
                    <h2>{{ $fixture->homeTeam->name }}</h2>
                    @if($fixture->isPlayed())
                        <h1 class="display-3">{{ $fixture->home_score }}</h1>
                    @endif
                </div>
                <div class="col-2">
                    <h2>VS</h2>
                </div>
                <div class="col-5">
                    <h2>{{ $fixture->awayTeam->name }}</h2>
                    @if($fixture->isPlayed())
                        <h1 class="display-3">{{ $fixture->away_score }}</h1>
                    @endif
                </div>
            </div>

            <div class="text-center mb-4">
                <p>
                    <strong>Date:</strong> {{ $fixture->match_date->format('l, F j, Y - g:i A') }}<br>
                    <strong>Venue:</strong> {{ $fixture->venue ?? 'TBD' }}<br>
                    <strong>Status:</strong> 
                    <span class="badge bg-{{ $fixture->status === 'played' ? 'success' : ($fixture->status === 'scheduled' ? 'warning' : 'danger') }}">
                        {{ ucfirst($fixture->status) }}
                    </span>
                </p>
            </div>

            @if($fixture->isPlayed())
                <hr>
                <h5>Goal Scorers</h5>
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-success">{{ $fixture->homeTeam->name }}</h6>
                        <ul class="list-group">
                            @forelse($homeGoals as $goal)
                                <li class="list-group-item">
                                    {{ $goal->player->name }} 
                                    @if($goal->minute) ({{ $goal->minute }}') @endif
                                    @if($goal->goal_type != 'normal')
                                        <span class="badge bg-info">{{ str_replace('_', ' ', $goal->goal_type) }}</span>
                                    @endif
                                </li>
                            @empty
                                <li class="list-group-item text-muted">No goals recorded</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-success">{{ $fixture->awayTeam->name }}</h6>
                        <ul class="list-group">
                            @forelse($awayGoals as $goal)
                                <li class="list-group-item">
                                    {{ $goal->player->name }}
                                    @if($goal->minute) ({{ $goal->minute }}') @endif
                                    @if($goal->goal_type != 'normal')
                                        <span class="badge bg-info">{{ str_replace('_', ' ', $goal->goal_type) }}</span>
                                    @endif
                                </li>
                            @empty
                                <li class="list-group-item text-muted">No goals recorded</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                @if($fixture->match_report)
                    <hr>
                    <h5>Match Report</h5>
                    <p>{{ $fixture->match_report }}</p>
                @endif
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('fixtures.index') }}" class="btn btn-secondary">Back to Fixtures</a>
                @can('reportResult', $fixture)
                    <a href="{{ route('fixtures.edit', $fixture) }}" class="btn btn-success">Report Result</a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection