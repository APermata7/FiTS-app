<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot password</title>
    <link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}">
</head>
<body>
    <div class="login-card">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}"  alt="FiTS Logo" class="logo">
            <p class="login-box-msg">Masukkan E-mail kamu yang terdaftar</p>
        </div>
        
        <form method="POST" action="{{ route('forgot-password-act') }}">
            @csrf
            
            @session('error')
                <div class="alert" role="alert">
                    {{ $value }}
                </div>
            @endsession
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="@error('email') is-invalid @enderror" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <button type="submit" class="sign-in-button">Submit</button>
            
            </div>
        </form>
    </div>
</body>
</html>