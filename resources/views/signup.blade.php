@extends('layouts.main')
@section('main-section')
    @push('title')
        <title>Sign Up</title>
    @endpush

    <div class="container" style="margin-top: 40px;">
        <div class="container signup box card p-4">
            <x-alert-component mainclass="col-12" color="primary" message="..." />
            <form method="POST" action="{{url('/auth/signup_user')}}">
                @csrf
                <x-input-component id="new_email" name="email" type="email" label="Enter Email" mainclass="mb-3"/>
                <x-input-component id="user_name" name="username" type="text" label="User Name" mainclass="mb-3"/>
                <x-input-component id="user_password" name="password" type="password" label="Password"  mainclass="mb-3"/>
                <x-input-component id="cnf_password" name="password_confirmation" type="password" label="Confirm Password"  mainclass="mb-3"/>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>  
    </div>


    
@endsection


