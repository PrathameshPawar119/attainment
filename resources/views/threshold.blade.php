@extends('layouts.main')
@push('title')
    <title>Conditions Input</title>
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
            color: black;
            text-align: center;
            text-decoration: none;
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
    @php
        $sheetsArr = array('oral', 'endsem', 'assigns', 'ia', 'expt');
    @endphp
    <div class="container">
        <div class="tabLine">
            <a href="{{url('/user/criteriaInput')}}" class="tabs">
                <div  id="criteriaInputBox">
                    <img src="{{URL::to('/')}}/images/testing.png" alt="">
                    <h5>Total Marks</h5>
                </div>
            </a>
            <div class="lineBox">
                <div class="lineHere1"></div>
                <div class="lineHere2"></div>
            </div>
            <a href="{{url('/user/coinput')}}" class="tabs">
                <div  id="coInputBox">
                    <img src="{{URL::to('/')}}/images/sharing.png" alt="">
                    <h4>Select CO's</h4>
                </div>
            </a>
            <div class="lineBox">
                <div class="lineHere1"></div>
                <div class="lineHere2"></div>
            </div>
            <a href="#" class="tabs">
                <div  id="thresholdInputBox">
                    <img src="{{URL::to('/')}}/images/testing.png" alt="">
                    <h4>Mark Criteria</h4>
                    <p>Mandantory to decide Attainment levels</p>
                </div>
            </a>
        </div>
        <div class="inputSection" id="inputSection">
            <div class="LeftCriteriaSection col-md-3">
                <table class="table my-2 table-hover">
                    <thead>
                        <th>Sheets</th>
                        <th>Percentage Criteria /100</th>
                    </thead>
                    <tbody>
                        @for($i=0; $i<5; $i++)
                            <tr>
                                <td>{{ucwords($sheetsArr1[$i])}}</td>
                                <td>
                                    <input type="number" class="form-control p-3 marksInputField"  id="{{$sheetsArr1[$i]}}-student" max="100" min="0" value="{{$condition_marks[$sheetsArr1[$i]]}}" style="height: 26px;">
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="rightCriteriaSection">
                <table class="table my-2 table-hover">
                    <thead>
                        <th>Sheets</th>
                        <th>Percentage Criteria /100</th>
                    </thead>
                    <tbody>
                        @for($i=0; $i<5; $i++)
                            <tr>
                                <td>{{ucwords($sheetsArr[$i])}}</td>
                                <td>
                                    <input type="number" class="form-control p-3 marksInputField"  id="{{$sheetsArr[$i]}}-student" max="100" min="0" value="{{$condition_marks[$sheetsArr[$i]]}}" style="height: 26px;">
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(document).on("change", ".marksInputField", debounce(function(e){
                var stuId = e.target.getAttribute('id');
                var column = stuId.split("-")[0];
                var value = e.target.value > 100 ? 100 : e.target.value;
                $.ajax({
                    url: "{{route('updateThresholdCriteria')}}",
                    type: "POST",
                    data: {
                        '_token':"{{csrf_token()}}",
                        'column':column,
                        'value': value
                    },
                    success:(res)=>{
                        if (res == 1 || res == '1') {
                            e.target.style.backgroundColor = "rgb(222, 205, 248)";
                            setTimeout(() => {
                                e.target.style.backgroundColor = "white"
                            }, 1500);  
                            console.log(res);
                        }
                        else if(res == 0 || res == '0') 
                        {
                            e.target.style.backgroundColor = "red";
                            setTimeout(() => {
                                e.target.style.backgroundColor = "white"
                            }, 3000); 
                        }  
                    }
                })
                
            }, 500));
        })
    </script>
@endsection