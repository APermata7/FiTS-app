<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FiTS Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-card">
        <div class="logo-container">
            <img src="{{ asset('images/logo/logo.png') }}"  alt="FiTS Logo" class="logo">
        </div>
        
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            
            @session('error')
                <div class="alert" role="alert">
                    {{ $value }}
                </div>
            @endsession
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="text" id="email" name="email" class="@error('username') is-invalid @enderror" required>
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
                <div class="forgot-password">
                <a href="#!" class="link-primary text-decoration-none">{{ __(' I forgot my password') }}</a>
                </div>
            </div>
            
            <button type="submit" class="sign-in-button">Sign In</button>
            
            <p class="signup-text">
                Don't have an account?<a href="{{ route('register') }}">Sign up</a>
            </p>
        </form>
    </div>
</body>
</html>