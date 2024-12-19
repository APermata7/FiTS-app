<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>
<body>
    <div class="sidebar">
        <img alt="Logo" class="logo" src="{{ asset('images/logo/logo.png') }}">
        <ul>
            <li><a class="active" href="#"><img src="{{ asset('images/sidebar/home.svg') }}" alt="Home" class="icon">Home</a></li>
            <li><a href="{{ route('reservasi.index') }}"><img src="{{ asset('images/sidebar/reservasi.png') }}" alt="Reservasi" class="icon">Reservasi</a></li>
            <li><a href="{{ route('chat') }}"><img src="{{ asset('images/sidebar/forum.svg') }}" alt="Forum" class="icon">Forum</a></li>
            <li><a href="{{ route('leaderboard') }}"><img src="{{ asset('images/sidebar/leaderboard.svg') }}" alt="Leaderboard" class="icon">Leaderboard</a></li>
            <li><a href="{{ route('profile') }}"><img src="{{ asset('images/sidebar/profile.svg') }}" alt="Profile" class="icon">Profile</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header">
            Home
        </div>
        <div class="main-image">
            <h1>Ruang Kerja Bersama</h1>
            <p>
            Jadikan ruang kerja bersama sebagai tempat <br> untuk berkolaborasi, berkreasi, dan menginspirasi ide-ide hebatmu!
            </p>
        </div>
        <div class="cards">
            <div class="title">
                Fasilitas
            </div>
            <div class="card">
                <img alt="Meja" height="206" src="{{ asset('images/background/meja.jpg') }}" width="260"/>
                <div class="text">
                    <p> 
                        Ruang kerja bersama dilengkapi dengan meja yang dirancang untuk menunjang produktivitas. Meja ini memiliki permukaan yang luas, ideal untuk berbagai kebutuhan kerja, mulai dari penggunaan laptop, dokumen, hingga peralatan kerja lainnya.
                    </p>
                </div>
            </div>
            <div class="card">
                <img alt="Kursi" height="206" src="{{ asset('images/background/kursi.jpg') }}" width="260"/>
                <div class="text">
                    <p>
                    Kursi dilengkapi bantalan empuk dan roda fleksibel untuk mendukung kenyamanan serta mobilitas saat bekerja. Tingginya dapat disesuaikan sesuai kebutuhan, cocok untuk berbagai aktivitas di ruang kerja bersama.
                    </p>    
                </div>
            </div>
            <div class="card">
                <img alt="Colokan" height="206" src="{{ asset('images/background/colokan.jpg') }}" width="260"/>
                <div class="text">
                    <p>
                        Setiap meja dilengkapi dengan colokan listrik yang mudah diakses, memastikan kemudahan untuk mengisi daya perangkat elektronik Anda tanpa hambatan.
                    </p>
                </div>
            </div>
        </div>
        <div class="footer-line"></div>
        <div class="footer">
            <img src="{{ asset('images/footer/footer-logo.png') }}" alt="FiTS Logo">
            Copyright © 2024 Kelompok 5. All Rights Reserved.
        </div>
    </div>
</body>
</html>
