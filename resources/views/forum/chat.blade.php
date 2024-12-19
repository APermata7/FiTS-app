<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat</title>
    <link rel="stylesheet" href="{{ asset('css/forum.css') }}">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <img alt="Logo" class="logo" src="{{ asset('images/logo/logo.png') }}">
            <ul>
                <li><a href="{{ route('homepage') }}"><img src="{{ asset('images/sidebar/home.svg') }}" alt="Home" class="icon">Home</a></li>
                <li><a href="{{ route('reservasi.index') }}"><img src="{{ asset('images/sidebar/reservasi.png') }}" alt="Reservasi" class="icon">Reservasi</a></li>
                <li><a class="active" href="{{ route('chat') }}"><img src="{{ asset('images/sidebar/forum.svg') }}" alt="Forum" class="icon">Forum</a></li>
                <li><a href="{{ route('leaderboard') }}"><img src="{{ asset('images/sidebar/leaderboard.svg') }}" alt="Leaderboard" class="icon">Leaderboard</a></li>
                <li><a href="{{ route('profile') }}"><img src="{{ asset('images/sidebar/profile.svg') }}" alt="Profile" class="icon">Profile</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">Forum Discussion</div>
            <div id="chat-container" class="chat-container">
                <div id="chat-bubbles" class="chat-messages"></div>
                <div class="chat-input">
                    <form id="chat-form">
                        <textarea id="message" name="message" placeholder="Type your message..."></textarea>
                        <button type="submit" class="custom-button">Send</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <div class="footer">
        <img src="{{ asset('images/footer/footer-logo.png') }}" alt="footer-logo" class="footer-logo">
        <p>Copyright © 2024 Kelompok 5. All Rights Reserved.</p>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        const chatBubbles = $('#chat-bubbles');
        const chatForm = $('#chat-form');
        const messageInput = $('#message');

        // Fungsi untuk mengambil pesan dari server
        function fetchMessages() {
            $.ajax({
                url: "{{ route('chat.fetch') }}",
                method: "GET",
                success: function (response) {
                    if (response.messages) {
                        chatBubbles.empty(); // Kosongkan kontainer pesan
                        response.messages.forEach(function (message) {
                            const isCurrentUser = message.from_user_id == "{{ auth()->id() }}" ? 'current-user' : 'other-user';
                            const messageTime = new Date(message.created_at).toLocaleTimeString(); // Mendapatkan waktu dari timestamp pesan
                            
                            const messageHTML = `
                    <div class="chat-bubble ${isCurrentUser}">
                        <div class="chat-header">
                            <img id="profile-avatar" src="{{ asset($user->avatar ? 'storage/' . $user->avatar : 'images/default-avatar.png') }}" alt="Avatar" class="avatar">
                            <span class="username">${message.from_user?.name || 'Unknown User'}</span>
                        </div>
                        <div class="chat-content">
                            <span class="message-text">${message.message}</span>
                        </div>
                        <div class="chat-footer">
                            <span class="message-time">${messageTime}</span>
                        </div>
                    </div>
                `;
                            chatBubbles.prepend(messageHTML); // Menambahkan pesan terbaru ke atas
                        });
                    }
                }
            });
        }

        // Fungsi untuk mengirim pesan
        chatForm.on('submit', function (e) {
            e.preventDefault();

            const message = messageInput.val().trim();
            if (!message) return;

            $.ajax({
                url: "{{ route('chat.send') }}",
                method: "POST",
                data: {
                    message: message,
                    _token: "{{ csrf_token() }}",
                },
                success: function () {
                    messageInput.val(''); // Kosongkan input setelah mengirim pesan
                    fetchMessages(); // Ambil pesan terbaru setelah mengirim pesan
                }
            });
        });

        // Fetch pesan setiap 2 detik
        setInterval(fetchMessages, 2000);

        // Inisialisasi fetch pertama
        fetchMessages();
    });
    </script>
</body>
</html>
