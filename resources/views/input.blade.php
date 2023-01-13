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

    $msg = "...";
    if (session()->has("alertMsg")) {
        $msg = session()->get("alertMsg");
    }
@endphp

<div class="container my-4">
    <x-alert-component mainclass="col-12" color="primary" message="{{$msg}}" />
    <h2>{{ucwords(session()->get('username'))}}</h2>
    <span class="text-danger">
        @if (session()->has('duplicateRecordError'))
            {{session()->get('duplicateRecordError')}}
        @endif
    </span>
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
            <span class="badge bg-success p-3">{{$total_tuples}}</span>
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

        <div class="col-12 my-4" style="display: flex; align-items:center; justify-content:center;">
            <button type="submit" class="btn btn-primary col-md-8" > Add Student</button>
        </div>
        </form>
</div>
<script>
    
</script>

@endsection