<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MatchMate - Local Football League Management</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-futbol"></i> MatchMate
        </div>
        <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#features">Features</a>
            <a href="#league">League Table</a>
            <a href="#about">About</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-nav">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-nav">Login</a>
                    <a href="{{ route('register') }}" class="btn-nav">Register</a>
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Organise Your Local Football League Like a Pro</h1>
                <p>Stop using spreadsheets and WhatsApp groups. MatchMate helps local football leagues manage fixtures, results, and league tables in one simple place.</p>
                <div class="hero-buttons">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-primary">Go to Dashboard</a>
                        @else
                            <a href="{{ route('register') }}" class="btn-primary">Register Your Team</a>
                            <a href="{{ route('login') }}" class="btn-secondary">Sign In</a>
                        @endauth
                    @endif
                </div>
            </div>
            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1459865264687-595d652de67e?w=500&h=400&fit=crop" alt="Football Match">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <h2 class="section-title">Everything You Need to Run Your League</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>Fixtures & Results</h3>
                <p>Generate full season fixtures automatically. Record scores and track results instantly.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <h3>Live League Tables</h3>
                <p>Updated automatically as results come in. See who's top of the table in real-time.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Squad Management</h3>
                <p>Team managers can register players, set availability, and manage their squad easily.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Mobile Friendly</h3>
                <p>Works on your phone. Check fixtures, results, and tables from anywhere.</p>
            </div>
        </div>
    </section>

    <!-- League Table Preview -->
    <section class="league-preview" id="league">
        <h2 class="section-title">Spring 2026 League Standings</h2>
        <div class="league-table">
            <h3><i class="fas fa-trophy"></i> Premier Division</h3>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Team</th>
                        <th>P</th>
                        <th>W</th>
                        <th>D</th>
                        <th>L</th>
                        <th>GF</th>
                        <th>GA</th>
                        <th>GD</th>
                        <th>Pts</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="top-team">
                        <td>1</td>
                        <td><i class="fas fa-star" style="color: gold;"></i> City FC</td>
                        <td>8</td>
                        <td>7</td>
                        <td>1</td>
                        <td>0</td>
                        <td>22</td>
                        <td>6</td>
                        <td>+16</td>
                        <td><strong>22</strong></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>United</td>
                        <td>8</td>
                        <td>5</td>
                        <td>2</td>
                        <td>1</td>
                        <td>18</td>
                        <td>9</td>
                        <td>+9</td>
                        <td><strong>17</strong></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>FC Dundalk</td>
                        <td>8</td>
                        <td>5</td>
                        <td>0</td>
                        <td>3</td>
                        <td>21</td>
                        <td>12</td>
                        <td>+9</td>
                        <td><strong>15</strong></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Wanderers</td>
                        <td>8</td>
                        <td>4</td>
                        <td>1</td>
                        <td>3</td>
                        <td>15</td>
                        <td>12</td>
                        <td>+3</td>
                        <td><strong>13</strong></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Ardee FC</td>
                        <td>8</td>
                        <td>4</td>
                        <td>0</td>
                        <td>4</td>
                        <td>12</td>
                        <td>14</td>
                        <td>-2</td>
                        <td><strong>12</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="text-align: center; margin-top: 2rem;">
            @auth
                <a href="{{ url('/players') }}" class="btn-primary">View Full Fixtures</a>
            @else
                <a href="{{ route('register') }}" class="btn-primary">View Full Fixtures & Results</a>
            @endauth
        </div>
    </section>

    <!-- How It Works -->
    <section class="stats">
        <div class="stats-grid">
            <div class="stat-item">
                <h3>12+</h3>
                <p>Active Leagues</p>
            </div>
            <div class="stat-item">
                <h3>48+</h3>
                <p>Registered Teams</p>
            </div>
            <div class="stat-item">
                <h3>500+</h3>
                <p>Registered Players</p>
            </div>
            <div class="stat-item">
                <h3>150+</h3>
                <p>Matches Played</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2>Ready to Get Your League Organised?</h2>
        <p>Join the growing number of local football leagues using MatchMate.</p>
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-primary">Go to Dashboard</a>
            @else
                <a href="{{ route('register') }}" class="btn-primary">Register Now - It's Free!</a>
            @endauth
        @endif
    </section>

    <!-- Footer -->
    <footer class="footer" id="about">
        <div class="footer-content">
            <div class="footer-section">
                <h4><i class="fas fa-futbol"></i> MatchMate</h4>
                <p>Making local football leagues run smoother. From fixtures to results, everything in one place.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <p><a href="#home" style="color: #aaa; text-decoration: none;">Home</a></p>
                <p><a href="#features" style="color: #aaa; text-decoration: none;">Features</a></p>
                <p><a href="#league" style="color: #aaa; text-decoration: none;">League Table</a></p>
                <p><a href="#" style="color: #aaa; text-decoration: none;">All Fixtures</a></p>
            </div>
            <div class="footer-section">
                <h4>Contact</h4>
                <p><i class="fas fa-envelope"></i> info@matchmate.com</p>
                <p><i class="fas fa-map-marker-alt"></i> Local Football Ground</p>
                <p><i class="fas fa-clock"></i> Support: Mon-Fri, 9am-5pm</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 MatchMate. Made with <i class="fas fa-heart" style="color: #ff6b6b;"></i> for local football communities</p>
            <p style="font-size: 0.8rem; margin-top: 0.5rem;">A project by Ali Jabriil | Abdihafid Gahayr | Abdirahman Farah</p>
        </div>
    </footer>

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/homepage.js') }}"></script>
</body>
</html>