@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">📅 Fixtures & Results</h1>
        <p class="text-gray-600">Stay updated with all match schedules and scores</p>
    </div>

    <!-- Upcoming Matches Section -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-green-700 flex items-center">
                <i class="fas fa-calendar-alt mr-2"></i> Upcoming Matches
            </h2>
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">{{ $upcomingMatches->count() }} matches</span>
        </div>
        
        @if($upcomingMatches->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($upcomingMatches as $match)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:transform hover:scale-105 transition duration-300">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 px-4 py-2">
                        <p class="text-white text-sm text-center">
                            <i class="far fa-calendar-alt mr-1"></i> {{ $match->match_date->format('l, F d, Y') }}
                            <i class="far fa-clock ml-2 mr-1"></i> {{ $match->match_date->format('H:i') }}
                        </p>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center">
                            <div class="text-center flex-1">
                                <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-2">
                                    <span class="text-2xl">⚽</span>
                                </div>
                                <p class="font-bold text-gray-800">{{ $match->homeTeam->name ?? 'TBD' }}</p>
                            </div>
                            <div class="text-center px-4">
                                <span class="text-2xl font-bold text-gray-400">VS</span>
                            </div>
                            <div class="text-center flex-1">
                                <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-2">
                                    <span class="text-2xl">⚽</span>
                                </div>
                                <p class="font-bold text-gray-800">{{ $match->awayTeam->name ?? 'TBD' }}</p>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="text-gray-500 text-sm">
                                <i class="fas fa-map-marker-alt mr-1"></i> {{ $match->venue ?? 'Venue TBD' }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="bg-yellow-50 rounded-lg p-6 text-center">
                <p class="text-yellow-700">No upcoming matches scheduled.</p>
            </div>
        @endif
    </div>

    <!-- Recent Results Section -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-green-700 flex items-center">
                <i class="fas fa-trophy mr-2"></i> Recent Results
            </h2>
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">{{ $recentResults->count() }} results</span>
        </div>
        
        @if($recentResults->count() > 0)
            <div class="space-y-3">
                @foreach($recentResults as $match)
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <div class="flex-1 text-right">
                            <p class="font-bold text-gray-800">{{ $match->homeTeam->name ?? 'TBD' }}</p>
                        </div>
                        <div class="mx-4 px-6 py-2 bg-gradient-to-r from-green-600 to-green-700 rounded-lg">
                            <span class="font-bold text-2xl text-white">{{ $match->home_score ?? '0' }}</span>
                            <span class="text-white text-xl mx-2">-</span>
                            <span class="font-bold text-2xl text-white">{{ $match->away_score ?? '0' }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-800">{{ $match->awayTeam->name ?? 'TBD' }}</p>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <p class="text-gray-500 text-sm">
                            <i class="far fa-calendar-alt mr-1"></i> {{ $match->match_date->format('M d, Y') }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="bg-yellow-50 rounded-lg p-6 text-center">
                <p class="text-yellow-700">No results available yet.</p>
            </div>
        @endif
    </div>

    <!-- All Fixtures Section with Pagination -->
    <div>
        <h2 class="text-2xl font-bold text-green-700 mb-4 flex items-center">
            <i class="fas fa-list mr-2"></i> All Fixtures
        </h2>
        
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-green-600 to-green-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Home Team</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Score</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Away Team</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Venue</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($allFixtures as $match)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $match->match_date->format('M d, Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                {{ $match->homeTeam->name ?? 'TBD' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($match->status == 'completed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                        {{ $match->home_score }} - {{ $match->away_score }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                        VS
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                {{ $match->awayTeam->name ?? 'TBD' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $match->venue ?? 'TBD' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($match->status == 'completed')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        ✓ Played
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        ⏳ Upcoming
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $allFixtures->links() }}
            </div>
        </div>
    </div>
</div>
@endsection