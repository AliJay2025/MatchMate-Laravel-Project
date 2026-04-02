<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Profile - MatchMate</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .profile-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .profile-header {
            background: linear-gradient(135deg, #16a34a, #15803d);
            padding: 40px;
            text-align: center;
            color: white;
        }
        
        .avatar {
            width: 100px;
            height: 100px;
            background: #eab308;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 48px;
            font-weight: bold;
            color: white;
        }
        
        .profile-header h2 {
            font-size: 28px;
            margin-bottom: 5px;
        }
        
        .profile-header p {
            color: #bbf7d0;
            margin-bottom: 15px;
        }
        
        .badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .badge-admin { background: #eab308; color: #000; }
        .badge-manager { background: #3b82f6; color: white; }
        .badge-fan { background: #6b7280; color: white; }
        
        .profile-body {
            padding: 30px;
        }
        
        .section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .section h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #1f2937;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 15px;
            padding: 10px;
            background: #f9fafb;
            border-radius: 8px;
        }
        
        .info-label {
            font-weight: bold;
            width: 150px;
            color: #4b5563;
        }
        
        .info-value {
            color: #1f2937;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #374151;
        }
        
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
        }
        
        button {
            background: #16a34a;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        
        button:hover {
            background: #15803d;
        }
        
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        
        .quick-link {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            background: #f9fafb;
            border-radius: 8px;
            text-decoration: none;
            color: #16a34a;
            transition: all 0.3s;
        }
        
        .quick-link:hover {
            background: #d1fae5;
            transform: translateX(5px);
        }
    </style>
</head>
<body>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        
        <!-- Profile Card -->
        <div class="profile-card">
            <div class="profile-header">
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <h2>{{ Auth::user()->name }}</h2>
                <p>{{ Auth::user()->email }}</p>
                <span class="badge badge-{{ Auth::user()->role }}">
                    @if(Auth::user()->role == 'admin') 👑 ADMINISTRATOR
                    @elseif(Auth::user()->role == 'manager') ⚽ TEAM MANAGER
                    @else 🏆 FOOTBALL FAN
                    @endif
                </span>
            </div>
            
            <div class="profile-body">
                <!-- Account Info -->
                <div class="section">
                    <h3>📋 Account Information</h3>
                    <div class="info-row">
                        <div class="info-label">User ID:</div>
                        <div class="info-value">#{{ Auth::user()->id }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Role:</div>
                        <div class="info-value">{{ ucfirst(Auth::user()->role) }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Member Since:</div>
                        <div class="info-value">{{ Auth::user()->created_at->format('F d, Y') }}</div>
                    </div>
                </div>
                
                <!-- Update Profile Form -->
                <div class="section">
                    <h3>✏️ Update Profile</h3>
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')
                        
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                        </div>
                        
                        <button type="submit">Update Profile</button>
                    </form>
                </div>
                
                <!-- Change Password Form -->
                <div class="section">
                    <h3>🔒 Change Password</h3>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" name="current_password" required>
                        </div>
                        
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="password_confirmation" required>
                        </div>
                        
                        <button type="submit">Change Password</button>
                    </form>
                </div>
                
                <!-- Navigation Links -->
                <div class="section">
                    <h3>🔗 Quick Links</h3>
                    <a href="{{ url('/dashboard') }}" class="quick-link">← Back to Dashboard</a>
                    <a href="{{ url('/league') }}" class="quick-link">🏆 View League Table</a>
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
                        <a href="{{ url('/players') }}" class="quick-link">⚽ Manage Players</a>
                    @endif
                    @if(Auth::user()->role == 'admin')
                        <a href="{{ url('/teams') }}" class="quick-link">🏟️ Manage Teams</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>