@extends('layouts.main')
@section('main-section')

@push('title')
    <title>Edit Student</title>
@endpush

@php
    $divs = array("A", "B");
    $genders = array("M", "F");
@endphp

<div class="container my-4">
    <x-alert-component mainclass="col-12" color="primary" message="Alert component needed to be done!" />
    <h2>{{session()->get('username')}}</h2>
    <span class="text-danger">
        @if (session()->has('duplicateRecordError'))
            {{session()->get('duplicateRecordError')}}
        @endif
    </span>
    <form class="row g-3" method="POST" action="{{url("/students/view/updatestudent")}}/{{$student->id}}">
        @csrf
        <x-vinput mainclass="col-md-2" id="roll_no" name="roll_no" type="number" label="Roll No." value="{{$student->roll_no}}" />
        <x-vinput mainclass="col-md-6" id="student_id" name="student_id" type="text" label="Student ID" value="{{$student->student_id}}" />
        <div class="col-md-2">
            <label for="inputDiv" class="form-label">DIV</label>
            <select id="inputDiv" class="form-select" name="div" value="{{$student->div}}">
                {{-- Set Default Division Feature remaining --}}
                <option value="">Select</option>
                @foreach ($divs as $key=>$div)
                    <option class="p-2" value="{{$div}}" @if ($student->div==$div) selected @endif>{{$div}}</option>
                @endforeach
            </select>
            <span class="text-danger">
                @error('div')
                    {{$message}}
                @enderror
            </span>
        </div>
        <x-vinput mainclass="col-md-10" id="student_name" name="student_name" type="text" label="Name" value="{{$student->name}}" />
        <div class="col-md-2">
            <label for="inputGender" class="form-label">Gender</label>
            <select id="inputGender" class="form-select" name="gender" value="{{$student->gender}}">
                <option value="">Select</option>
                @foreach ($genders as $key=>$gender)
                    <option value="{{$gender}}" @if ($student->gender==$gender) selected @endif>{{$gender}}</option>
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

@endsection