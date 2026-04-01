@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">League Table</h1>
            <p class="text-gray-600">Spring 2026 Season - Premier Division</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Standings</h2>
                <p class="text-green-100 mt-1">Updated after Matchday 8</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pos</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Team</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">P</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">W</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">D</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">L</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">GF</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">GA</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">GD</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Pts</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($teams as $index => $team)
                        <tr class="hover:bg-gray-50 transition duration-200 {{ $index == 0 ? 'bg-green-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($index == 0)
                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-yellow-500 text-white font-bold rounded-full">1</span>
                                @elseif($index == 1)
                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-400 text-white font-bold rounded-full">2</span>
                                @elseif($index == 2)
                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-orange-500 text-white font-bold rounded-full">3</span>
                                @else
                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-200 text-gray-700 font-bold rounded-full">{{ $index + 1 }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-green-500 to-green-600 flex items-center justify-center text-white font-bold">
                                        {{ substr($team->name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $team->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $team->short_name ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">{{ $team->played }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-green-600 font-semibold">{{ $team->wins }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-yellow-600 font-semibold">{{ $team->draws }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-red-600 font-semibold">{{ $team->losses }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">{{ $team->goals_for }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center font-semibold">{{ $team->goals_against }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center font-bold {{ $team->goals_for - $team->goals_against > 0 ? 'text-green-600' : ($team->goals_for - $team->goals_against < 0 ? 'text-red-600' : 'text-gray-600') }}">
                                {{ $team->goals_for - $team->goals_against }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center font-bold text-xl text-green-600">{{ $team->points }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-3xl font-bold text-green-600">{{ $teams->sum('goals_for') }}</div>
                <div class="text-gray-600 mt-2">Total Goals</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-3xl font-bold text-green-600">{{ $teams->avg('points') }}</div>
                <div class="text-gray-600 mt-2">Average Points</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-3xl font-bold text-green-600">{{ $teams->where('points', '>', 0)->count() }}</div>
                <div class="text-gray-600 mt-2">Active Teams</div>
            </div>
        </div>
    </div>
</div>
@endsection