@extends('layouts.main')
@section('main-section')
    @push('title')
        <title>Login</title>
    @endpush

    <div class="container">
        <div class="container loginpage">
        <x-alert-component mainclass="col-12" color="primary" message="Successful hua ree brio!" />
            <form action="{{url('/auth/login_user')}}" method="POST" class="my-3">
                @csrf
                <x-input-component type="text" id="login_varify" name="user_credential" label="Email or Username " mainclass="mb-3" />
                <x-input-component type="password" id="login_passw" name="login_password" label="Password" mainclass="mb-3" />
                <button type="submit" class="btn btn-primary">Submit </button>
                <center>
                    <span>Didn't Registered yet?, <a href="{{url('/auth/signup_page')}}">Register here</a></span>
                </center>
            </form>
        </div>
    </div>
@endsection