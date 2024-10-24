<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HeavyMaskProject</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
</head>
<body>
<nav id="menu" class="PrincipalNav navbar navbar-expand-lg">
        <!-- Navigation menu goes here -->
        <label for="responsive-menu"></label>
        <ul class="navbar-nav">
            <li class="nav-item">
                    <a href="{{ url('/') }}"><img class="logo" src="{{ asset('images/Heavy Mask Logo.png') }}" alt="Heavy Mask Logo" /></a>
             </li>
        </ul>
    </nav>
<div class="LoginBody">

    <div class="container" id="LoginContainer">

    <form action="{{ route('Login.login') }}" method="post">
        {{csrf_field()}}

            <label for="UserName" class="UserName">User</label>
            <input class="form-control mb-5" type="text" id="UserName" name="LoginName" placeholder="Insert your User Name" required />

            <label for="PasswordHash" class="Password">Password</label>
            <input class="form-control mb-5" type="password" name="LoginPassword" id="PasswordHash" placeholder="Insert your Password" required />
            <button class="LoginBtn btn btn-primary mb-3" type="submit">Sign in</button>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"/>
                <label class="form-check-label" for="remember">Remember me!</label>
            </div>
        </form>
        <a class="/register" href="/register">Sign Admin</a>
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

