@extends('layouts.attain')
@push('title')
    <title>Oral/Practical Attainment</title>
@endpush
<style>
    .rightChartBox, .leftChartBox{
        height: 320px;
    }
</style>
@section('upperLeft-section')
    <div class="rightChartBox" style="border: 2px solid red;">
        <canvas id="leftChart"></canvas>
    </div>
@endsection
@section('upperRight-section')
    <div class="rightChartBox" style="border: 2px solid red; margin:4px;">
        <canvas id="rightChart"></canvas>
    </div>
@endsection
@section('lower-section')
    @php
        $values = $resArr[0]."-".$resArr[1]."-".$resArr[2]."-".$resArr[3]."-".$resArr[4]."-".$resArr[5]."-".$resArr[6];
    @endphp
    <div class="lowerSectionBox container">
        <h4><center>Oral/Practical Attainment</center></h4>
        <x-htable values={{$values}} />
    </div>


    <script>
        $(document).ready(function(){
            $.ajax({
                url:"{{url('/api/charts/oral')}}",
                type:"GET",
                success: (res)=>{
                    console.log(res);
                }
            })
        })

        const leftChart = document.getElementById("leftChart");
        const Attain_level = "<?php echo $resArr[6]; ?>";
        console.log(Attain_level);

        new Chart(leftChart, {
            type: "bar",  
            data :{
                labels: ['CO1', 'CO2', 'CO3', 'CO4', 'CO5', 'CO6'],
                datasets: [{
                    label: 'Oral/Pract Attainment levels',
                    data: [Attain_level, Attain_level, Attain_level, Attain_level, Attain_level, Attain_level],
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

    </script>
@endsection