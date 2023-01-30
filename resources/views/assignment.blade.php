@extends('layouts.main')
@push('title')
    <title>Assignments</title>
@endpush
@section('main-section')
<style>
    .SwitchColumns{
        display: none;
    }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
    .StdNameCol{
        min-width: 360px;
    }
    .table-responsive table{i
        min-width: 900px;
    }
</style>
@php
  $assign_total_max->assign_total =   ($assign_total_max->assign_total == 0 ? 1: $assign_total_max->assign_total);
    $msg = "...";
    if (session()->has("alertMsg")) {
        $msg = session()->get("alertMsg");
    }

@endphp
<div class="assignmentPage container">
<x-alert-component mainclass="col-12" color="primary" message="{{$msg}}" />
    <div class="viewUpperBox col-12" style="margin:16px 0px 0px 0px; display:flex; flex-direction:row; justify-content:space-between;">
        <form action="{{('/sheets/assignment')}}" method="get" style="display: inline-block;">
            <div class="input-group mx-1">
                <input type="text" class="form-control" placeholder="Search name here" value="{{"$searchText"}}" name="searchForm" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <div class="upperBoxBtns" style="display: inline-block;">
            <a href="{{url("/attainment/assignment")}}" class="mx-2"><button class="btn btn-outline-secondary">{{$trashBtn}}</button></a>
            <button class="btn btn-outline-secondary" type="submit" value="update" >Refresh</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table my-2 table-hover text-center">
            <thead>
                <tr>
                <th scope="col">Sr. No</th>
                <th scope="col">DIV</th>
                <th scope="col">Roll No.</th>
                <th scope="col">Student ID</th>
                <th style="width: 300px;" scope="col">Name</th>
                <th class="sideColumn1" scope="col">P1</th>
                <th class="sideColumn1" scope="col">P2</th>
                <th class="sideColumn1" scope="col">P3</th>
                <th class="mainColumn1" style="background-color: aliceblue; cursor: pointer;" scope="col">Assign-1</th>
                <th class="sideColumn2" scope="col">P1</th>
                <th class="sideColumn2" scope="col">P2</th>
                <th class="sideColumn2" scope="col">P3</th>
                <th class="mainColumn2" style="background-color: aliceblue; cursor: pointer;" scope="col">Assign-2</th>
                <th scope="col">Total</th>
                <th scope="col">/5</th>
                </tr>
            </thead>
            <tbody>
                @if (!isset($students))
                    {{"Please add some students Please"}}            
                @endif
                <form id="assignmentMarksForm">
                    @foreach($students as $key=>$student)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$student->div}}</td>
                            <td>{{$student->roll_no}}</td>
                            <td>{{$student->student_id}}</td>
                            <td style="width: 440px; text-align:left;" class="StdNameCol">{{$student->name}}</td>
                            <td class="sideColumn1">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->id}}+a1p1"  id="{{$student->group_key}}+a1p1" max="{{$assign_total_max->assign_p1}}" min="0" value="{{$student->a1p1}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn1">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->id}}+a1p2"  id="{{$student->group_key}}+a1p2" max="{{$assign_total_max->assign_p2}}" min="0" value="{{$student->a1p2}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn1">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->id}}+a1p3"  id="{{$student->group_key}}+a1p3" max="{{$assign_total_max->assign_p3}}" min="0" value="{{$student->a1p3}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="mainColumn1" style="background-color: aliceblue; cursor: pointer;" id="{{$student->id}}+a1">{{$student->a1}}</td>
                            <td class="sideColumn2">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->id}}+a2p1"  id="{{$student->group_key}}+a2p1" max="{{$assign_total_max->assign_p1}}" min="0" value="{{$student->a2p1}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn2">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->id}}+a2p2"  id="{{$student->group_key}}+a2p2" max="{{$assign_total_max->assign_p2}}" min="0" value="{{$student->a2p2}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn2">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->id}}+a2p3"  id="{{$student->group_key}}+a2p3" max="{{$assign_total_max->assign_p3}}" min="0" value="{{$student->a2p3}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="mainColumn2" style="background-color: aliceblue; cursor: pointer;" id="{{$student->id}}+a2">{{$student->a2}}</td>
                            <td id="{{$student->student_id}}+a1a2">{{$student->a1+$student->a2}}</td>
                            <td id="{{$student->student_id}}+avg+a1a2">{{round((($student->a1+$student->a2)*5)/(($assign_total_max->assign_total*2)))}}</td>
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>
    </div>
    <div class="row center p-2" style="align-items: center; text-align:center; ">
        {{$students->links('pagination::bootstrap-5')}}
    </div>
</div>
<script>
    // Made SideColumns Display None at start
    for (let i = 1; i <= 2; i++) {
            var arr = document.getElementsByClassName(`sideColumn${i}`);
            for (let j = 0; j < arr.length; j++) {
                const element = arr[j];
                element.classList.add("SwitchColumns");
            }
    }

    // Eventlistener to switch sidecolumns by clicking maincolumns
    for (let i = 1; i <= 2; i++) {
        document.getElementsByClassName(`mainColumn${i}`)[0].addEventListener("click", ()=>{
            // Highlighting current open experiment pillar open
            var CurrentPillar = document.getElementsByClassName(`mainColumn${i}`)[0];
            if (CurrentPillar.style.backgroundColor != "bisque") {
                CurrentPillar.style.backgroundColor = "bisque";
            }
            else{
                CurrentPillar.style.backgroundColor = "aliceblue";
            }
            var arr = document.getElementsByClassName(`sideColumn${i}`);
            for (let j = 0; j < arr.length; j++) {
                const element = arr[j];
                element.classList.toggle("SwitchColumns");
            }
        })
    }

    $(document).ready(function(){
        $(document).on("change", ".marksInputField", debounce(function(e){
            var max_assign_limit = parseInt(e.target.getAttribute("max"));
            var stuId = e.target.getAttribute("name");
            var stdVal = parseInt(e.target.value);
            if (stdVal > max_assign_limit) {
                stdVal = max_assign_limit;
            }
            var stuGroupKey = e.target.getAttribute("id");
            
            $.ajax({
                url: "{{route('updateAssignmentMarks')}}",
                type:"POST",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id':stuId.split("+")[0],
                    'value':stdVal,
                    'column_name':`${stuId.split("+")[1]}`
                },
                success: function(res){
                    if(res == '0' ||  res == 0){
                        e.target.parentNode.style.borderColor = "red";
                        setTimeout(() => {
                            e.target.parentNode.style.borderColor = "rgb(86, 3, 114)";
                        }, 5000);                        
                    }
                    else{
                        e.target.parentNode.style.borderColor = "cyan";
                        setTimeout(() => {
                            e.target.parentNode.style.borderColor = "rgb(86, 3, 114)";
                        }, 2000); 

                        var a1_total = parseInt(res.split("+")[0]);
                        var a2_total = parseInt(res.split("+")[1]);
                        var assign_total = parseInt(res.split("+")[2]);
                        document.getElementById(`${stuId.split("+")[0]}+a1`).innerHTML = a1_total;
                        document.getElementById(`${stuId.split("+")[0]}+a2`).innerHTML= a2_total;
                        document.getElementById(`${stuId.split("+")[0]}+a1a2`).innerHTML = a1_total+a2_total;
                        document.getElementById(`${stuId.split("+")[0]}+avg+a1a2`).innerHTML = (((a1_total+a2_total)*5)/(assign_total*2)).toFixed();
                    }
                }
            });
        }, 300));
    });
</script>
@endsection