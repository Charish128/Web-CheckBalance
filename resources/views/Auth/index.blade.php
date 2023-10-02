<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Login and Registration Form in HTML & CSS | CodingLab </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div class="container r">
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
            </div>
            <div class="back">
                <!--<img class="backImg" src="images/backImg.jpg" alt="">-->
                <div class="text">
                    <span class="text-1">Complete miles of journey <br> with one step</span>
                    <span class="text-2">Let's get started</span>
                </div>
            </div>
        </div>
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    @if (session('success'))
                        <p>{{ session('success') }}</p>
                    @endif
                    @if (session('error'))
                        <p>{{ session('error') }}</p>
                    @endif
                    <div class="title">Login</div>
                    <form action="{{url('login')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="Enter your email" required>
                                @error('email')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Enter your password" required>
                                @error('password')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Sumbit">
                            </div>
                            <div class="text sign-up-text">Don't have an account? <label for="flip">Sign up
                                    now</label></div>
                        </div>
                    </form>
                </div>
                <div class="signup-form">
                    <div class="title">Signup</div>
                    <form action="{{ url('daftar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" name="nama" placeholder="Enter your name" required>
                                @error('nama')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="Enter your email" required>
                                @error('email')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Enter your password" required>
                                @error('password')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Sumbit">
                            </div>
                            <div class="text sign-up-text">Already have an account? <label for="flip">Login
                                    now</label></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
