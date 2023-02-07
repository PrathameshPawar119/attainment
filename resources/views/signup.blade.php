@extends('layouts.main')
@section('main-section')
    @push('title')
        <title>Sign Up</title>
    @endpush
    
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
        <div class="container signup box mt-2">
            <x-alert-component mainclass="col-12" color="primary" message="..." />
            <div class="form card p-4 box" style="width:80%; margin:10px auto;">
                <div class="loginLogo col-12">
                    <img src="{{asset('images/mylogo.png')}}" alt="">
                </div>
                <h4>Sign Up</h4>
                <form method="POST" action="{{url('/auth/signup_user')}}">
                    @csrf
                    <x-input-component id="new_email" name="email" type="email" label="Enter Email" mainclass="mb-3"/>
                    <x-input-component id="user_name" name="username" type="text" label="User Name" mainclass="mb-3"/>
                    <x-input-component id="user_password" name="password" type="password" label="Password"  mainclass="mb-3"/>
                    <x-input-component id="cnf_password" name="password_confirmation" type="password" label="Confirm Password"  mainclass="mb-3"/>
                    <center>
                        <button type="submit" class="btn btn-primary col-md-8">Submit</button>
                    </center>
                </form>
            </div>
        </div>  
    </div>


    
@endsection


