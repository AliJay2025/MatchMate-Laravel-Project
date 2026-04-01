@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $player->name }}</h1>
    <p><strong>Team:</strong> {{ $player->team->name }}</p>
    <p><strong>Available:</strong> {{ $player->is_available ? 'Yes' : 'No' }}</p>
    <a href="{{ route('players.index') }}" class="btn btn-secondary">Back to Squad</a>
</div>
@endsection