@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Players</h1>
    <a href="{{ route('players.create') }}" class="btn btn-primary mb-3">Add Player</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Team</th>
                <th>Available</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($players as $player)
            <tr>
                <td>{{ $player->name }}</td>
                <td>{{ $player->team->name }}</td>
                <td>{{ $player->is_available ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('players.show', $player) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('players.edit', $player) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('players.destroy', $player) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this player?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection