@extends('layouts.attain')
@push('title')
    <title>Endsem Attainment</title>
@endpush
<style>
    .rightChartBox, .leftChartBox{
        height: 320px;
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
            <x-alert-component mainclass="col-12" color="primary" message="Endsem Attainment updated..." />
                <h4><center>Endsem Attainment</center></h4>
        <x-htable values={{$values}} />
    </div>
@endsection