<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MatchMate - Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-green-600 to-green-800">
    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden max-w-md w-full">
            
            <!-- Header with Logo -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-8 text-center">
                <div class="flex justify-center mb-4">
                    <div class="bg-white rounded-full p-4 shadow-lg">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center">
                            <span class="text-3xl">⚽</span>
                        </div>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-white">Create Account</h1>
                <p class="text-green-100 mt-2">Join MatchMate today</p>
            </div>
            
            <!-- Registration Form -->
            <div class="px-6 py-8">
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ url('/register') }}">
                    @csrf
                    
                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">👤 Full Name</label>
                        <input type="text" name="name" placeholder="Enter your full name" 
                               class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" 
                               required autofocus>
                    </div>
                    
                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">📧 Email Address</label>
                        <input type="email" name="email" placeholder="your@email.com" 
                               class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" 
                               required>
                    </div>
                    
                    <!-- Role Selection -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">🎯 Register as</label>
                        <select name="role" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="fan">🏆 Football Fan</option>
                            <option value="manager">⚽ Team Manager</option>
                        </select>
                    </div>
                    
                    <!-- Password -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">🔒 Password (min 8 characters)</label>
                        <input type="password" name="password" placeholder="Enter password" 
                               class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" 
                               required>
                    </div>
                    
                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">✓ Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm password" 
                               class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" 
                               required>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-3 rounded-lg transition duration-300 transform hover:scale-105">
                        🚀 Register
                    </button>
                    
                    <!-- Login Link -->
                    <div class="text-center mt-6">
                        <p class="text-gray-600">
                            Already have an account? 
                            <a href="{{ url('/login') }}" class="text-green-600 hover:text-green-700 font-semibold hover:underline">
                                Sign in here
                            </a>
                        </p>
                    </div>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 text-center border-t border-gray-200">
                <p class="text-xs text-gray-500">© 2026 MatchMate - Local Football League Management</p>
            </div>
        </div>
    </div>
</body>
</html>