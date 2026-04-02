<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatchMate - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="px-6 py-8 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
                            <p class="text-green-100">Ready to manage your football league today?</p>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-24 h-24 text-green-300 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <div class="text-3xl font-bold text-green-600">{{ \App\Models\Team::count() }}</div>
                    <div class="text-gray-600 mt-2">Teams</div>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <div class="text-3xl font-bold text-green-600">{{ \App\Models\Player::count() }}</div>
                    <div class="text-gray-600 mt-2">Players</div>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                    <div class="text-3xl font-bold text-green-600">5</div>
                    <div class="text-gray-600 mt-2">League Rounds</div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('league') }}" class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition text-center">
                    <div class="text-4xl mb-3">🏆</div>
                    <div class="font-bold text-lg">View League Table</div>
                    <div class="text-gray-500 text-sm mt-1">Check current standings</div>
                </a>
                
                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'manager')
                <a href="{{ route('players.index') }}" class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition text-center">
                    <div class="text-4xl mb-3">⚽</div>
                    <div class="font-bold text-lg">Manage Players</div>
                    <div class="text-gray-500 text-sm mt-1">Add, edit, or remove players</div>
                </a>
                @endif
                
                <a href="{{ route('profile.edit') }}" class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition text-center">
                    <div class="text-4xl mb-3">👤</div>
                    <div class="font-bold text-lg">My Profile</div>
                    <div class="text-gray-500 text-sm mt-1">Update your account settings</div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>