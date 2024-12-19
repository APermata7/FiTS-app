<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="logo">
        <ul>
            <li><a href="{{ route('homepage') }}"><img src="{{ asset('images/sidebar/home.svg') }}" alt="Home Icon" class="icon">Home</a></li>
            <li><a href="{{ route('reservasi.index') }}"><img src="{{ asset('images/sidebar/reservasi.png') }}" alt="Reservasi Icon" class="icon"> Reservasi</a></li>
            <li><a href="{{ route('chat') }}"><img src="{{ asset('images/sidebar/forum.svg') }}" alt="Forum" class="icon">Forum</a></li>
            <li><a href="{{ route('leaderboard') }}"><img src="{{ asset('images/sidebar/leaderboard.svg') }}" class="icon"> Leaderboard</a></li>
            <li><a href="{{ route('profile') }}" class="active"><img src="{{ asset('images/sidebar/profile.svg') }}" class="icon"> Profile</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">Profil</div>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="profile-card">
                <img id="profile-avatar" src="{{ asset($user->avatar ? 'storage/' . $user->avatar : 'images/default-avatar.png') }}" alt="Avatar" class="avatar">
                <div class="content">
                    <div class="name">{{ $user->name }}</div>
                    <div class="email">{{ $user->email }}</div>

                    <!-- Buttons for Edit Photo and Save aligned horizontally -->
                    <div class="button-container">
                        <button type="button" onclick="document.getElementById('avatar').click();" class="upload-btn">Edit Photo</button>
                        <input type="file" id="avatar" name="avatar" style="display: none;" onchange="previewAvatar(event)">
                        <button type="submit" class="save-btn">Save</button>
                    </div>

                    <!-- Sign out button -->
                    <button type="button" onclick="confirmLogout()" class="sign-out">Sign out</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <div class="footer-line"></div>
    <div class="footer">
        <img src="{{ asset('images/footer/footer-logo.png') }}" alt="footer-logo" class="footer-logo">
        <p>Copyright © 2024 Kelompok 5. All Rights Reserved.</p>
    </div>

    <!-- Modal Logout -->
    <div id="logout-modal" class="modal">
        <div class="modal-content">
            <p>Apakah kamu ingin keluar?</p>
            <div class="modal-buttons">
                <button onclick="cancelLogout()" class="cancel-btn">Tidak</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="confirm-btn">Iya</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Preview Avatar Function
        function previewAvatar(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const avatar = document.getElementById('profile-avatar');
                avatar.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        // Tampilkan Modal Logout
        function confirmLogout() {
            const modal = document.getElementById('logout-modal');
            modal.style.display = 'flex'; // Tampilkan modal
        }

        // Batalkan Logout
        function cancelLogout() {
            const modal = document.getElementById('logout-modal');
            modal.style.display = 'none'; // Sembunyikan modal
        }

        // Lanjutkan Logout
        function proceedLogout() {
            document.getElementById('logout-form').submit(); // Submit form logout
        }
    </script>
</body>
</html>
