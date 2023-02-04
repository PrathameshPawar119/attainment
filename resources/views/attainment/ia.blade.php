@extends('layouts.attain')
@push('title')
    <title>IA Attainment</title>
@endpush
<style>
    .rightChartBox, .leftChartBox{
        height: 320px;
    }
    .SelectBox::-webkit-scrollbar{
        width: 12px;
    }
    .SelectBox::-webkit-scrollbar-track{
        background : #555999;
        border-radius: 10px;
    }
    .SelectBox::-webkit-scrollbar-thumb{
        background : rgba(255,255,255,0.5);
        border-radius: 10px;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.5);
    }
</style>
@section('upperLeft-section')
    <div class="leftChartBox" style="margin: 8px;">
        <canvas id="leftChart"></canvas>
    </div>
@endsection
@section('upperRight-section')
    <div class="rightChartBox" style="border: 2px solid red;">

    </div>
@endsection
@section('lower-section')

    <div class="lowerSectionBox container">
                <x-alert-component mainclass="col-12" color="primary" message="IA Attainment updated..." />
        <h4><center>IA Attainment</center></h4>
        {{-- Table to show co_total_ia --}}
            <div class="viewUpperBox col-12" style="margin:16px 0px 0px 0px; display:flex; flex-direction:row; justify-content:space-between;">
                <form action="{{('/sheets/assignment')}}" method="get" style="display: inline-block;">
                    <div class="input-group mx-1">
                        <input type="text" class="form-control" placeholder="Not Working Yet" value="{{old('searchForm')}}" name="searchForm" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                    </div>
                </form>
                <div class="upperBoxBtns" style="display: inline-block;">
                    <a href="{{url("/attainment/assignment")}}" class="mx-2"><button class="btn btn-outline-secondary">Analysis</button></a>
                    <button class="btn btn-outline-secondary" type="submit" value="update">Refresh</button>
                </div>
            </div>
        <div class="table-responsive">
            <table class="table mt-2 mb-0">
                <thead>
                    <tr>
                        <th scope="col">Sr. No</th>
                        <th scope="col">DIV</th>
                        <th scope="col">Roll No.</th>
                        <th scope="col">Student ID</th>
                        <th style="width: 300px;" scope="col">Full Name</th>
                        <th class="sideColumn1" scope="col">CO1</th>
                        <th class="sideColumn1" scope="col">CO2</th>
                        <th class="sideColumn1" scope="col">CO3</th>
                        <th class="sideColumn1" scope="col">CO4</th>
                        <th class="sideColumn1" scope="col">CO5</th>
                        <th class="sideColumn1" scope="col">CO6</th>
                    </tr>
                </thead>
            </table>
            <div class="SelectBox" style="height:500px; overflow-y:auto;">
                <table class="table table-hover text-center">
                    <tbody class="scrolldown">
                        @if (!isset($co_total_table_details))
                            {{"Please add some students Please"}}            
                        @endif
                        <form id="ia_attainment_Sheet">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total Marks</td>
                                @for ($i=0; $i<6; $i++)
                                    <td class="highlightTd">/{{$outof_per_co[$i]}}</td>
                                @endfor
                            </tr>
                                @foreach($co_total_table_details as $key=>$student)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$student->div}}</td>
                                        <td>{{$student->roll_no}}</td>
                                        <td>{{$student->student_id}}</td>
                                        <td style="width: 300px; text-align:left;">{{$student->name}}</td>
                                        <td class="sideColumn1">
                                            {{$student->CO1}}
                                        </td>
                                        <td class="sideColumn2">
                                            {{$student->CO2}}
                                        </td>
                                        <td class="sideColumn3">
                                            {{$student->CO3}}
                                        </td>
                                        <td class="sideColumn4">
                                            {{$student->CO4}}
                                        </td>
                                        <td class="sideColumn5">
                                            {{$student->CO5}}
                                        </td>
                                        <td class="sideColumn6">
                                            {{$student->CO6}}
                                        </td>
                                    </tr>
                                @endforeach
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="LowerAttainmentTable container">
            <table class="table table-hover my-4 mx-4">
                <tbody>
                    <th>
                        <th>CO1</th>
                        <th>CO2</th>
                        <th>CO3</th>
                        <th>CO4</th>
                        <th>CO5</th>
                        <th>CO6</th>
                    </th>
                    <tr>
                        <th>Total Marks For CO</th>
                        @for ($i=0; $i<6; $i++)
                            <td>{{$all_co_params[$i]['totalMarks']}}</td>
                        @endfor
                    </tr>
                    <tr>
                        {{-- Mark Criteria is same for all COs --}}
                        <th>{{$all_co_params[0]['markCriteria']->ia}}% of Total Marks (Marks Criteria)</th>
                        @for($i = 0; $i < 6; $i++)
                            <td>{{$all_co_params[$i]['criteriaFromTotalMarks']}}</td>
                        @endfor
                    </tr>
                    <tr>
                        <th>Number of Students Scored more than Mark Criteria</th>
                        @for ($i=0; $i<6; $i++)
                            <td>{{$finalCoAttainments[$i]['numStdMoreThanCriteria']}}</td>
                        @endfor
                    </tr>
                    <tr>
                        <th>% of students scored more than {{$all_co_params[0]['markCriteria']->ia}}% of Total Marks</th>
                        @for ($i=0; $i<6; $i++)
                            <td>{{$finalCoAttainments[$i]['perStdMoreThanCriteria']}}%</td>
                        @endfor
                    </tr>
                    <tr>
                        <th>Attainment Level</th>
                        @for ($i=0; $i<6; $i++)
                            <td>{{$finalCoAttainments[$i]['attain_level']}}</td>
                        @endfor
                    </tr>
                </tbody>
            </table> 
        </div>
    </div>

    <script>
        const leftChart = document.getElementById("leftChart");
        var ctx = leftChart.getContext("2d");
        ctx.font = "30px Cursive";
        ctx.fillText("Wait ...", 50, 50);

        $(document).ready(function(){
            $.ajax({
                url:"{{url('/attainment/charts/IA')}}",
                type:"GET",
                success: (res)=>{


                    new Chart(leftChart, {
                        type: "bar",  
                        data :{
                            labels: ['CO1', 'CO2', 'CO3', 'CO4', 'CO5', 'CO6'],
                            datasets: [{
                                label: 'IA Attainment levels',
                                data: JSON.parse(res['levels']['ia']),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                beginAtZero: true,
                                suggestedMax: 3.0
                                },
                                x: {

                                }
                            }
                        },
                    })
                }
            })
        })



    </script>

@endsection


