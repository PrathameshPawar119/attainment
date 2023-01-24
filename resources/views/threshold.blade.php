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
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: 1fr;
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
        $sheetsArr1 = array('oral', 'endsem', 'assigns', 'ia', 'expt');
        $sheetsArr2 = array('PO1', 'PO2', 'PO3', 'PO4', 'PO5', 'PO6');
        $poAvg = 0;
        for ($i=0; $i < 6; $i++) { 
            $poAvg += $po_levels[$sheetsArr2[$i]];
        }
        $poAvg = round($poAvg/6, 3);
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
            <div class="LeftCriteriaSection mx-3">
                <table class="table my-2 table-hover">
                    <thead>
                        <th>Sheets</th>
                        <th>Percentage Criteria /100</th>
                    </thead>
                    <tbody>
                        @for($i=0; $i<5; $i++)
                            <tr>
                                <th>{{ucwords($sheetsArr1[$i])}}</th>
                                <td>
                                    <input type="number" tablename="threshold" class="form-control p-3 marksInputField"  id="{{$sheetsArr1[$i]}}-student" max="100" min="0" value="{{$condition_marks[$sheetsArr1[$i]]}}" style="height: 26px;">
                                </td>
                            </tr>
                        @endfor
                        <tr></tr>
                    </tbody>
                </table>
            </div>
            <div class="rightCriteriaSection mx-3">
                <table class="table my-2 table-hover">
                    <thead>
                        <th>POs</th>
                        <th>PO Level</th>
                    </thead>
                    <tbody>
                        @for($i=0; $i<6; $i++)
                            <tr>
                                <th>{{ucwords($sheetsArr2[$i])}}</th>
                                <td>
                                    <input type="number" tablename="po" class="form-control p-3 marksInputField po"  id="{{$sheetsArr2[$i]}}-student" max="3" min="1" value="{{$po_levels[$sheetsArr2[$i]]}}"  style="height: 26px;">
                                </td>
                            </tr>
                        @endfor
                        <tr>
                            <th>Avg</th>
                            <td id="poAvg">{{$poAvg}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="ExtraCriteriaSection mx-3">

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(document).on("change", ".marksInputField", debounce(function(e){
                var stuId = e.target.getAttribute('id');
                var column = stuId.split("-")[0];
                var tablename = e.target.getAttribute("tablename");
                var maxVal = parseInt(e.target.getAttribute("max"));
                var minVal = parseInt(e.target.getAttribute("min"));
                var value = parseInt(e.target.value);
                if(value > maxVal){
                    value = maxVal;
                }
                else if(value < minVal){
                    value = minVal
                }
                $.ajax({
                    url: "{{route('updateThresholdCriteria')}}",
                    type: "POST",
                    data: {
                        '_token':"{{csrf_token()}}",
                        'tablename':tablename,
                        'column':column,
                        'value': value
                    },
                    success:(res)=>{
                        if(res == 0 || res == '0') 
                        {
                            e.target.style.backgroundColor = "red";
                            setTimeout(() => {
                                e.target.style.backgroundColor = "white"
                            }, 3000); 
                        }  
                        else{
                            e.target.style.backgroundColor = "rgb(222, 205, 248)";
                            setTimeout(() => {
                                e.target.style.backgroundColor = "white"
                            }, 1500);  
                            
                            // TO update po average on ui dynamically
                            const sheetsArr = ['PO1', 'PO2', 'PO3', 'PO4', 'PO5', 'PO6'];
                            var poAvg = 0;
                            var poAvgGroup = document.getElementsByClassName("po");
                            Array.from(poAvgGroup).forEach(element => {
                                console.log(element.value);
                                poAvg += parseInt(element.value);
                            });
                            console.log(poAvg);
                            document.getElementById("poAvg").innerHTML = (poAvg/6).toFixed(3);
                        }
                    }
                })

                
            }, 300));
        })
    </script>
@endsection