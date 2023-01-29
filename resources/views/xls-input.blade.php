@extends('layouts.main')

@section('main-section')
@push('title')
    <title>XLSX input</title>
@endpush
@php
    $msg = "...";
    if (session()->has("alertMsg")) {
        $msg = session()->get("alertMsg");
    }
    $user_id = session()->get('user_id');
@endphp
<style>
    .container{
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 1fr;
        padding: 10px;
        height: 600px;
    }
    .rightSection{
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 3fr 2fr;
        padding: 10px;
        height: 600px;;
    }
    .leftSection, .rightSection{
        background: linear-gradient(45deg, rgb(251, 237, 251), rgb(224, 197, 249));
        border: 5px transparent;
        border-radius: 8px;
        margin-left: 10px;
        margin-right: 10px;
    }
    .leftSectionTitle, .rightLowerSection., .rightLowerSection button{
        margin: 4px;
    }
    .form{
        /* background: linear-gradient( 45deg, gray, blueviolet, violet); */

    }
    @media (max-width:800px){
        .container{
            grid-template-columns: 1fr;
            grid-template-rows: 1fr 1fr;
        }
    }

</style>

<div class="xlsxInput">
    <x-alert-component mainclass="col-12" color="primary" message={{$msg}} />
    <div class="container my-3">
        <div class="leftSection p-3">
            <h3 class="leftSectionTitle">Default Format to upload .xlsx file</h3>
            <img src="{{asset('images/default_format.png')}}" alt="Default Format" style="width: 100%; height:90%; border-radius:8px; opacity:0.9;">
        </div>
        <div class="rightSection">
            <div class="rightUpperSection my-2 p-3">
                <p>
                    <h4> 🤔 Some Conditions to upload file</h4>
                    <ul>
                        <li>File Header format must be same as image given.</li>
                        <li>Columns may alter but <strong>Header names Must be same.</strong> 
                            <ul style="list-style:none">
                                <li><strong>✔️student_id</strong> </li>
                                <li><strong>✔️div</strong> </li>
                                <li><strong>✔️roll_no</strong></li>
                                <li><strong>✔️name</strong></li>
                                <li><strong>✔️gender</strong> </li>
                            </ul>
                            <small>Sequence need not to be same.</small>
                        </li>
                        <li><strong>Same or duplicate entries will be skipped.</strong> </li>
                        <li>Wait some time and check <a href="{{url('/students/view')}}">here</a> after Complete.</li>
                    </ul>
                </p>
            </div>
            <div class="rightLowerSection my-2" style="background:linear-gradient(45deg, rgb(251, 205, 251), rgb(174, 191, 251)); border:4px transparent; border-radius:6px;">
                <div class="form m-3 p-2">
                    <form action="{{url('/upload/submit-file')}}" method="POST" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload XLSX* File</label>
                            <input class="form-control" type="file" name="xlsfile" id="formFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            <p><small style="color: red;">
                                @error("xlsfile")
                                    {{$message}}
                                @enderror
                            </small></p>
                        </div>
                        <button type="submit" class="btn btn-primary col-12">Render Students</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

    
@endsection