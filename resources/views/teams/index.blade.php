@extends('layouts.app')

@section('content')
<style>
    .team-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        transition: transform 0.3s, box-shadow 0.3s;
        overflow: hidden;
    }
    .team-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-color: #16a34a;
    }
    .team-header {
        background: linear-gradient(135deg, #16a34a, #15803d);
        padding: 16px;
        color: white;
    }
    .team-body {
        padding: 20px;
    }
    .team-name {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 4px;
    }
    .team-short {
        font-size: 0.875rem;
        opacity: 0.9;
    }
    .team-info {
        margin-bottom: 12px;
        color: #4b5563;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .btn-view {
        background-color: #3b82f6;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.875rem;
    }
    .btn-view:hover {
        background-color: #2563eb;
    }
    .btn-edit {
        background-color: #eab308;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.875rem;
    }
    .btn-edit:hover {
        background-color: #ca8a04;
    }
    .btn-delete {
        background-color: #ef4444;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
    }
    .btn-delete:hover {
        background-color: #dc2626;
    }
    .add-team-btn {
        background-color: #16a34a;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
    }
    .add-team-btn:hover {
        background-color: #15803d;
    }
</style>

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">🏆 Teams</h1>
        @if(Auth::check() && Auth::user()->role === 'admin')
        <a href="{{ route('teams.create') }}" class="add-team-btn">
            + Add New Team
        </a>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($teams as $team)
        <div class="team-card">
            <div class="team-header">
                <div class="team-name">{{ $team->name }}</div>
                <div class="team-short">{{ $team->short_name ?? '' }}</div>
            </div>
            <div class="team-body">
                <div class="team-info">
                    <span>🏟️</span> {{ $team->home_ground ?? 'No ground' }}
                </div>
                <div class="team-info">
                    <span>👔</span> {{ $team->manager->name ?? 'No manager' }}
                </div>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('teams.show', $team) }}" class="btn-view">View</a>
                    @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('teams.edit', $team) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('teams.destroy', $team) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Delete this team?')">Delete</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection