@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Teams</h1>
        <a href="{{ route('teams.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition">Add New Team</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($teams as $team)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:transform hover:scale-105 transition duration-300">
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white">{{ $team->name }}</h3>
                <p class="text-green-100 text-sm">{{ $team->short_name ?? '' }}</p>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-2"><strong>Ground:</strong> {{ $team->home_ground ?? 'N/A' }}</p>
                <p class="text-gray-600 mb-4"><strong>Manager:</strong> {{ $team->manager->name ?? 'Not assigned' }}</p>
                <div class="flex gap-2">
                    <a href="{{ route('teams.show', $team) }}" class="flex-1 text-center bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">View</a>
                    <a href="{{ route('teams.edit', $team) }}" class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition">Edit</a>
                    <form action="{{ route('teams.destroy', $team) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition" onclick="return confirm('Delete this team?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection