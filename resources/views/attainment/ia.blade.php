@extends('layouts.attain')
@push('title')
    <title>IA Attainment</title>
@endpush
<style>

    .LowerAttainmentTable table{
        border: 9px transparent;
        background:linear-gradient(to right, rgb(248, 234, 248), rgb(226, 233, 247));
        text-align: center;
        border-radius: 8px;
    }
    .LowerAttainmentTable table tbody tr{
        border-bottom: 1px;
        border-bottom-color: white;
        border-radius: 8px;
    }
    .LowerAttainmentTable table tbody tr td{
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
        <h4><center>IA Attainment</center></h4>
        {{-- Table to show co_total_ia --}}
            <div class="viewUpperBox col-12" style="margin:16px 0px 0px 0px; display:flex; flex-direction:row; justify-content:space-between;">
                <form action="{{('/sheets/assignment')}}" method="get" style="display: inline-block;">
                    <div class="input-group mx-1">
                        <input type="text" class="form-control" placeholder="Search name here" value="{{old('searchForm')}}" name="searchForm" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                    </div>
                </form>
                <div class="upperBoxBtns" style="display: inline-block;">
                    <a href="{{url("/attainment/assignment")}}" class="mx-2"><button class="btn btn-outline-secondary">Analysis</button></a>
                    <button class="btn btn-outline-secondary" type="submit" value="update">Refresh</button>
                </div>
            </div>
        <div class="table-responsive">
            <table class="table my-2 table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">Sr. No</th>
                        <th scope="col">DIV</th>
                        <th scope="col">Roll No.</th>
                        <th scope="col">Student ID</th>
                        <th style="width: 300px;" scope="col">Full Name</th>
                        <th class="sideColumn1" scope="col">CO1</th>
                        <th class="sideColumn1" scope="col">CO2</th>
                        <th class="sideColumn1" scope="col">CO3</th>
                        <th class="sideColumn1" scope="col">CO4</th>
                        <th class="sideColumn1" scope="col">CO5</th>
                        <th class="sideColumn1" scope="col">CO6</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!isset($co_total_table_details))
                        {{"Please add some students Please"}}            
                    @endif
                    <form id="ia_attainment_Sheet">
                        @foreach($co_total_table_details as $key=>$student)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$student->div}}</td>
                                <td>{{$student->roll_no}}</td>
                                <td>{{$student->student_id}}</td>
                                <td style="width: 300px; text-align:left;">{{$student->name}}</td>
                                <td class="sideColumn1">
                                    {{$student->CO1}}
                                </td>
                                <td class="sideColumn2">
                                    {{$student->CO2}}
                                </td>
                                <td class="sideColumn3">
                                    {{$student->CO3}}
                                </td>
                                <td class="sideColumn4">
                                    {{$student->CO4}}
                                </td>
                                <td class="sideColumn5">
                                    {{$student->CO5}}
                                </td>
                                <td class="sideColumn6">
                                    {{$student->CO6}}
                                </td>
                            </tr>
                        @endforeach
                    </form>
                </tbody>
            </table>
        </div>
    {{-- <div class="LowerAttainmentTable">
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
        </div> --}}
    </div>
@endsection


