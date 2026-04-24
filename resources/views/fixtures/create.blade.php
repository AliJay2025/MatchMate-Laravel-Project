@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">
            @if(request('type') == 'result')
                📊 Add Match Result
            @else
                🏆 Add New Fixture
            @endif
        </h1>
        
        <form action="{{ route('fixtures.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Home Team</label>
                <select name="home_team_id" class="w-full px-3 py-2 border rounded-lg" required>
                    <option value="">Select Home Team</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Away Team</label>
                <select name="away_team_id" class="w-full px-3 py-2 border rounded-lg" required>
                    <option value="">Select Away Team</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Match Date & Time</label>
                <input type="datetime-local" name="match_date" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Venue</label>
                <input type="text" name="venue" class="w-full px-3 py-2 border rounded-lg" placeholder="Stadium name">
            </div>
            
            @if(request('type') == 'result')
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Home Team Score</label>
                    <input type="number" name="home_score" class="w-full px-3 py-2 border rounded-lg text-center text-2xl" placeholder="0">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Away Team Score</label>
                    <input type="number" name="away_score" class="w-full px-3 py-2 border rounded-lg text-center text-2xl" placeholder="0">
                </div>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Status</label>
                <select name="status" class="w-full px-3 py-2 border rounded-lg">
                    <option value="completed">Completed</option>
                    <option value="scheduled">Scheduled</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            @else
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Status</label>
                <select name="status" class="w-full px-3 py-2 border rounded-lg">
                    <option value="scheduled">Scheduled</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            @endif
            
            <div class="flex justify-end gap-3">
                <a href="{{ route('fixtures.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Cancel</a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    @if(request('type') == 'result')
                        Save Result
                    @else
                        Save Fixture
                    @endif
                </button>
            </div>
        </form>
    </div>
</div>
@endsection