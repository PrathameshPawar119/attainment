@extends('layouts.main')
@push('title')
    <title>Experiments</title>
@endpush
@section('main-section')
<style>
    .StdNameCol{
        min-width: 400px !important;
    }
    .table-responsive table {
        min-width: 1400px;
    }
    .marksInputField{
        height: 26px;
    }
</style>
@php
    $exp_total_max->exp_total = ($exp_total_max->exp_total == 0 ? 1:$exp_total_max->exp_total);
    $msg = "...";
    if (session()->has("alertMsg")) {
        $msg = session()->get("alertMsg");
    }
@endphp
<div class="iaPage container">
<x-alert-component mainclass="col-12" color="primary" message="{{$msg}}" />
    <div class="viewUpperBox col-12" style="margin:16px 0px 0px 0px; display:flex; flex-direction:row; justify-content:space-between;">
        <form action="{{('/sheets/experiments')}}" method="get" style="display: inline-block;">
            <div class="input-group mx-1">
                <input type="text" class="form-control" placeholder="Search name here" value="{{"$searchText"}}" name="searchForm" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <div class="upperBoxBtns" style="display: inline-block;">
            <a href="{{url("/attainment/expt")}}" class="mx-2"><button class="btn btn-outline-secondary">{{$trashBtn}}</button></a>
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
                <th style="width: 400px;" scope="col">Full Name</th>
                @for ($i=1; $i <= 12 ; $i++)
                        <th class='sideColumn{{$i}}' scope='col'>R1</th>
                        <th class='sideColumn{{$i}}' scope='col'>R2</th>
                        <th class='sideColumn{{$i}}' scope='col'>R3</th>
                        <th class='mainColumn{{$i}}' style='background-color: aliceblue; cursor: pointer;' scope='col'>Exp-{{$i}}</th>
                @endfor
                <th scope="col">/15</th>
                </tr>
            </thead>
            <tbody>
                @if (!isset($students))
                    {{"Please add some students Please"}}            
                @endif
                <form id="assignmentMarksForm">
                    @foreach($students as $key=>$student)
                        @php
                        // These 4 arrays solve problem of iterating variable in variable
                            $Exp_r1 = array($student->e1r1, $student->e2r1, $student->e3r1, $student->e4r1, $student->e5r1, $student->e6r1, $student->e7r1, $student->e8r1, $student->e9r1, $student->e10r1, $student->e11r1, $student->e12r1);
                            $Exp_r2 = array($student->e1r2, $student->e2r2, $student->e3r2, $student->e4r2, $student->e5r2, $student->e6r2, $student->e7r2, $student->e8r2, $student->e9r2, $student->e10r2, $student->e11r2, $student->e12r2);
                            $Exp_r3 = array($student->e1r3, $student->e2r3, $student->e3r3, $student->e4r3, $student->e5r3, $student->e6r3, $student->e7r3, $student->e8r3, $student->e9r3, $student->e10r3, $student->e11r3, $student->e12r3);
                            $Exp_Totals = array($student->e1, $student->e2, $student->e3, $student->e4, $student->e5, $student->e6, $student->e7, $student->e8, $student->e9, $student->e10, $student->e11, $student->e12)
                        @endphp
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$student->div}}</td>
                            <td>{{$student->roll_no}}</td>
                            <td>{{$student->student_id}}</td>
                            <td style="width: 400px; text-align:left;" class="StdNameCol">{{$student->name}}</td>
                            @for ($i=1; $i <= 12; $i++)
                                <td class='sideColumn{{$i}} px-0'>
                                    <div class='smallInputField center mx-0' style='border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;'>
                                        <input type='number' class='form-control my-0 marksInputField' name='{{$student->id}}+e{{$i}}r1'  id='{{$student->group_key}}+e{{$i}}r1' max="{{$exp_total_max->exp_r1}}" min="0" value='{{$Exp_r1[$i-1]}}'>
                                    </div>
                                </td>
                                <td class='sideColumn{{$i}} px-0'>
                                    <div class='smallInputField center mx-0' style='border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;'>
                                        <input type='number' class='form-control my-0 marksInputField' name='{{$student->id}}+e{{$i}}r2'  id='{{$student->group_key}}+e{{$i}}r2' max="{{$exp_total_max->exp_r2}}" min="0" value='{{$Exp_r2[$i-1]}}'>
                                    </div>
                                </td>
                                <td class='sideColumn{{$i}} px-0'>
                                    <div class='smallInputField center mx-0' style='border:2px solid rgb(86, 3, 114); border-radius:6px; width:40px;'>
                                        <input type='number' class='form-control my-0 marksInputField' name='{{$student->id}}+e{{$i}}r3'  id='{{$student->group_key}}+e{{$i}}r3' max="{{$exp_total_max->exp_r3}}" min="0" value='{{$Exp_r3[$i-1]}}'>
                                    </div>
                                </td>
                                <td class='mainColumn{{$i}}' style='background-color: aliceblue; cursor: pointer;' id='{{$student->id}}+e{{$i}}'>{{$Exp_Totals[$i-1]}}</td>
                            @endfor
                            <td id="{{$student->id}}+avg">{{round((($student->e1+$student->e2+$student->e3+$student->e4+$student->e5+$student->e6+$student->e7+$student->e8+$student->e9+$student->e10+$student->e11+$student->e12)*15)/($exp_total_max->exp_total*12))}}</td>
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
    for (let i = 1; i <= 12; i++) {
            var arr = document.getElementsByClassName(`sideColumn${i}`);
            for (let j = 0; j < arr.length; j++) {
                const element = arr[j];
                element.classList.add("SwitchColumns");
            }
    }

    // Eventlistener to switch sidecolumns by clicking maincolumns
    for (let i = 1; i <= 12; i++) {
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
            var expMarR = parseInt(e.target.getAttribute("max"));
            var stuId = e.target.getAttribute("name").split("+");
            var stdVal = parseInt(e.target.value);
            var stuGroupKey = e.target.getAttribute("id");
            if (stdVal > expMarR) {
                e.target.parentNode.style.borderColor = "red";
            }
            else{
                $.ajax({
                    url: "{{route('updateExperimentMarks')}}",
                    type:"POST",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'id':stuId[0],
                        'value':stdVal,
                        'column_name':`${stuId[1]}`
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
    
                            var exp_total = 0;
                            var all_exp_total = 0;
                            var parsedRes = res.split("+");
                            console.log(res);
                            var exp_limit = parseInt(parsedRes[12]);
                            for (let i = 0; i < 12; i++) {
                                exp_total = parseInt(parsedRes[i]);
                                document.getElementById(`${stuId[0]}+e${i+1}`).innerHTML = exp_total;
                                all_exp_total += exp_total;
                            }
                            document.getElementById(`${stuId[0]}+avg`).innerHTML = (((all_exp_total)*15)/(exp_limit*12)).toFixed();
                        }
                    }
                });
            }
        }, 250));
    });
</script>
@endsection