<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HeavyMaskProject</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <nav id="menu" class="PrincipalNav navbar navbar-expand-lg">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{ url('/') }}"><img class="logo" src="{{ asset('images/Heavy Mask Logo.png') }}" alt="Heavy Mask Logo"></a>
            </li>
        </ul>
    </nav>

    <div class="LoginBody">
        <div class="container" id="LoginContainer">
            <form action="{{ route('Register.register') }}" method="post">
                @csrf 
                
                <label for="username" class="UserName">Username</label>
                <input class="form-control mb-3" type="text" id="username" name="username" placeholder="Insert your Username" required>

                <label for="password" class="Password">Password</label>
                <input class="form-control mb-3" type="password" id="password" name="password" placeholder="Insert your Password" required>

                <label for="password_confirmation" class="PasswordConfirmation">Confirm Your Password</label>
                <input class="form-control mb-5" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your Password" required>

                <button class="LoginBtn btn btn-primary mb-3" type="submit">Register</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3">
        <div>
            &copy; 2024 Heavy Mask
        </div>
    </footer>
</body>
</html>
