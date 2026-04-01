@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Player</h1>
    <form action="{{ route('players.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Player Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="team_id" class="form-label">Team</label>
            <select name="team_id" class="form-control" required>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_available" class="form-check-input" value="1">
            <label class="form-check-label">Available</label>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection