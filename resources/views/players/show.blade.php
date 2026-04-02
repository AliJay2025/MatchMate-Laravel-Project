@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Player Details</h1>
                <p class="text-blue-100 mt-1">View player information</p>
            </div>
            
            <div class="p-6">
                <div class="flex items-center justify-center mb-6">
                    <div class="h-32 w-32 rounded-full bg-gradient-to-r from-green-500 to-green-600 flex items-center justify-center">
                        <span class="text-4xl font-bold text-white">{{ substr($player->name, 0, 1) }}</span>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="border-b border-gray-200 pb-4">
                        <label class="block text-gray-500 text-sm font-medium mb-1">Player Name</label>
                        <p class="text-gray-900 text-lg font-semibold">{{ $player->name }}</p>
                    </div>
                    
                    <div class="border-b border-gray-200 pb-4">
                        <label class="block text-gray-500 text-sm font-medium mb-1">Team</label>
                        <p class="text-gray-900 font-semibold">{{ $player->team->name ?? 'No Team' }}</p>
                    </div>
                    
                    <div class="border-b border-gray-200 pb-4">
                        <label class="block text-gray-500 text-sm font-medium mb-1">Availability</label>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $player->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $player->is_available ? 'Available' : 'Unavailable' }}
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-sm font-medium mb-1">Joined</label>
                        <p class="text-gray-900">{{ $player->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
                
                <div class="flex gap-3 mt-8 pt-4 border-t border-gray-200">
                    <a href="{{ route('players.index') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg text-center transition">
                        Back to Squad
                    </a>
                    <a href="{{ route('players.edit', $player) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg text-center transition">
                        Edit Player
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection