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

    </div>
@endsection
@section('upperRight-section')
    <div class="leftChartBox" style="border: 2px solid red;">

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
@endsection