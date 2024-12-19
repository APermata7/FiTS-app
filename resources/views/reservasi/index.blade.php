<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Ruang Kerja Bersama</title>
    <link rel="stylesheet" href="{{ asset('css/reservasi-index.css') }}">
</head>
<body>
    <div class="sidebar">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="logo">
        <ul>
            <li><a href="{{ route('homepage') }}"><img src="{{ asset('images/sidebar/home.svg') }}" alt="Home Icon" class="icon">Home</a></li>
            <li><a href="{{ route('reservasi.index') }}" class="active"><img src="{{ asset('images/sidebar/reservasi.png') }}" class="icon"> Reservasi</a></li>
            <li><a href="{{ route('chat') }}"><img src="{{ asset('images/sidebar/forum.svg') }}" alt="Forum" class="icon">Forum</a></li>
            <li><a href="{{ route('leaderboard') }}"><img src="{{ asset('images/sidebar/leaderboard.svg') }}" class="icon"> Leaderboard</a></li>
            <li><a href="{{ route('profile') }}"><img src="{{ asset('images/sidebar/profile.svg') }}" class="icon"> Profile</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">Reservasi Ruang Kerja Bersama</div>

        <div class="search-bar">
            <div class="search-container">
                <div class="input-with-icon">
                    <input type="text" class="search-input" placeholder="Search Name">
                    <img src="{{ asset('images/icons/search.svg') }}" alt="Search" class="search-icon">
                </div>
            </div>

            <div class="filter-container">
                <input type="date" class="date-input" placeholder="Date">
                <input type="time" id="time-start" class="time" required />
                <input type="time" id="time-end" class="time" required />
            </div>
        </div>

        <div class="room-grid">
            @forelse ($meja as $item)
                <div class="table {{ $item->status ? 'booked' : 'available' }}">
                    <!-- Menampilkan kursi terkait dengan meja -->
                    @foreach ($item->seats as $kursi)
                        <div class="seat {{ $kursi->availability ? 'available-seat' : 'booked-seat' }}">
                            <!-- Menampilkan nomor kursi -->
                            {{ $kursi->seat_number }}
                        </div>
                    @endforeach

                    <!-- Layout default kursi -->
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>

                    <div class="seat seat-top-left"></div>
                    <div class="seat seat-top-center-left"></div>
                    <div class="seat seat-top-center-right"></div>
                    <div class="seat seat-top-right"></div>
                    <div class="seat seat-bottom-left"></div>
                    <div class="seat seat-bottom-center-left"></div>
                    <div class="seat seat-bottom-center-right"></div>
                    <div class="seat seat-bottom-right"></div>
                </div>
            @empty
                {{-- Layout default jika data meja kosong --}}
                @for ($i = 0; $i < 6; $i++) 
                    <div class="table available">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>

                        <div class="seat seat-top-left"></div>
                        <div class="seat seat-top-center-left"></div>
                        <div class="seat seat-top-center-right"></div>
                        <div class="seat seat-top-right"></div>
                        <div class="seat seat-bottom-left"></div>
                        <div class="seat seat-bottom-center-left"></div>
                        <div class="seat seat-bottom-center-right"></div>
                        <div class="seat seat-bottom-right"></div>
                    </div>
                @endfor
            @endforelse
        </div>

        <a href="{{ route('reservasi.status') }}" class="no-underline">
            <button class="booking-button">BOOKING</button>
        </a>
    </div>
    <div class="footer-line"></div>
    <div class="footer">
        <img src="{{ asset('images/footer/footer-logo.png') }}" alt="footer-logo" class="footer-logo">
        <p>Copyright © 2024 Kelompok 5. All Rights Reserved.</p>
    </div>
</body>
</html>