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
    .form{
        /* background: linear-gradient( 45deg, gray, blueviolet, violet); */

    }

</style>

<div class="xlsxInput">
    <x-alert-component mainclass="col-12" color="primary" message={{$msg}} />
    <div class="container my-3">
        <div class="leftSection" style="border:2px solid red;">
            {{-- Example Image here --}}
        </div>
        <div class="rightSection">
            <div class="rightUpperSection my-2" style="border:2px solid red;">

            </div>
            <div class="rightLowerSection my-2" style="border:2px solid red;">
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