@extends('layouts.main')
@section('main-section')

    @if (!session()->has('user_id'))
        {{header('Location: ')}}
    @endif

@push('title')
    <title>Input</title>
@endpush

@php
    $divs = array("A", "B");
    $genders = array("M", "F");
@endphp

<div class="container my-4">
    <x-alert-component mainclass="col-12" color="primary" message="Successful hua ree brio!" />
    <h2>{{session()->get('username')}}</h2>
    <form class="row g-3" method="POST" action="{{url("/students/input/addstudent")}}">
        @csrf
        <x-input-component mainclass="col-md-2" id="roll_no" name="roll_no" type="number" label="Roll No." />
        <x-input-component mainclass="col-md-6" id="student_id" name="student_id" type="text" label="Student ID" />
        <div class="col-md-2">
            <label for="inputDiv" class="form-label">DIV</label>
            <select id="inputDiv" class="form-select" name="div" value="{{old('div')}}">
                {{-- Set Default Division Feature remaining --}}
                <option value="">Select</option>
                @foreach ($divs as $key=>$div)
                    <option class="p-2" value="{{$div}}">{{$div}}</option>
                @endforeach
            </select>
            <span class="text-danger">
                @error('div')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="col-md-2 p-4">
            <span class="badge bg-success p-3">87</span>
        </div>
        <x-input-component mainclass="col-md-10" id="student_name" name="student_name" type="text" label="Name" />
        <div class="col-md-2">
            <label for="inputGender" class="form-label">Gender</label>
            <select id="inputGender" class="form-select" name="gender">
                <option value="">Select</option>
                @foreach ($genders as $key=>$gender)
                    <option value="{{$gender}}" @if (old($gender)==$gender) selected @endif>{{$gender}}</option>
                @endforeach
            </select>
            <span class="text-danger">
                @error('gender')
                    {{$message}}
                @enderror
            </span>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
        </form>
</div>

@endsection