@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Edit Player</h1>
                <p class="text-yellow-100 mt-1">Update player information</p>
            </div>
            
            <form action="{{ route('players.update', $player) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Player Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $player->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="team_id" class="block text-gray-700 font-medium mb-2">Team</label>
                    <select name="team_id" id="team_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition" required>
                        <option value="">Select a team</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" {{ $player->team_id == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                        @endforeach
                    </select>
                    @error('team_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_available" value="1" class="w-5 h-5 text-yellow-600 focus:ring-yellow-500 border-gray-300 rounded" {{ $player->is_available ? 'checked' : '' }}>
                        <span class="ml-3 text-gray-700 font-medium">Available for selection</span>
                    </label>
                </div>
                
                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-3 px-4 rounded-lg transition duration-300 transform hover:scale-105">
                        Update Player
                    </button>
                    <a href="{{ route('players.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-3 px-4 rounded-lg text-center transition duration-300">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection