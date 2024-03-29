@extends('layouts.main')
@push('title')
    <title>End-Sem</title>
@endpush
@section('main-section')
@php
    $msg = "...";
    if (session()->has("alertMsg")) {
        $msg = session()->get("alertMsg");
    }

@endphp
<div class="container oralPage">
    <x-alert-component mainclass="col-12" color="primary" message="{{$msg}}" />
    <div class="viewUpperBox col-12" style="margin:16px 0px 0px 0px; display:flex; flex-direction:row; justify-content:space-between;">
        <form action="{{('/sheets/endsem')}}" method="get" style="display: inline-block;">
            <div class="input-group mx-1">
                <input type="text" class="form-control" placeholder="Search name here" value="{{"$searchText"}}" name="searchForm" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <div class="upperBoxBtns" style="display: inline-block;">
            <a href="{{url("/attainment/endsem")}}" class="mx-2"><button class="btn btn-outline-secondary">{{$trashBtn}}</button></a>
            <button class="btn btn-outline-secondary" type="submit" value="update" >Refresh</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table my-2 table-hover">
            <thead>
                <tr>
                <th scope="col">Sr. No</th>
                <th scope="col">DIV</th>
                <th scope="col">Roll No.</th>
                <th scope="col">Student ID</th>
                <th scope="col">Name</th>
                <th scope="col">End-Sem</th>
                </tr>
            </thead>
            <tbody>
                @if (!isset($students))
                    {{"Please add some students Please"}}            
                @endif
                <form id="oramMarksForm">
                    @foreach($students as $key=>$student)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$student->div}}</td>
                            <td>{{$student->roll_no}}</td>
                            <td>{{$student->student_id}}</td>
                            <td>{{$student->name}}</td>
                            <td>
                                <div class="smallInputField center my-0" style="border:2px solid rgb(86, 3, 114); border-radius:6px; width:80px;">
                                    <input type="number" class="form-control my-0 marksInputField" name="{{$student->id}}"  id="{{$student->group_key}}" max="{{$endsem_total_max[0]->endsem_total}}" min="0" value="{{$student->endsem_mark}}" style="height: 26px;">
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>
    </div>
    <div class="row center p-2" style="align-items: center; text-align:center; ">
        {{$students->links('pagination::bootstrap-5')}}
    </div>
</div>
<script>
    $(document).ready(function(){
        $(document).on("change", ".marksInputField", debounce(function(e){
            var endsem_max_limit = parseInt("<?php echo $endsem_total_max[0]->endsem_total; ?>");
            var stuId = e.target.getAttribute("name");
            var stdVal = parseInt(e.target.value);
            var stuGroupKey = e.target.getAttribute("id");
            if (stdVal > endsem_max_limit) {
                e.target.parentNode.style.borderColor = "red";
            }
            else{
                $.ajax({
                    url: "{{route('updateEndsemMarks')}}",
                    type:"POST",
                    data: {
                        '_token': "{{csrf_token()}}",
                        'id':stuId,
                        'value':stdVal
                    },
                    success: function(res){
                            if(res == '0' ||  res == 0){
                                e.target.parentNode.style.borderColor = "red";
                                setTimeout(() => {
                                    e.target.parentNode.style.borderColor = "rgb(86, 3, 114)";
                                }, 5000);                        }
                            else if(res == '1'|| res == 1){
                                e.target.parentNode.style.borderColor = "cyan";
                                setTimeout(() => {
                                    e.target.parentNode.style.borderColor = "rgb(86, 3, 114)";
                                }, 1500); 
                            }
                            else{
                                console.log(res);
                            }
                    }
                });
            }
        }, 300));
    });
</script>
@endsection