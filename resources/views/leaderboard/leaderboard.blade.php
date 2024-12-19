<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="{{ asset('css/leaderboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <img alt="Logo" class="logo" src="{{ asset('images/logo/logo.png') }}">
        <ul>
            <li><a href="{{ route('homepage') }}"><img src="{{ asset('images/sidebar/home.svg') }}" alt="Home" class="icon">Home</a></li>
            <li><a href="{{ route('reservasi.index') }}"><img src="{{ asset('images/sidebar/reservasi.png') }}" alt="Reservasi" class="icon">Reservasi</a></li>
            <li><a href="{{ route('chat') }}"><img src="{{ asset('images/sidebar/forum.svg') }}" alt="Forum" class="icon">Forum</a></li>
            <li><a class="active" href="{{ route('leaderboard') }}"><img src="{{ asset('images/sidebar/leaderboard.svg') }}" alt="Leaderboard" class="icon">Leaderboard</a></li>
            <li><a href="{{ route('profile') }}"><img src="{{ asset('images/sidebar/profile.svg') }}" alt="Profile" class="icon">Profile</a></li>
        </ul>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="header">Pencapaian</div>
        <div class="container mt-5 pt-5">
            <div class="row">
                <!-- Profil Pengguna -->
                <div class="col-md-4">
                    <div class="card p-3 shadow">
                        <div class="text-center">
                            @if (isset($leaderboardTop3) && $leaderboardTop3->isNotEmpty())
                                @foreach ($leaderboardTop3 as $leader)
                                    <img src="https://via.placeholder.com/60" alt="User Image" class="rounded-circle mb-3">
                                    <h5>{{ $leader->nama }}</h5>
                                    <p>{{ $leader->email }}</p>
                                    <span class="badge bg-warning text-dark">Rank #{{ $loop->iteration }}</span>
                                    <p>Total Reservation Time: {{ $leader->score }} mins</p>
                                @endforeach
                            @else
                                <p>No data available for top 3 leaderboard.</p>
                            @endif
                        </div>
                        <hr>
                        <h6>Weekly Progress</h6>
                        <canvas id="weeklyProgressChart" width="200" height="150"></canvas>
                    </div>
                </div>

                <!-- Leaderboard -->
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-warning text-center">
                            <h5 class="m-0">Leaderboard</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-around mb-4">
                                @if (isset($leaderboardTop3) && $leaderboardTop3->isNotEmpty())
                                    @foreach ($leaderboardTop3 as $leader)
                                        <div class="text-center">
                                            <img src="https://via.placeholder.com/60" alt="User Image" class="rounded-circle mb-3">
                                            <h5>{{ $leader->nama }}</h5>
                                            <p>{{ $leader->email }}</p>
                                            <span class="badge bg-warning text-dark">Rank #{{ $loop->iteration }}</span>
                                            <p>Total Reservation Time: {{ $leader->score }} mins</p>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No data available for the leaderboard.</p>
                                @endif
                            </div>
                            <hr>
                            <h6>Other Rankings</h6>
                            <ul class="list-group">
                                @if (isset($otherRankings) && $otherRankings->isNotEmpty())
                                    @foreach ($otherRankings as $rank)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>{{ $rank->rank }}. {{ $rank->nama }}</span>
                                            <span>{{ $rank->score }} mins</span>
                                        </li>
                                    @endforeach
                                @else
                                    <p>No additional rankings available.</p>
                                @endif
                            </ul>
                            <div class="text-center mt-3">
                                <a href="#" class="btn btn-primary">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-line"></div>
        <div class="footer">
            <img src="{{ asset('images/footer/footer-logo.png') }}" alt="footer-logo" class="footer-logo">
            <p>Copyright © 2024 Kelompok 5. All Rights Reserved.</p>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/weekly-progress-data')
            .then(response => response.json())
            .then(weeklyData => {
                const ctx = document.getElementById('weeklyProgressChart').getContext('2d');
                const chartData = {
                    labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    datasets: [{
                        label: 'Weekly Reservation Time (minutes)',
                        data: [
                            weeklyData[1] || 0, // Sunday
                            weeklyData[2] || 0, // Monday
                            weeklyData[3] || 0, // Tuesday
                            weeklyData[4] || 0, // Wednesday
                            weeklyData[5] || 0, // Thursday
                            weeklyData[6] || 0, // Friday
                            weeklyData[7] || 0, // Saturday
                        ],
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#63FF84'],
                    }]
                };

                new Chart(ctx, {
                    type: 'bar',
                    data: chartData,
                    options: { scales: { y: { beginAtZero: true } } }
                });
            });
    });
</script>
</body>
</html>