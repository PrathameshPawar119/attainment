@extends('layouts.attain')
@push('title')
    <title>Endsem Attainment</title>
@endpush
<style>
    div{
        height: 400px;
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
    <div class="rightChartBox" style="border: 2px solid red;">

    </div>
@endsection
@section('upperRight-section')
    <div class="leftChartBox" style="border: 2px solid red;">

    </div>
@endsection
@section('lower-section')
    <div class="lowerSectionBox container">
        <h4><center>Assignments Attainment</center></h4>
        <table class="table table-hover my-4 mx-4">
            <tbody>
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
                    <td>{{$assign1_arr[3]}}</td>
                    <td>{{$assign2_arr[3]}}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection


