@extends('layouts.main')
@push('title')
    <title>IA</title>
@endpush
@section('main-section')
<style>
    .SwitchColumns{
        display: none;
    }
</style>
<div class="iaPage container">
    <div class="viewUpperBox col-12" style="margin:16px 0px 0px 0px; display:flex; flex-direction:row; justify-content:space-between;">
        <form action="{{('/sheets/ia')}}" method="get" style="display: inline-block;">
            <div class="input-group mx-1">
                <input type="text" class="form-control" placeholder="Search name here" value="{{"$searchText"}}" name="searchForm" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <div class="upperBoxBtns" style="display: inline-block;">
            <a href="{{url("/students/input")}}" class="mx-2"><button class="btn btn-outline-secondary">{{$trashBtn}}</button></a>
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
                <th style="width: 200px;" scope="col">Full Name</th>
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
                            <td style="width: 200px; text-align:left;">{{$student->name}}</td>
                            <td class="sideColumn1">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:70px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia1q1"  id="{{$student->group_key}}+ia1q1" value="{{$student->ia1q1}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn1">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:70px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia1q2"  id="{{$student->group_key}}+ia2q2" value="{{$student->ia2q2}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn1">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:70px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia1q3"  id="{{$student->group_key}}+ia1q3" value="{{$student->ia1q3}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn1">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:70px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia1q4"  id="{{$student->group_key}}+ia1q4" value="{{$student->ia1q4}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="mainColumn1" style="background-color: aliceblue; cursor: pointer;" id="{{$student->student_id}}+ia1">{{$student->ia1}}</td>
                            <td class="sideColumn2">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:70px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia2q1"  id="{{$student->group_key}}+ia2q1" value="{{$student->ia2q1}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn2">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:70px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia2q2"  id="{{$student->group_key}}+ia2q2" value="{{$student->ia2q2}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn2">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:70px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia2q3"  id="{{$student->group_key}}+ia2q3" value="{{$student->ia2q3}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="sideColumn2">
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:70px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}+ia2q4"  id="{{$student->group_key}}+ia2q4" value="{{$student->ia2q4}}" style="height: 26px;">
                                </div>
                            </td>
                            <td class="mainColumn2" style="background-color: aliceblue; cursor: pointer;" id="{{$student->student_id}}+ia2">{{$student->ia2}}</td>
                            <td id="{{$student->student_id}}+avg+ia1ia2">{{round(($student->ia1+$student->ia2)/2)}}</td>
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
            var arr = document.getElementsByClassName(`sideColumn${i}`);
            for (let j = 0; j < arr.length; j++) {
                const element = arr[j];
                element.classList.toggle("SwitchColumns");
            }
        })
    }

    $(document).ready(function(){
        $(document).on("change", ".marksInputField", function(e){
            var stuId = e.target.getAttribute("name");
            var stdVal = e.target.value;
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
                        document.getElementById(stuGroupKey).parentNode.style.borderColor = "red";
                        setTimeout(() => {
                            document.getElementById(stuGroupKey).parentNode.style.borderColor = "rgb(86, 3, 114)";
                        }, 5000);                        
                    }
                    else{
                        document.getElementById(stuGroupKey).parentNode.style.borderColor = "cyan";
                        setTimeout(() => {
                            document.getElementById(stuGroupKey).parentNode.style.borderColor = "rgb(86, 3, 114)";
                        }, 2000); 
                        console.log(res);
                        var ia1_total = parseInt(res.split("+")[0]);
                        var ia2_total = parseInt(res.split("+")[1]);
                        document.getElementById(`${stuId.split("+")[0]}+ia1`).innerHTML = ia1_total;
                        document.getElementById(`${stuId.split("+")[0]}+ia2`).innerHTML= ia2_total;
                        document.getElementById(`${stuId.split("+")[0]}+avg+ia1ia2`).innerHTML = ((ia1_total+ia2_total)/2).toFixed();
                    }
                }
            });
        });
    });
</script>
@endsection