<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot password</title>
    <link rel="stylesheet" href="{{ asset('css/validasi-token.css') }}">
</head>
<body>
    <div class="login-card">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}"  alt="FiTS Logo" class="logo">
            <p class="login-box-msg">Masukkan Password Baru Kamu</p>
        </div>
        
        <form method="POST" action="{{ route('validasi-forgot-password-act') }}">
            @csrf
            
            @session('error')
                <div class="alert" role="alert">
                    {{ $value }}
                </div>
            @endsession
            
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" class="form-control" placeholder="Masukkan Password Baru">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <button type="submit" class="sign-in-button">Submit</button>
            
            </div>
        </form>
    </div>
</body>
</html>