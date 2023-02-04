@extends('layouts.attain')
@push('title')
    <title>IA Attainment</title>
@endpush
<style>
     .leftChartBox{
        height: 300px;
    }
    .rightChartBox{
        height: 300px;
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
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
    <div class="leftChartBox">
        <canvas id="leftChart"></canvas>
    </div>
@endsection
@section('upperRight-section')
    <div class="rightChartBox px-3">
        <canvas id="rightChart1"></canvas>
        <canvas id="rightChart2"></canvas>
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

        const rightChart = document.getElementById("rightChart1");
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
                                label: 'Assignment Attainment levels',
                                data: JSON.parse(res['levels']['ia']),
                                borderWidth: 1,
                                backgroundColor:[
                                    'rgb(153, 102, 215, 0.5)',
                                    'rgb(150, 102, 225, 0.5)',
                                    'rgb(153, 109, 235, 0.5)',
                                    'rgb(168, 102, 245, 0.5)',
                                    'rgb(153, 118, 255, 0.5)',
                                    'rgb(163, 112, 205, 0.5)'
                                ],
                                borderColor:[
                                    'rgb(153, 102, 255)',
                                    'rgb(153, 102, 255)',
                                    'rgb(153, 102, 255)',
                                    'rgb(153, 102, 255)',
                                    'rgb(153, 102, 255)',
                                    'rgb(153, 102, 255)'
                                ]
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
                            },

                        }
                    });

                    new Chart(rightChart1, {
                        type: 'polarArea',
                        data: {
                            labels: JSON.parse(res['constraints1']),
                            datasets: [{
                                label: "Students",
                                data: (res['data1']),
                                backgroundColor:[
                                    'rgb(113, 112, 215, 0.9)',
                                    'rgb(120, 132, 225, 0.9)',
                                    'rgb(133, 159, 235, 0.9)',
                                    'rgb(148, 172, 245, 0.9)',
                                    'rgb(153, 198, 255, 0.9)',
                                    'rgb(163, 212, 205, 0.9)'
                                ],
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'right'
                                }
                            }
                        }

                    });

                    new Chart(rightChart2, {
                        type: 'polarArea',
                        data: {
                            labels: JSON.parse(res['constraints2']),
                            datasets: [{
                                label: "Students",
                                data: (res['data2']),
                                backgroundColor:[
                                    'rgb(113, 112, 215, 0.9)',
                                    'rgb(120, 132, 225, 0.9)',
                                    'rgb(133, 159, 235, 0.9)',
                                    'rgb(148, 172, 245, 0.9)',
                                    'rgb(153, 198, 255, 0.9)',
                                    'rgb(163, 212, 205, 0.9)'
                                ],
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'right'
                                }
                            }
                        }

                    });
                }
            })
        })



    </script>

@endsection


