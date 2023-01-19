@extends('layouts.main')
@push('title')
    <title>IA</title>
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
    .table-responsive table{
        min-width: 1200px;
    }
</style>
@php
    $ia_total_max->ia1_total = ($ia_total_max->ia1_total == 0 ? 1 : $ia_total_max->ia1_total);
    $ia_total_max->ia2_total = ($ia_total_max->ia2_total == 0 ? 1 : $ia_total_max->ia2_total);
    
    $msg = "...";
    if (session()->has("alertMsg")) {
        $msg = session()->get("alertMsg");
    }

@endphp
<div class="iaPage container">
        <x-alert-component mainclass="col-12" color="primary" message="{{$msg}}" />
    <div class="viewUpperBox col-12" style="margin:16px 0px 0px 0px; display:flex; flex-direction:row; justify-content:space-between;">
        <form action="{{('/sheets/ia')}}" method="get" style="display: inline-block;">
            <div class="input-group mx-1">
                <input type="text" class="form-control" placeholder="Search name here" value="{{"$searchText"}}" name="searchForm" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <div class="upperBoxBtns" style="display: inline-block;">
            <a href="{{url("/attainment/ia")}}" class="mx-2"><button class="btn btn-outline-secondary">{{$trashBtn}}</button></a>
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
                <th style="width: 300px;" scope="col">Full Name</th>
                <th class="sideColumn1" scope="col">Q1</th>
                <th class="sideColumn1" scope="col">Q2</th>
                <th class="sideColumn1" scope="col">Q3</th>
                <th class="sideColumn1" scope="col">Q4</th>
                <th class="mainColumn1" style="background-color: aliceblue; cursor: pointer;" scope="col">IA-1</th>
                <th class="sideColumn2" scope="col">Q1</th>
                <th class="sideColumn2" scope="col">Q2</th>
                <th class="sideColumn2" scope="col">Q3</th>
                <th class="sideColumn2" scope="col">Q4</th>
                <th class="mainColumn2" style="background-color: aliceblue; cursor: pointer;" scope="col">IA-2</th>
                <th scope="col">/20</th>
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
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia1q1"  id="{{$student->group_key}}+ia1q1" max="{{$ia_total_max->ia1_q1}}" min="0" value="{{$student->ia1q1}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn1">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia1q2"  id="{{$student->group_key}}+ia2q2" max="{{$ia_total_max->ia1_q2}}" min="0" value="{{$student->ia1q2}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn1">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia1q3"  id="{{$student->group_key}}+ia1q3" max="{{$ia_total_max->ia1_q3}}" min="0" value="{{$student->ia1q3}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn1">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia1q4"  id="{{$student->group_key}}+ia1q4" max="{{$ia_total_max->ia1_q4}}" min="0" value="{{$student->ia1q4}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="mainColumn1" style="background-color: aliceblue; cursor: pointer;" id="{{$student->student_id}}+ia1">{{$student->ia1}}</td>
                            <td class="sideColumn2">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia2q1"  id="{{$student->group_key}}+ia2q1" max="{{$ia_total_max->ia2_q1}}" min="0" value="{{$student->ia2q1}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn2">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia2q2"  id="{{$student->group_key}}+ia2q2" max="{{$ia_total_max->ia2_q2}}" min="0" value="{{$student->ia2q2}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn2">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia2q3"  id="{{$student->group_key}}+ia2q3" max="{{$ia_total_max->ia2_q3}}" min="0" value="{{$student->ia2q3}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn2">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia2q4"  id="{{$student->group_key}}+ia2q4" max="{{$ia_total_max->ia2_q4}}" min="0" value="{{$student->ia2q4}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="mainColumn2" style="background-color: aliceblue; cursor: pointer;" id="{{$student->student_id}}+ia2">{{$student->ia2}}</td>
                            <td id="{{$student->student_id}}+avg+ia1ia2">{{round((($student->ia1+$student->ia2)*20)/($ia_total_max->ia1_total+$ia_total_max->ia2_total))}}</td>
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>
    </div>
    <div class="row center p-2" style="align-items: center; text-align:center; ">
        {{$students->links()}}
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
            var iaQMax = parseInt(e.target.getAttribute("max"));
            var stuId = e.target.getAttribute("name");
            var stdVal = (e.target.value > iaQMax ? iaQMax : e.target.value);
            var stuGroupKey = e.target.getAttribute("id");
            $.ajax({
                url: "{{route('updateIaMarks')}}",
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
                        var parsedRes = res.split("+");
                        var ia1_total = parseInt(parsedRes[0]);
                        var ia2_total = parseInt(parsedRes[1]);
                        var ia1_limit = parseInt(parsedRes[2]);
                        var ia2_limit = parseInt(parsedRes[3]);
                        document.getElementById(`${stuId.split("+")[0]}+ia1`).innerHTML = ia1_total;
                        document.getElementById(`${stuId.split("+")[0]}+ia2`).innerHTML= ia2_total;
                        document.getElementById(`${stuId.split("+")[0]}+avg+ia1ia2`).innerHTML = ((ia1_total+ia2_total)*20/(ia1_limit+ia2_limit)).toFixed();
                    }
                }
            });
        }, 200));
    });
</script>
@endsection