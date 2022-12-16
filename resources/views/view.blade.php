@extends('layouts.main')
@section('main-section')

@push('title')
    <title>Students View</title>
@endpush

<x-alert-component mainclass="col-12" color="primary" message="Successful hua ree brio!" />
<div class="container viewStudents">
    <div class="viewUpperBox col-12" style="margin:16px 0px 0px 0px; display:flex; flex-direction:row; justify-content:space-between;">
        <form action="{{('/students/view')}}" method="get" style="display: inline-block;">
            <div class="input-group mx-1">
                <input type="text" class="form-control" placeholder="Search name here" value="{{old("searchForm")}}" name="searchForm" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <div class="upperBoxBtns" style="display: inline-block;">
            <a href="{{url("/students/input")}}" class="mx-2"><button class="btn btn-outline-secondary">Add Student</button></a>
            <a href="{{$trashURL}}" class="mx-2"><button class="btn btn-outline-secondary">{{$trashBtn}}</button></a>
        </div>
    </div>
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
            <th scope="col">Action</th>
            </tr>
        </thead>                                                                                                                    
        <tbody>
            @if (!isset($students) || count($students)<1)
                <h3 class="my-2 mx-2"> {{"Please add some students 🤓"}} </h3>           
            @endif
            @foreach($students as $key=>$student)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$student->div}}</td>
                    <td>{{$student->roll_no}}</td>
                    <td>{{$student->student_id}}</td>
                    <td>{{$student->name}}</td>
                    <td>@if (($student->gender)=='M')
                        Male
                        @else
                        Female
                        @endif 
                    </td>
                    <td>{{get_formatted_date(($student->updated_at), 'd-M-Y')}}</td>
                    <td>
                        <a href="{{$viewEditURL}}/{{$student->id}}"><span class="badge bg-primary p-2">{{$viewEditBtn}}</span></a>
                        <a href="{{$viewDeleteURL}}/{{$student->id}}"><span class="badge bg-danger p-2">{{$viewDeleteBtn}}</span></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row center p-2" style="align-items: center; text-align:center;">
        {{$students->links()}}
    </div>
</div>

    
@endsection
