@extends('layouts.attain')
@push('title')
    <title>Endsem Attainment</title>
@endpush
<style>
     .leftChartBox{
        height: 300px;
    }
    .rightChartBox{
        height: 400px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@section('upperLeft-section')
    <div class="leftChartBox">
        <canvas id="leftChart"></canvas>
    </div>
@endsection
@section('upperRight-section')
    <div class="rightChartBox">
        <canvas id="rightChart"></canvas>
    </div>
@endsection
@section('lower-section')
    @php
        $values = $resArr[0]."-".$resArr[1]."-".$resArr[2]."-".$resArr[3]."-".$resArr[4]."-".$resArr[5]."-".$resArr[6];
    @endphp
    <div class="lowerSectionBox container">
            <x-alert-component mainclass="col-12" color="primary" message="Endsem Attainment updated..." />
                <h4><center>Endsem Attainment</center></h4>
        <x-htable values={{$values}} />
    </div>

    <script>
        const leftChart = document.getElementById("leftChart");
        var ctx1 = leftChart.getContext("2d");
        ctx1.font = "30px Cursive";
        ctx1.fillText("Wait ...", 50, 50);

        const rightChart = document.getElementById("rightChart");
        var ctx2 = rightChart.getContext("2d");
        ctx2.font = "30px Cursive";
        ctx2.fillText("Wait ...", 50, 50);


        $(document).ready(function(){
            $.ajax({
                url:"{{url('/attainment/charts/endsem')}}",
                type:"GET",
                success: (res)=>{

                    new Chart(leftChart, {
                        type: "bar",  
                        data :{
                            labels: ['CO1', 'CO2', 'CO3', 'CO4', 'CO5', 'CO6'],
                            datasets: [{
                                label: 'Oral/Pract Attainment levels',
                                data: JSON.parse(res['levels']['endsem']),
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

                    
                    new Chart(rightChart, {
                        type: 'polarArea',
                        data: {
                            labels: JSON.parse(res['constraints']),
                            datasets: [{
                                label: "Students",
                                data: (res['data']),
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