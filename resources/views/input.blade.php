@extends('layouts.main')
@section('main-section')

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


    // if ($last_tuple) {
        
    // }

@endphp

<div class="container my-4">
    <x-alert-component mainclass="col-12" color="primary" message="{{$msg}}" />
    <div class="card p-4">
        <h2>{{ucwords(session()->get('username'))}}</h2>
        <span class="text-danger">
            @if (session()->has('duplicateRecordError'))
                {{session()->get('duplicateRecordError')}}
            @endif
        </span>
        <form class="row g-3" method="POST" action="{{url("/students/input/addstudent")}}">
            @csrf
            <x-vinput mainclass="col-md-2" id="roll_no" name="roll_no" type="number" label="Roll No." value="{{$total_tuples ? ($last_record->roll_no+1):1}}"/>
            <x-input-component mainclass="col-md-6" id="student_id" name="student_id" type="text" label="Student ID" />
            <div class="col-md-2">
                <label for="inputDiv" class="form-label">DIV</label>
                <select id="inputDiv" class="form-select" name="div" value="{{old('div')}}">
                    {{-- Set Default Division Feature remaining --}}
                    <option value="">Select</option>
                    @foreach ($divs as $key=>$div)
                        <option class="p-2" value="{{$div}}" {{($total_tuples) && ($div==$last_record->div) ? 'selected' :''}}>{{$div}}</option>
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

        {{-- Show last record added for easy user Xperience --}}
        <br/>
        <h5>Last Record Added →</h5>
        <table class="table my-4 table-hover">
        <thead>
            <tr>
            <th scope="col">Sr. No</th>
            <th scope="col">DIV</th>
            <th scope="col">Roll No.</th>
            <th scope="col">Student ID</th>
            <th scope="col">Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Last Modified</th>
            </tr>
        </thead>                                                                                                                    
        <tbody>
            @if (!($total_tuples))
                <h3 class="my-2 mx-2"> {{"Ready to add first Student !"}} </h3>           
                @else
                <tr>
                    <td>{{$total_tuples}}</td>
                    <td>{{$last_record->div}}</td>
                    <td>{{$last_record->roll_no}}</td>
                    <td>{{$last_record->student_id}}</td>
                    <td>{{$last_record->name}}</td>
                    <td>@if (($last_record->gender)=='M')
                        Male
                        @else
                        Female
                        @endif 
                    </td>
                    <td>{{get_formatted_date(($last_record->updated_at), 'd-M-Y')}}</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
<script>
    
</script>

@endsection