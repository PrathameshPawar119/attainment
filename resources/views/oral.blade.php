@extends('layouts.main')
@push('title')
    <title>Oral-Practical</title>
@endpush
@section('main-section')

<div class="container oralPage">
    <div class="viewUpperBox col-12" style="margin:16px 0px 0px 0px; display:flex; flex-direction:row; justify-content:space-between;">
        <form action="{{('/sheets/oral')}}" method="get" style="display: inline-block;">
            <div class="input-group mx-1">
                <input type="text" class="form-control" placeholder="Search name here" value="{{old("searchForm")}}" name="searchForm" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        <div class="upperBoxBtns" style="display: inline-block;">
            <a href="{{url("/students/input")}}" class="mx-2"><button class="btn btn-outline-secondary">{{$trashBtn}}</button></a>
            <button class="btn btn-outline-secondary" type="submit" value="update" >Refresh</button>
        </div>
    </div>
    <table class="table my-2 table-hover">
        <thead>
            <tr>
            <th scope="col">Sr. No</th>
            <th scope="col">DIV</th>
            <th scope="col">Roll No.</th>
            <th scope="col">Student ID</th>
            <th scope="col">Name</th>
            <th scope="col">Oral-Practical</th>
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
                                <input type="number" class="form-control my-0 marksInputField" name="{{$student->student_id}}"  id="{{$student->group_key}}-student" value="{{$student->oral_marks}}" style="height: 26px;">
                            </div>
                        </td>
                    </tr>
                @endforeach
            </form>
        </tbody>
    </table>
    <div class="row center p-2" style="align-items: center; text-align:center;">
        {{$students->links()}}
    </div>
</div>
<script>
    $(document).ready(function(){
        // Change Input Marks -- autoupdate
        $(document).on("change", ".marksInputField", function(e){
            var stuId = e.target.getAttribute("name");
            var stdValue = e.target.value;
            var stuGroupKey = e.target.getAttribute("id");
                $.ajax({
                    url: "{{route('updateOralMarks')}}",
                    type: "POST",
                    data: {
                        '_token':"{{csrf_token()}}",
                        'id': stuId,
                        'value': stdValue
                    },
                    success: function (res){
                        if(res == '0' ||  res == 0){
                            document.getElementById(stuGroupKey).parentNode.style.borderColor = "red";
                            setTimeout(() => {
                                document.getElementById(stuGroupKey).parentNode.style.borderColor = "rgb(86, 3, 114)";
                            }, 5000);                        }
                        else if(res == '1'|| res == 1){
                            document.getElementById(stuGroupKey).parentNode.style.borderColor = "cyan";
                            setTimeout(() => {
                                document.getElementById(stuGroupKey).parentNode.style.borderColor = "rgb(86, 3, 114)";
                            }, 2000); 
                        }
                        else{
                            console.log(res);
                        }
                    }
            })

        });
    })
</script>
@endsection