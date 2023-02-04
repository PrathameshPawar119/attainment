@extends('layouts.attain')
@push('title')
    <title>Assignments Attainment</title>
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
    table{
        border: 9px transparent;
        background:linear-gradient(to right, rgb(248, 234, 248), rgb(226, 233, 247));
        text-align: center;
        border-radius: 8px;
    }
    table tbody tr{
        border-bottom: 1px;
        border-bottom-color: white;
        border-radius: 8px;
    }
    table tbody tr td{
        background:linear-gradient(to right, rgb(244, 217, 244), rgb(207, 218, 241));
        border-radius: 8px;
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
        <x-alert-component mainclass="col-12" color="primary" message="Assignments Attainment updated..." />
        <h4><center>Assignments Attainment</center></h4>
        <table class="table table-hover my-4 mx-4">
            <tbody>
                <tr>
                    <th>Assignment</th>
                    <th>Assign-1</th>
                    <th>Assign-2</th>
                </tr>
                <tr>
                    <th>{{$params['markCriteria']->assigns}}% of Total {{$params['totalMarks']->assign_total}}</th>
                    @for($i = 0; $i < 2; $i++)
                        <td>{{$params['criteriaFromTotalMarks']}}</td>
                    @endfor
                </tr>
                <tr>
                    <th>Number of Students Scored more than {{$params['criteriaFromTotalMarks']}}/{{$params['totalMarks']->assign_total}}</th>
                    <td>{{$assign1_arr[0]}}</td>
                    <td>{{$assign2_arr[0]}}</td>
                </tr>
                <tr>
                    <th>% of students scored more than {{$params['criteriaFromTotalMarks']}}/{{$params['totalMarks']->assign_total}}</th>
                    <td>{{$assign1_arr[1]}}%</td>
                    <td>{{$assign2_arr[1]}}%</td>
                </tr>
                <tr>
                    <th>COs</th>
                    <td>{{$assign1_arr[2]->assign1_co}}</td>
                    <td>{{$assign2_arr[2]->assign2_co}}</td>
                </tr>
                <tr>
                    <th>Attainment Level</th>
                    <th>{{$assign1_arr[3]}}</th>
                    <th>{{$assign2_arr[3]}}</th>
                </tr>
            </tbody>
        </table>
    </div>

<script>
    const leftChart = document.getElementById("leftChart");
    var ctx = leftChart.getContext("2d");
    ctx.font = "30px Cursive";
    ctx.fillText("Wait ...", 50, 50);

    $(document).ready(function(){
        $.ajax({
            url:"{{url('/attainment/charts/assign')}}",
            type:"GET",
            success: (res)=>{

                let delayed;
                new Chart(leftChart, {
                        type: "bar",  
                        data :{
                            labels: ['CO1', 'CO2', 'CO3', 'CO4', 'CO5', 'CO6'],
                            datasets: [{
                                label: 'Assignment Attainment levels',
                                data: JSON.parse(res['levels']['assignments']),
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
                            animation: {
                                onComplete: () => {
                                    delayed = true;
                                },
                                delay: (context) => {
                                    let delay = 0;
                                    if (context.type === 'data' && context.mode === 'default' && !delayed) {
                                    delay = context.dataIndex * 900 + context.datasetIndex * 300;
                                    }
                                    return delay;
                                },
                            }
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
                            },
                            animation: {

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
                            },
                            animation: {
                                animateScale:true
                            }
                        }

                    });
            }
        })
    })

</script>

@endsection


