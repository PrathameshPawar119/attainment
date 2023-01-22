@extends('layouts.main')
@push('title')
    <title>CIS Sheet</title>
@endpush    
<style>
    .AttainmentTable table{
        border: 4px transparent;
        background:linear-gradient(to right, rgb(248, 234, 248), rgb(226, 233, 247));
        text-align: center;
        border-radius: 8px;
    }
    .AttainmentTable table tbody tr{
        border-bottom: 1px;
        border-bottom-color: white;
        border-radius: 8px;
    }
    .AttainmentTable table tbody tr td{
        background:linear-gradient(to right, rgb(244, 217, 244), rgb(207, 218, 241));
        border-radius: 8px;
    }
    .highlightTd{
        background: linear-gradient(to right, rgb(255, 248, 255), rgb(245, 241, 248));
        border:2px transparent;
        border-radius: 4px;
    }
</style>
@php
    $msg = "...";
    if (session()->has("alertMsg")) {
        $msg = session()->get("alertMsg");
    }
@endphp
@section('main-section')
    <div class="cisContainer">
    <x-alert-component mainclass="col-12" color="primary" message="{{$msg}}" />
        <div class="AttainmentTable container table-responsive my-4">
            <table class="table my-2 table-hover text-center">
                <tbody>
                    <tr>
                        <th></th>
                        <th>CO1</th>
                        <th>CO2</th>
                        <th>CO3</th>
                        <th>CO4</th>
                        <th>CO5</th>
                        <th>CO6</th>
                    </tr>
                    <tr>
                        <th>Oral-Practical</th>
                        @foreach (json_decode($attain_levels->oral) as $level)
                            <td>{{$level}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th>End-Sem</th>
                        @foreach (json_decode($attain_levels->endsem) as $level)
                            <td>{{$level}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Assignments</th>
                        @foreach (json_decode($attain_levels->assignments) as $level)
                            <td>{{$level}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Internal Assessments (IA)</th>
                        @foreach (json_decode($attain_levels->ia) as $level)
                            <td>{{$level}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Experiments</th>
                        @foreach (json_decode($attain_levels->experiments) as $level)
                            <td>{{$level}}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
@endsection