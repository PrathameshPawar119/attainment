@extends('layouts.main')
@section('main-section')

<div class="container oralPage">
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
    <table class="table my-2 table-hover">
    <thead>
        <tr>
        <th scope="col">Sr. No</th>
        <th scope="col">DIV</th>
        <th scope="col">Roll No.</th>
        <th scope="col">Student ID</th>
        <th scope="col">Name</th>
        <th scope="col">Oral-Practical</th>
        </tr>
    </thead>
    <tbody>
        @if (!isset($students))
            {{"Please add some students Please"}}            
        @endif
            @foreach($students as $key=>$student)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$student->div}}</td>
                    <td>{{$student->roll_no}}</td>
                    <td>{{$student->student_id}}</td>
                    <td>{{$student->name}}</td>
                    <td><input type="number" value=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row center p-2" style="align-items: center; text-align:center;">
        {{$students->links()}}
    </div>
</div>
    
@endsection