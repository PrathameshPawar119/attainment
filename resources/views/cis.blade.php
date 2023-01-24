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

    function round_ceil( $value, $precision ) { 
        $pow = pow ( 10, $precision ); 
        return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow; 
    } 
    $msg = "...";
    if (session()->has("alertMsg")) {
        $msg = session()->get("alertMsg");
    }

    $po_list = array("PO1", "PO2", "PO3", "PO4", "PO5", "PO6");

    
    $oral_arr = json_decode($attain_levels->oral);
    $endsem_arr = json_decode($attain_levels->endsem); // special
    $assign_arr = json_decode($attain_levels->assignments);
    $ia_arr = json_decode($attain_levels->ia);
    $expt_arr = json_decode($attain_levels->experiments);

    // array of totals of oral+assign+ia+expt
    $groupATotal = array();
    for ($i=0; $i < 6; $i++) { 
        array_push($groupATotal, ($oral_arr[$i] + $assign_arr[$i] + $ia_arr[$i] + $expt_arr[$i]));
    }

    //scale arr by formula -->
    // ((groupATotal*0.2)/4 + endsem*0.8)
    $scaleTotal = array();
    for ($i=0; $i < 6; $i++) { 
        if ($i == 5 || $i == 1) {
            array_push($scaleTotal, round((($endsem_arr[$i]*0.8) + ($groupATotal[$i])*0.2/3), 3)); 
        }
        else{
            array_push($scaleTotal, round((($endsem_arr[$i]*0.8) + ($groupATotal[$i])*0.2/4), 3));
        }
    }

    // 
    $expectedAttTotal = 0;
    $observedAttTotal = 0;
    // Final attainment ==>scale*po/3
    $finalCOPOAttainment = array();
    for ($i=0; $i < 6; $i++) { 
        array_push($finalCOPOAttainment, round(($scaleTotal[$i]*($po_levels[$po_list[$i]]/3)), 3));
        $expectedAttTotal += $po_levels[$po_list[$i]];
        $observedAttTotal += $finalCOPOAttainment[$i];
    }

    $expectedAtt = round($expectedAttTotal/6, 3);
    $observedAtt = round($observedAttTotal/6, 3);


    @endphp
@section('main-section')
    <div class="cisContainer">
    <x-alert-component mainclass="col-12" color="primary" message="{{$msg}}" />
        <div class="AttainmentTable container table-responsive my-4">
            <h5>Assesment Tools for attainment</h5>
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
                        @foreach ($oral_arr as $level)
                            <td>{{$level}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th>End-Sem</th>
                        @foreach ($endsem_arr as $level)
                            <td>{{$level}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Assignments</th>
                        @foreach ($assign_arr as $level)
                            <td>{{$level}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Internal Assessments (IA)</th>
                        @foreach ($ia_arr as $level)
                            <td>{{$level}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Experiments</th>
                        @foreach ($expt_arr as $level)
                            <td>{{$level}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Total Oral/Assigns/Ia/Expt</th>
                        @foreach ($groupATotal as $level)
                            <td>{{$level}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Scale</th>
                        @foreach ($scaleTotal as $scale)
                            <td>{{$scale}}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <table class="table my-2 text-center">
                <h5 class="mt-3">Final CO Attainments</h5>
                <tbody>
                    <tr>
                        <th></th>
                        <th>CO1</th>
                        <th>CO2</th>
                        <th>CO3</th>
                        <th>CO4</th>
                        <th>CO5</th>
                        <th>CO6</th>
                        <td>Total</td>
                        <td>Observed Attainment</td>
                    </tr>
                    <tr>
                        <th>PO1</th>
                        @foreach ($finalCOPOAttainment as $attainm)
                            <td>{{$attainm}}</td>
                        @endforeach
                        <td>{{$observedAttTotal}}</td>
                        <td>{{$observedAtt}}</td>
                    </tr>
                </tbody>

                <table class="table my-2 text-center">
                    <h5 class="mt-4">Final Attainment Gap</h5>
                    <tbody>
                        <tr>
                            <th></th>
                            <th>Expected CO Attainment</th>
                            <th>Observed CO Attainment</th>
                            <th>CO GAP</th>
                        </tr>
                        <tr>
                            <th>PO1</th>
                            <td>{{$expectedAtt}}</td>
                            <td>{{$observedAtt}}</td>
                            <td> <b>{{($expectedAtt - $observedAtt)}}</b>  &nbsp;~ {{round_ceil(($expectedAtt - $observedAtt), 2)}}</td>
                        </tr>
                    </tbody>
                </table>
            </table>
        </div>

    </div>
@endsection