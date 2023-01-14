@extends('layouts.attain')
@push('title')
    <title>Oral/Practical Attainment</title>
@endpush
<style>
    div{
        height: 400px;
    }
</style>
@section('upperLeft-section')
    <div class="rightChartBox" style="border: 2px solid red;">
        <canvas id="leftChart"></canvas>
    </div>
@endsection
@section('upperRight-section')
    <div class="rightChartBox" style="border: 2px solid red;">
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
        // const leftChart = document.getElementById("leftChart");

        // const Attain_level = "<?php echo $resArr[6]; ?>";
        // console.log(Attain_level);

        // new Chart(leftChart, {
        //     type: "bar",  
        //     data :{
        //         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        //         datasets: [{
        //             label: '# of Votes',
        //             data: [Attain_level, Attain_level, Attain_level, Attain_level, Attain_level, Attain_level],
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //     scales: {
        //         y: {
        //         beginAtZero: true
        //         },
        //         x: {

        //         }
        //     }
        //     }
        // })

    </script>
@endsection