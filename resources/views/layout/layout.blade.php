<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - HeavyMaskProject</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/site.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/shirtList.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/productInsert.css') }}" />
    <!-- In the <head> section -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- At the end of the <body> section, before other scripts -->
    
</head>
<body>
    <nav id="menu" class="PrincipalNav navbar navbar-expand-lg">
        <!-- Navigation menu goes here -->
        <label for="responsive-menu"></label>
        <ul class="navbar-nav">
            <li class="nav-item">
                    <a href="{{ url('/') }}"><img class="logo" src="{{ asset('images/Heavy Mask Logo.png') }}" alt="Heavy Mask Logo" /></a>
             </li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Admins</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Users</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Products Insert</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Orders</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Sales Board</a></li>
        </ul>
    </nav>
    <div class="mainSection">
    @yield('content')
    </div>
        
    <footer class="bg-dark text-white text-center py-3">
        <div>
           &copy; 2024 Heavy Mask
        </div>
    </footer>

  
</body>
</html>
