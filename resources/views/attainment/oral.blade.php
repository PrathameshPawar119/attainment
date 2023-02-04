@extends('layouts.attain')
@push('title')
    <title>Oral/Practical Attainment</title>
@endpush
<style>
    .rightChartBox, .leftChartBox{
        height: 300px;
    }
</style>
@section('upperLeft-section')
    <div class="leftChartBox">
        <canvas id="leftChart">
            {{-- <div class="spinner-grow text-secondary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div> --}}
        </canvas>
    </div>
@endsection
@section('upperRight-section')
    <div class="rightChartBox" style="margin:8px; border: 2px solid red;">
        <canvas id="rightChart"></canvas>
    </div>
@endsection
@section('lower-section')
    @php
        $values = $resArr[0]."-".$resArr[1]."-".$resArr[2]."-".$resArr[3]."-".$resArr[4]."-".$resArr[5]."-".$resArr[6];
    @endphp
    <div class="lowerSectionBox container">
        <x-alert-component mainclass="col-12" color="primary" message="Oral Attainment updated..." />
        <h4><center>Oral/Practical Attainment</center></h4>
        <x-htable values={{$values}} />
    </div>


    <script>
        const leftChart = document.getElementById("leftChart");
        var ctx = leftChart.getContext("2d");
        ctx.font = "30px Cursive";
        ctx.fillText("Wait ...", 50, 50);

        $(document).ready(function(){
            $.ajax({
                url:"{{url('/attainment/charts/oral')}}",
                type:"GET",
                success: (res)=>{


                    new Chart(leftChart, {
                        type: "bar",  
                        data :{
                            labels: ['CO1', 'CO2', 'CO3', 'CO4', 'CO5', 'CO6'],
                            datasets: [{
                                label: 'Oral/Pract Attainment levels',
                                data: JSON.parse(res['levels']['oral']),
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
                        }
                    })
                }
            })
        })



    </script>
@endsection