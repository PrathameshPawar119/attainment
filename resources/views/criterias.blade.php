@extends('layouts.main')
@push('title')
    <title>Criteria Input</title>
@endpush
@section('main-section')
    <style>
        .tabLine{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            height: 88px;
        }
        .tabs{
            width: 70%;
            margin: 10px 0px;
            padding: 4px;
            background-color: rgb(239, 205, 248);
            border:2px transparent;
            border-radius: 8px;
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .tabs:hover{
            padding: 8px;
            background-color: rgb(232, 176, 251);
            border: 3px transparent;
            border-radius: 10px;
            cursor: pointer;
        }
        .tabs img{
            width: 60px;
            height: 50px;
        }
        .lineBox{
            display: flex;
            flex-direction: column;
            padding: 0px;
        }
        .lineHere1{
            width: 80px;
            height: 40px;
            margin: 0px;
            border: 2px solid rgb(150, 72, 222);
            border-top-width: 0px;
            border-right-width: 0px;
            border-left-width: 0px;
            border-bottom-left-radius: 6px;
        }
        .lineHere2{
            width: 80px;
            height: 40px;
            margin: 0px;
            border: 2px solid rgb(150, 72, 222);
            border-bottom-width: 0px;
            border-right-width: 0px;
            border-left-width: 0px;
            border-top-left-radius: 6px;
        }
        .inputSection{
            margin: 60px 10px 10px 10px;
        }
        .assignmentTotals .form-label{
            width: 100%;
            background:aliceblue;
                align-items: center;
        }
        .IATotals .form-label{
            width: 100%;
            background:aliceblue;
            align-items: center;
        }
        .ExperimentTotals .form-label{
            width: 100%;
            background:aliceblue;
            align-items: center;
        }
        .tabs p{
            font-size: 12px;
            margin: 0px;
        }

    </style>
    <div class="container">
        <div class="tabLine">
            <div class="tabs">
                <img src="{{URL::to('/')}}/images/testing.png" alt="">
                <h5>Total Marks</h5>
                <p>Mandantory Before filling Sheets*</p>
            </div>
            <div class="lineBox">
                <div class="lineHere1"></div>
                <div class="lineHere2"></div>
            </div>
            <div class="tabs">
                <img src="{{URL::to('/')}}/images/sharing.png" alt="">
                <h4>Select CO's</h4>
            </div>
            <div class="lineBox">
                <div class="lineHere1"></div>
                <div class="lineHere2"></div>
            </div>
            <div class="tabs">
                <img src="{{URL::to('/')}}/images/testing.png" alt="">
                <h4>Mark Criteria</h4>
            </div>
        </div>
        <div class="inputSection" id="inputSection">
            <div class="part1 row" >
                <x-vinput mainclass="col-md-2" id="oral_total_marks" name="oral_total" type="number" label="Oral Total Marks" value="{{$current_criteria->oral_total}}" />
                <x-vinput mainclass="col-md-2" id="endsem_total_marks" name="endsem_total" type="number" label="Endsem Total Marks" value="{{$current_criteria->endsem_total}}" />
            </div>
            <div class="assignmentTotals row my-4">
                <h4>Assignment Total Marks</h4>
                <x-vinput mainclass="col-md-2" id="assignment-p1" name="assign_p1" type="number" label="P1" value="{{$current_criteria->assign_p1}}" />
                <x-vinput mainclass="col-md-2" id="assignment-p2" name="assign_p2" type="number" label="P2" value="{{$current_criteria->assign_p2}}" />
                <x-vinput mainclass="col-md-2" id="assignment-p3" name="assign_p3" type="number" label="P3" value="{{$current_criteria->assign_p3}}" />
                <div class="col-md-2" >
                    <label for="endsem_total_marks" class="form-label">Assign Total Marks</label>
                    <input type="number" class="form-control" name="endsem_total" id="assign_total_marks" aria-describedby="emailHelp" value="{{$current_criteria->assign_total}}" disabled>
                    <span class="text-danger">
                        @error('endsemTotal')
                            {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="IATotals row my-4">
                <h4>IA Total Marks Per Question</h4>
                <x-vinput mainclass="col-md-1" id="ia1-q1" name="ia1_q1" type="number" label="Q1" value="{{$current_criteria->ia1_q1}}" />
                <x-vinput mainclass="col-md-1" id="ia1-q2" name="ia1_q2" type="number" label="Q2" value="{{$current_criteria->ia1_q2}}" />
                <x-vinput mainclass="col-md-1" id="ia1-q3" name="ia1_q3" type="number" label="Q3" value="{{$current_criteria->ia1_q3}}" />
                <x-vinput mainclass="col-md-1" id="ia1-q4" name="ia1_q4" type="number" label="Q4" value="{{$current_criteria->ia1_q4}}" />
                <div class="col-md-1" >
                    <label for="ia1_total_marks" class="form-label">IA1</label>
                    <input type="number" class="form-control" name="ia1Total" id="ia1_total_marks" aria-describedby="emailHelp" value="{{$current_criteria->ia1_total}}" disabled>
                    <span class="text-danger">
                        @error('ia1Total')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <x-vinput mainclass="col-md-1" id="ia2-q1" name="ia2_q1" type="number" label="Q1" value="{{$current_criteria->ia2_q1}}" />
                <x-vinput mainclass="col-md-1" id="ia2-q2" name="ia2_q2" type="number" label="Q2" value="{{$current_criteria->ia2_q2}}" />
                <x-vinput mainclass="col-md-1" id="ia2-q3" name="ia2_q3" type="number" label="Q3" value="{{$current_criteria->ia2_q3}}" />
                <x-vinput mainclass="col-md-1" id="ia2-q4" name="ia2_q4" type="number" label="Q4" value="{{$current_criteria->ia2_q4}}" />
                <div class="col-md-1" >
                    <label for="ia2_total_marks" class="form-label">IA2</label>
                    <input type="number" class="form-control" name="ia2Total" id="ia2_total_marks" aria-describedby="emailHelp" value="{{$current_criteria->ia2_total}}" disabled>
                    <span class="text-danger">
                        @error('ia2Total')
                            {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="ExperimentTotals row my-4">
                <h4>Experiments Total Marks</h4>
                <x-vinput mainclass="col-md-2" id="expt-r1" name="exp_r1" type="number" label="R1" value="{{$current_criteria->exp_r1}}" />
                <x-vinput mainclass="col-md-2" id="expt-r2" name="exp_r2" type="number" label="R2" value="{{$current_criteria->exp_r2}}" />
                <x-vinput mainclass="col-md-2" id="expt-r3" name="exp_r3" type="number" label="R3" value="{{$current_criteria->exp_r3}}" />
                <div class="col-md-2" >
                    <label for="expt_total_marks" class="form-label">Expt Total Marks</label>
                    <input type="number" class="form-control" name="exptTotal" id="expt_total_marks" aria-describedby="emailHelp" value="{{$current_criteria->exp_total}}" disabled>
                    <span class="text-danger">
                        @error('exptTotal')
                            {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(document).on("change", ".marksInputField", function(e){
                var column_name = e.target.getAttribute("name");
                var column_val = e.target.value;
                var input_id = e.target.getAttribute("id");
                $.ajax({
                    url: "{{route('updateCriteriaMarks')}}",
                    type: "POST",
                    data: {
                        '_token':"{{csrf_token()}}",
                        'column':column_name,
                        'value':column_val
                    },
                    success: function (res){
                        if(res == '0' ||  res == 0){
                            document.getElementById(input_id).style.backgroundColor = "red";
                            setTimeout(() => {
                                document.getElementById(input_id).style.backgroundColor = "white";
                            }, 5000);                        
                        }
                        else{
                            document.getElementById(input_id).style.backgroundColor = "rgb(205, 228, 248)";
                            setTimeout(() => {
                                document.getElementById(input_id).style.backgroundColor = "white";
                            }, 2000); 
                            var assign_t = parseInt(res.split("+")[0]);
                            var ia1_t = parseInt(res.split("+")[1]);
                            var ia2_t = parseInt(res.split("+")[2]);
                            var exp_t = parseInt(res.split("+")[3]);
                            document.getElementById(`assign_total_marks`).value = assign_t;
                            document.getElementById(`ia1_total_marks`).value = ia1_t;
                            document.getElementById(`ia2_total_marks`).value = ia2_t;
                            document.getElementById(`expt_total_marks`).value = exp_t;
                        }
                    }
                });
            });
        });
    </script>
@endsection