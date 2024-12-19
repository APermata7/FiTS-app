<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Ketersediaan Ruang Kerja Bersama</title>
    <link rel="stylesheet" href="{{ asset('css/reservasi-status.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <div class="header">Status Ketersediaan Ruang Kerja Bersama</div>
        <div class="p">Ayo cek mana yang masih kosong!</div>
        <div class="room-grid">
            @forelse($meja as $item)
                <div class="table {{ $item->status ? 'booked' : 'available' }}">
                    <!-- Menampilkan kursi terkait dengan meja -->
                    @if ($item->seats && $item->seats->count())
                    @foreach ($item->seats as $kursi)
                        <div class="seat {{ $kursi->availability ? 'available-seat' : 'booked-seat' }}">
                            <!-- Menampilkan nomor kursi -->
                            {{ $kursi->seat_number }}
                        </div>
                    @endforeach
                    @else
                    <!-- Tombol Meja -->
                    <button class="table-number" 
                            data-table="{{ $item->nomor_meja }}" 
                            data-status="{{ $item->status ? 'Booked' : 'Available' }}" 
                            data-seats="{{ count($item->seats) }}" 
                            onclick="openPopup(this)">
                        Meja {{ $item->nomor_meja }}
                    </button>
                </div>
                @endif
            @empty
                @for ($i = 1; $i <= 6; $i++)
                    <div class="table available">
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
                        <button class="table-number" data-table="{{ $i }}" onclick="openPopup(this)">
                            Meja {{ $i }}
                        </button>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>

    <div class="footer-line"></div>
    <div class="footer">
        <img src="{{ asset('images/footer/footer-logo.png') }}" alt="footer-logo" class="footer-logo">
        <p>Copyright © 2024 Kelompok 5. All Rights Reserved.</p>
    </div>

    <!-- Status Popup -->
    <div class="overlay" id="popupOverlay">
        <div class="popup" id="statusPopup">
            <button class="close-btn" onclick="closeStatusPopup()">
                <img src="{{ asset('images/icons/back.svg') }}" alt="Status Icon">
            </button>
            
            <h2>Status Ketersediaan</h2>
            <div class="divider"></div>
            
            <div class="table-status" id="tableNumber"></div>
            
            <div class="status-item">
                <img src="{{ asset('images/icons/status-meja.svg') }}" alt="Status Icon">
                <input type="text" class="status-input" id="tableStatus" readonly>
            </div>
            
            <div class="status-item">
                <img src="{{ asset('images/icons/ketersediaan-kursi.svg') }}" alt="Seats Icon">
                <input type="text" class="status-input" id="seatAvailability" readonly>
            </div>
            
            <button class="reserve-btn" onclick="openBookingModal()">Buat Reservasi</button>
        </div>
    </div>

    <!-- Booking Form Modal -->
    <form id="bookingForm" method="POST" action="{{ route('reservasi.store') }}" style="display:none;" class="modal">
        @csrf
        <div class="modal-content">
            <button class="close" onclick="closeBookingModal()">
                <img src="{{ asset('images/icons/back.svg') }}" alt="Status Icon">
            </button>
            
            <h2>Buat Reservasi</h2>
            <div class="divider"></div>

            <label for="name">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama" required />

            <label for="phone">Nomor Telepon</label>
            <input type="tel" id="nomor_telepon" name="nomor_telepon" placeholder="08xxxxxxxxxx" required />

            <label for="email">Email</label>
            <input type="email" id="email" placeholder="nama@gmail.com" required />

            <label for="table">Meja</label>
            <input type="text" id="meja" name="meja" value="" readonly />

            <label for="date">Tanggal</label>
            <input type="date" id="tanggal" required />

            <label for="timeStart">Waktu Mulai</label>
            <input type="time" id="waktu_mulai" required />

            <label for="timeEnd">Waktu Selesai</label>
            <input type="time" id="waktu_selesai" required />

            <button type="submit" class="submit-btn">Booking</button>
        </div>
    </form>

    <!-- Success Popup -->
    <div id="successPopup" class="successModal">
        <div class="modal-content-success">
            <button class="close-success" onclick="closeSuccessPopup()">
                <img src="{{ asset('images/icons/back.svg') }}" alt="Close Icon">
            </button>
            <div class="popup-header">
                <img src="{{ asset('images/icons/sukses.svg') }}" alt="Icon Sukses" class="success-icon">
                <h2>Reservasi <span id="popupTableName"></span> Berhasil</h2>
            </div>
            <div class="divider"></div>
            <div class="popup-body">
                <p id="popupNama" class="popup-text"></p>
                <div class="divider"></div>
                <p id="popupPhone" class="popup-text"></p>
                <div class="divider"></div>
                <p id="popupDateTime" class="popup-text"></p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
        // Fungsi membuka status popup
        function openPopup(button) {
            const tableNumber = button.getAttribute('data-table');
            const tableStatus = button.getAttribute('data-status');
            const seatAvailability = button.getAttribute('data-seats');
            
            document.getElementById('popupOverlay').classList.add('active');
            document.getElementById('statusPopup').classList.add('active');
            
            document.getElementById('tableNumber').innerText = 'Meja ' + tableNumber;
            document.getElementById('tableStatus').value = tableStatus;
            document.getElementById('seatAvailability').value = seatAvailability;
        }

        // Fungsi menutup popup status
        function closeStatusPopup() {
            document.getElementById('popupOverlay').classList.remove('active');
            document.getElementById('statusPopup').classList.remove('active');
        }

        // Membuka modal booking
        function openBookingModal() {
            const tableNumber = document.getElementById('tableNumber').innerText.split(' ')[1];
            document.getElementById('meja').value = tableNumber;

            document.getElementById('statusPopup').classList.remove('active');
            document.getElementById('bookingForm').style.display = 'flex';
        }

        // Menutup form booking
        function closeBookingModal() {
            document.getElementById('bookingForm').style.display = 'none';
            document.getElementById('statusPopup').classList.add('active');
        }

        // Menampilkan popup sukses
        function showSuccessPopup(reservation) {
            document.getElementById('popupTableName').innerText = reservation.table;
            document.getElementById('popupNama').innerText = 'Nama: ' + reservation.name;
            document.getElementById('popupPhone').innerText = 'Telepon: ' + reservation.phone;
            document.getElementById('popupDateTime').innerText = `Tanggal: ${reservation.date}, ${reservation.time}`;
            
            document.getElementById('successPopup').classList.add('active');
        }

        function closeSuccessPopup() {
            document.getElementById('successPopup').classList.remove('active');
        }

        document.getElementById('bookingForm').addEventListener('submit', function (event) {
            event.preventDefault(); 

            const reservationData = {
                _token: "{{ csrf_token() }}",
                nama_lengkap: document.getElementById('nama_lengkap').value,
                nomor_telepon: document.getElementById('nomor_telepon').value,
                email: document.getElementById('email').value,
                meja_id: document.getElementById('meja').value,
                tanggal: document.getElementById('tanggal').value,  
                waktu_mulai: document.getElementById('waktu_mulai').value,
                waktu_selesai: document.getElementById('waktu_selesai').value,
            };

            const formData = new FormData();
            Object.keys(reservationData).forEach(key => {
                formData.append(key, reservationData[key]);
            });

            fetch("{{ route('reservasi.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Tutup pop-up status
                    closeStatusPopup();

                    // Jika berhasil, tampilkan pop-up sukses
                    showSuccessPopup({
                        table: reservationData.meja,
                        name: reservationData.nama_lengkap,
                        phone: reservationData.nomor_telepon,
                        date: `${reservationData.tanggal} (${reservationData.waktu_mulai} - ${reservationData.waktu_selesai})`
                    });
                    closeBookingModal(); // Pastikan form booking ditutup
                } else {
                    alert(data.message || 'Gagal membuat reservasi. Silakan coba lagi.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan, silakan coba lagi.');
            });
        });

        window.openPopup = openPopup;
        window.closeStatusPopup = closeStatusPopup;
        window.openBookingModal = openBookingModal;
        window.closeBookingModal = closeBookingModal;
        window.closeSuccessPopup = closeSuccessPopup;
    });
</script>
</body>
</html>
