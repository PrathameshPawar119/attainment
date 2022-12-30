@extends('layouts.main')
@push('title')
    <title>COs Input</title>
@endpush
@push('head')

@endpush
@section('main-section')
    <style>
        .tabLine{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            height: 88px;
        }
        .tabs{
            width: 70%;
            margin: 10px 0px;
            padding: 4px;
            background-color: rgb(239, 205, 248);
            border:2px transparent;
            border-radius: 8px;
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: black;
            text-align: center;
            text-decoration: none;
        }
        .tabs:hover{
            padding: 8px;
            background-color: rgb(232, 176, 251);
            border: 3px transparent;
            border-radius: 10px;
            cursor: pointer;
        }
        .tabs img{
            width: 60px;
            height: 50px;
        }
        .lineBox{
            display: flex;
            flex-direction: column;
            padding: 0px;
        }
        .lineHere1{
            width: 80px;
            height: 40px;
            margin: 0px;
            border: 2px solid rgb(150, 72, 222);
            border-top-width: 0px;
            border-right-width: 0px;
            border-left-width: 0px;
            border-bottom-left-radius: 6px;
        }
        .lineHere2{
            width: 80px;
            height: 40px;
            margin: 0px;
            border: 2px solid rgb(150, 72, 222);
            border-bottom-width: 0px;
            border-right-width: 0px;
            border-left-width: 0px;
            border-top-left-radius: 6px;
        }
        .inputSection{
            margin: 60px 10px 10px 10px;
            display: grid;
            grid-template-columns: 2fr 5fr;
            grid-template-rows: 1fr;
            grid-gap: 20px;
            align-items: center;
        }
        .dropdown-toggle{
            height: 40px;
            width: 400px !important;
        }
        .iaCoInputSectionBlock{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
            grid-template-rows: 1fr;
        }
        .exptCoInputSectionBlock{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
            grid-template-rows: 1fr;
        }
        .SelectBox{
            border-radius: 8px;
            background-color: rgb(228, 220, 250);
        }
        .SelectBox::-webkit-scrollbar{
            width: 12px;
        }
        .SelectBox::-webkit-scrollbar-track{
            background : #555999;
            border-radius: 10px;
        }
        .SelectBox::-webkit-scrollbar-thumb{
            background : rgba(255,255,255,0.5);
            border-radius: 10px;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.5);
        }
        .SelectBox label{
            border-radius: 4px;
            width:100%;
        }
        .SelectBox label:hover{
            cursor: pointer;
        }
        .SelectBox .checkBoxRow{
            border-radius: 4px;
            transition: all 0.4s ease;
        }
        .SelectBox .checkBoxRow:hover{
            background-color: rgb(228, 201, 250);
        }
        .form-group{
            margin-bottom: 10px;
        }

    </style>
    @php
        $parameters = array("CO1", "CO2", "CO3", "CO4", "CO5", "CO6");
        $IaParameters = array("IA1Q1", "IA1Q2", "IA1Q3", "IA1Q4", "IA2Q1", "IA2Q2", "IA2Q3", "IA2Q4");
        $ExpParameters = array("EXP-1", "EXP-2", "EXP-3", "EXP-4", "EXP-5", "EXP-6", "EXP-7", "EXP-8", "EXP-9", "EXP-10", "EXP-11", "EXP-12");
    @endphp
    <div class="container">
        <div class="tabLine">
            <a href="{{url('/user/criteriaInput')}}" class="tabs">
                <div id="criteriaInputBox">
                    <img src="{{URL::to('/')}}/images/testing.png" alt="">
                    <h5>Total Marks</h5>
                </div>
            </a>
            <div class="lineBox">
                <div class="lineHere1"></div>
                <div class="lineHere2"></div>
            </div>
            <a href="#" class="tabs">
                <div id="coInputBox">
                    <img src="{{URL::to('/')}}/images/sharing.png" alt="">
                    <h4>Select CO's</h4>
                    <p>Mandantory Before Getting Attainment*</p>
                </div>
            </a>
            <div class="lineBox">
                <div class="lineHere1"></div>
                <div class="lineHere2"></div>
            </div>
            <a href="{{url('/user/thresholdMarksInput')}}" class="tabs">
                <div id="thresholdInputBox">
                    <img src="{{URL::to('/')}}/images/testing.png" alt="">
                    <h4>Mark Criteria</h4>
                </div>
            </a>
        </div>
        <div class="inputSection" id="inputSection">
                <div class="inputSectionLeft">
                    <div class="row my-4" style="background-color: rgb(243, 235, 251); border-radius:10px;">
                        <center><h4 class="">Oral & Endsem COs</h4></center>
                        <div class="oralInputDiv col-md-6 form-group">
                            <label for="oralCoInput" class="form-label"><b> Oral COs</b></label>
                            <div class="SelectBox" style="width:110px; max-height:90px; overflow-y:scroll; padding:4px;">
                                @for($i = 0; $i < 6; $i++)
                                    <div class="checkBoxRow form-check">
                                        <input type="checkbox" name="oral_checkbox" sheet="oral" column="oral_co" co="{{$i+1}}" id="{{$parameters[$i]}}-oral" class="form-check-input">
                                        <label for="{{$parameters[$i]}}-oral" class="form-check-label">{{$parameters[$i]}}</label>
                                    </div>
                                @endfor
                            </div>                        
                        </div>
                        <div class="endsemInputDiv col-md-6 form-group">
                            <label for="endsemCoInput" class="form-label"><b> EndSem COs</b></label>
                            <div class="SelectBox" style="width:110px; max-height:90px; overflow-y:scroll; padding:4px;">
                                @for($i = 0; $i < 6; $i++)
                                    <div class="checkBoxRow form-check">
                                        <input type="checkbox" name="endsem_checkbox" sheet="endsem" column="endsem_co" co="{{$i+1}}" id="{{$parameters[$i]}}-endsem" class="form-check-input">
                                        <label for="{{$parameters[$i]}}-endsem" class="form-check-label">{{$parameters[$i]}}</label>
                                    </div>
                                @endfor
                            </div>                        
                        </div>
                    </div>
                    <div class="row my-4" style="background-color: rgb(243, 235, 251); border-radius:10px;">
                        <center><h4 class="">Select Assignment COs</h4></center>
                        <div class="oralInputDiv col-md-6 form-group">
                            <label for="assign1CoInput" class="form-label">Assignment 1 </label>
                            <div class="SelectBox" style="width:110px; max-height:90px; overflow-y:scroll; padding:4px;">
                                @for($i = 0; $i < 6; $i++)
                                    <div class="checkBoxRow form-check">
                                        <input type="checkbox" name="assign1_checkbox" sheet="assign" column="assign1_co" co="{{$i+1}}" id="{{$parameters[$i]}}-assign1" class="form-check-input">
                                        <label for="{{$parameters[$i]}}-assign1" class="form-check-label">{{$parameters[$i]}}</label>
                                    </div>
                                @endfor
                            </div>                          
                        </div>
                        <div class="endsemInputDiv col-md-6 form-group"> 
                            <label for="assign2CoInput" class="form-label">Assignment 2  </label>
                            <div class="SelectBox" style="width:110px; max-height:90px; overflow-y:scroll; padding:4px;">
                                @for($i = 0; $i < 6; $i++)
                                    <div class="checkBoxRow form-check">
                                        <input type="checkbox" name="assign2_checkbox" sheet="assign" column="assign2_co" co="{{$i+1}}" id="{{$parameters[$i]}}-assign2" class="form-check-input">
                                        <label for="{{$parameters[$i]}}-assign2" class="form-check-label">{{$parameters[$i]}}</label>
                                    </div>
                                @endfor
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="inputSectionRight my-4">
                    <div class="iaCoInputSection" style="background-color: rgb(243, 235, 251); border-radius:10px; margin-top:20px;">
                        <h4><center> IA Questions Per CO</center></h4>
                        <div class="iaCoInputSectionBlock">
                            @for($i = 1; $i <= 6; $i++)
                                <div class="iaCO{{$i}} col-md-2 form-group mx-3"> 
                                    <label for="iaCO{{$i}}Input" class="form-label">CO{{$i}}</label>
                                    <div class="SelectBox" style="width:110px; max-height:90px; overflow-y:scroll; padding:4px;">
                                        @for($j = 0; $j < 8; $j++)
                                            <div class="checkBoxRow form-check">
                                                <input type="checkbox" name="IA_CO{{$i}}_checkbox" sheet="co_ia" column="{{strtolower($IaParameters[$j])}}" co="CO{{$i}}" combined="CO{{$i}}-{{strtolower($IaParameters[$j])}}" id="CO{{$i}}-{{strtolower($IaParameters[$j])}}" class="form-check-input">
                                                <label for="CO{{$i}}-{{strtolower($IaParameters[$j])}}" class="form-check-label">{{$IaParameters[$j]}}</label>
                                            </div>
                                        @endfor
                                    </div>                                  
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="exptInputSection my-4" style="background-color: rgb(243, 235, 251); border-radius:10px;">
                        <h4><center> Experiments Per CO</center></h4>
                        <div class="exptCoInputSectionBlock my-2">
                            @for($i = 1; $i <= 6; $i++)
                                <div class="exptCO{{$i}} col-md-2 form-group mx-3"> 
                                    <label for="exptCO{{$i}}Input" class="form-label">CO{{$i}}</label>
                                    <div class="SelectBox" style="width:110px; max-height:90px; overflow-y:scroll; padding:4px;">
                                        @for($j = 0; $j < 12; $j++)
                                            <div class="checkBoxRow form-check">
                                                <input type="checkbox" name="Expt_CO{{$i}}_checkbox" sheet="co_expt" column="e{{$j+1}}" co="CO{{$i}}" id="CO{{$i}}-e{{$j+1}}" class="form-check-input">
                                                <label for="CO{{$i}}-e{{$j+1}}" class="form-check-label">{{$ExpParameters[$j]}}</label>
                                            </div>
                                        @endfor
                                    </div>                                  
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $.ajax({
                url: "{{route('sendPreviousChecksRecords')}}",
                type:"GET",
                success: (res)=>{
                    var FinalParsed = JSON.parse(res);  // result is combination of 3 arrs
                    var selected_checks_ia = FinalParsed["selected_checks_ia"];
                    var selected_checks_expt = FinalParsed["selected_checks_expt"];
                    var selected_checks_others = FinalParsed["selected_checks_others"];

                    for (let i = 1; i <= 6; i++) {
                        var co_ia = JSON.parse(selected_checks_ia[`CO${i}`]);
                        Array.from(co_ia).forEach(element => {
                            document.getElementById(`CO${i}-${element}`).checked = true;
                        });
                        var co_expt = JSON.parse(selected_checks_expt[`CO${i}`]);
                        Array.from(co_expt).forEach(element => {
                            document.getElementById(`CO${i}-${element}`).checked = true;
                        });
                    }

                    // ckeck oral, endsem, assign1, assign2 checkboxes
                    var co_others = ['oral', 'endsem', 'assign1', 'assign2'];
                    co_others.forEach((co_elem)=>{
                        var temp = JSON.parse(selected_checks_others[`${co_elem}_co`]);
                        Array.from(temp).forEach((elem)=>{
                            document.getElementById(`CO${elem}-${co_elem}`).checked = true;
                        })
                    })

                }
            })
        })


        var group = document.getElementsByClassName("form-check-input");
        Array.from(group).forEach(element => {
            (element).addEventListener("change", ()=>{
                var status = element.checked;
                var sheet = element.getAttribute("sheet");
                var column = element.getAttribute("column");
                var coInput= element.getAttribute("co");

                if (sheet == "oral" || sheet == "endsem" || sheet == "assign") {
                    $.ajax({
                        url: "{{route('updateCoInputCheck1')}}",
                        type: "POST",
                        data:{
                            '_token':"{{csrf_token()}}",
                            'column' : column,
                            'coInput':coInput,
                            'status':status
                        },
                        success: (res)=>{
                            if(res == true){
                                if (status) //change color accordingly
                                { element.style.backgroundColor = "violet"}
                                else{ element.style.backgroundColor= "white"};
                                element.checked = status;
                            }
                            else{
                                element.style.backgroundColor = "red";
                                element.checked = false;
                            }
                        }
                    })                                                                                                                                                                                   
                }
                else if (sheet == 'co_ia' || sheet == 'co_expt'){
                    $.ajax({
                        url : "{{route('updateCoInputCheck2')}}",
                        type:"POST",
                        data:{
                            '_token':"{{csrf_token()}}",
                            'sheet' : sheet,
                            'column' : column,
                            'coInput':coInput,
                            'status':status
                        },
                        success: (res)=>{
                            if(res != 0){
                                if (status) 
                                { element.style.backgroundColor = "violet"}
                                else{ element.style.backgroundColor= "white"};
                                element.checked = status;
                            }
                            else{
                                element.style.backgroundColor = "red";
                                element.checked = false;
                            }
                        }
                    })
              
                }
            });
        });
    </script>
@endsection