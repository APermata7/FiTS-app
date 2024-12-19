<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FiTS Registrasi</title>
    <link rel="stylesheet" href="{{ asset('css/registrasi.css') }}">
</head>
<body>
    <div class="register-card">
        <div class="logo-container">
            <img src="{{ asset('images/logo/logo.png') }}" alt="FiTS Logo" class="logo">
        </div>
        
        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            @session('error')
                <div class="alert" role="alert">
                    {{ $value }}
                </div>
            @endsession
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="@error('email') is-invalid @enderror" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="@error('password_confirmation') is-invalid @enderror" required>
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="sign-up-button">Sign Up</button>
            
            <p class="signin-text">
                Have an account?<a href="{{ route('login') }}">Sign in</a>
            </p>
        </form>
    </div>
</body>
</html>