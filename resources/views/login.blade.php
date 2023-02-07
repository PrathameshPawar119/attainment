@extends('layouts.main')
@section('main-section')
    @push('title')
        <title>Login</title>
    @endpush
    @php
        $msg = "...";
        if (session()->has("alertMsg")) {
            $msg = session()->get("alertMsg");
        };
    @endphp

    <style>
        .loginLogo{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .loginLogo img{
            margin: 10px auto;
            width: 44%;
            height: 26%;
        }
    </style>


    <div class="container">
        <div class="container loginpage">
        <x-alert-component mainclass="col-12" color="primary" message="{{$msg}}" />
            <div class="card p-5" style="margin:20px auto; width:80%;">
                <div class="loginLogo col-12">
                    <img src="{{asset('images/mylogo.png')}}" alt="">
                </div>
                <h4>Sign In</h4>
                <form action="{{url('/auth/login_user')}}" method="POST" class="my-3">
                    @csrf
                    <x-input-component type="text" id="login_varify" name="user_credential" label="Email or Username " mainclass="mb-3" />
                    <x-input-component type="password" id="login_passw" name="login_password" label="Password" mainclass="mb-3" />
                    <center> <button type="submit" class="btn btn-primary my-3 col-md-6" >Submit </button></center>
                    <center>
                        <span>Didn't Registered yet?, <a href="{{url('/auth/signup_page')}}">Register here</a></span>
                    </center>
                </form>
            </div>
        </div>
    </div>
@endsection