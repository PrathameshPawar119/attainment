@extends('layouts.main')
@section('main-section')

@push('title')
    <title>Students View</title>
@endpush
@php
    $msg = "...";
    if (session()->has("alertMsg")) {
        $msg = session()->get("alertMsg");
    }
@endphp
<style>
.studentModalBtn{
    transition: all 0.3s ease;
} 

.studentModalBtn:hover {
    cursor: pointer;
    background: linear-gradient( 90deg,  rgb(247, 242, 247), rgb(239, 235, 243));

}
</style>

<x-alert-component mainclass="col-12" color="primary" message={{$msg}} />
<div class="container viewStudents">
    <div class="viewUpperBox col-12" style="margin:16px 0px 0px 0px; display:flex; flex-direction:row; justify-content:space-between;">
        <form action="{{('/students/view')}}" method="get" style="display: inline-block;">
            <div class="input-group mx-1">
                <input type="text" class="form-control" placeholder="Search name here" value="{{old("searchForm")}}" name="searchForm" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <div class="upperBoxBtns" style="display: inline-block;">
            <a href="{{$addStdURL}}" class="mx-2"><button class="btn btn-outline-secondary">{{$addStdBtn}}</button></a>
            <a href="{{$trashURL}}" class="mx-2"><button class="btn btn-outline-secondary">{{$trashBtn}}</button></a>
        </div>
    </div>
    <table class="table table-hover">
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
                    {{-- --}}
                    <td><div id="{{$student->id}}" class="studentModalBtn"  data-bs-toggle="modal" data-bs-target="#studentProfileModal" >{{$student->name}}</div> </td>
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
        {{$students->links('pagination::bootstrap-5')}}
    </div>
    <!-- Modal -->
    <div class="modal fade" id="studentProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="studentModalHead">Subject Name</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="studentModalBody">
                Wait...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Download</button>
            </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(document).on("click", ".studentModalBtn", debounce((e)=>{
            var id = e.target.getAttribute("id");
            $.ajax({
                url: "{{url('/students/profile/view')}}",
                type: "GET",
                data:{
                    "id" : id
                },
                success:(res)=>{
                    var res = JSON.parse(res);
                    var modalHtml = `
                        <div class="card">
                                <div class="card-header">
                                    <strong>${res['student']}</strong>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <table class="table table-hover">
                                            <thead>
                                                <th>Oral</th>
                                                <th>Endsem</th>
                                                <th>Assign-1</th>
                                                <th>Assign-2</th>                                    
                                            </thead>
                                            <tbody>
                                                <td>${res['oral']}</td>
                                                <td>${res['endsem']}</td>
                                                <td>${res['assign']['a1']}</td>
                                                <td>${res['assign']['a2']}</td>
                                            </tbody>
                                        </table>
                                        <table class="table table-hover" >
                                            <thead>
                                                <th>Q1</th>
                                                <th>Q2</th>
                                                <th>Q4</th>
                                                <th>Q4</th>
                                                <th class="text-primary">IA1</th>
                                                <th>Q1</th>
                                                <th>Q2</th>
                                                <th>Q3</th>
                                                <th>Q4</th>
                                                <th class="text-primary">IA2</th>
                                            </thead>
                                            <tbody>
                                                <td>${res['ia']['ia1q1']}</td>
                                                <td>${res['ia']['ia1q2']}</td>
                                                <td>${res['ia']['ia1q3']}</td>
                                                <td>${res['ia']['ia1q4']}</td>
                                                <td class="text-primary">${res['ia']['ia1']}</td>
                                                <td>${res['ia']['ia2q1']}</td>
                                                <td>${res['ia']['ia2q2']}</td>
                                                <td>${res['ia']['ia2q3']}</td>
                                                <td>${res['ia']['ia2q4']}</td>
                                                <td class="text-primary">${res['ia']['ia2']}</td>
                                            </tbody>
                                        </table>
                                        `;
                    modalHtml += "<div class='table-responsive'> <table class='table table-bordered'> <thead>";
                    for (let i = 1; i <= 12; i++) {
                       modalHtml += `<th>E${i}</th>`;
                    }
                    modalHtml += "</thead>   <tbody>";
                    for (let i = 1; i <= 12; i++) {
                        modalHtml += `<td>${res['expt']['e'+i]}</td>`;
                        
                    }
                    modalHtml += "</tbody>  </table> </div> </li>  </ul> </div>";


                    document.getElementById("studentModalBody").innerHTML = modalHtml;
                }
            })
        }, 1000));
    });
</script>

    
@endsection
