@extends('layout.layout')

@section('title', 'Login')

@section('content')
<div class="LoginBody">

    <div class="container" id="LoginContainer">

    <form action="" method="post">
        {{csrf_field()}}

            <label for="UserName" class="UserName">User</label>
            <input class="form-control mb-5" type="text" id="UserName" name="LoginEmail" placeholder="Insert your User Name" required />

            <label for="PasswordHash" class="Password">Password</label>
            <input class="form-control mb-5" type="password" name="LoginPassword" id="PasswordHash" placeholder="Insert your Password" required />
            <button class="LoginBtn btn btn-primary mb-3" type="submit">Sign in</button>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"/>
                <label class="form-check-label" for="remember">Remember me!</label>
            </div>
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
@endsection
