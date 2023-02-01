
@php
    $currentUrl = url()->current();
@endphp
<style>
    .hideMe{
        display: none;
    }
    .profileImg{
        height: 80% !important;
        width: 80% !important;
    }
    .dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0; /* remove the gap so it doesn't close */
        z-index: 100000;
    }
    .mylogo{
        width: 56%;
        height: 96%;
        display: inline-block;
    }
</style>
<ul class="nav nav-tabs"style="display:flex; flex-direction:row;">
    <li class="nav-item ml-4" style="width: 30%;">
        <img class="mylogo" src="{{asset('images/mylogo.png')}}" alt="Attainment">
    </li>
    <li>
        <a class="nav-link {{url('/students/view')==$currentUrl?'active':''}} " aria-current="page" href="{{url('/students/view')}}">Students</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{url('/students/input')==$currentUrl?'active':''}} " aria-current="page" href="{{url('/students/input')}}">Input</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{url('/sheets/oral')==$currentUrl?'active':''}}" href="{{url('/sheets/oral')}}">Oral-Practical</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{url('/sheets/endsem')==$currentUrl?'active':''}}" href="{{url('/sheets/endsem')}}">End-Sem</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{url('/sheets/assignment')==$currentUrl?'active':''}}" href="{{url('/sheets/assignment')}}">Assignments</a>
    </li>
     <li class="nav-item">
        <a class="nav-link {{url('/sheets/ia')==$currentUrl?'active':''}}" href="{{url('/sheets/ia')}}">IA</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{url('/sheets/experiments')==$currentUrl?'active':''}}" href="{{url('/sheets/experiments')}}">Experiments</a>
    </li>   
    <li class="nav-item">
        <a class="nav-link {{url('/attainment/cis')==$currentUrl?'active':''}}" href="{{url('/attainment/cis')}}"><b>CIS</b></a>
    </li>

    <li class="nav-item dropdown {{session()->has('user_id') ? '': 'hideMe'}}">
        <a class="nav-link {{url('/user/criteriaInput')==$currentUrl?'active':''}}" href="{{url('/user/criteriaInput')}}"><b>Criteria</b></a>
        <ul class="dropdown-menu mx-0">
            <li><a class="dropdown-item" href="{{url('/user/criteriaInput')}}">Total Marks</a></li>
            <li><a class="dropdown-item" href="{{url('/user/coinput')}}">Select COs</a></li>
            <li><a class="dropdown-item" href="{{url('/user/thresholdMarksInput')}}">Threshold</a></li>
        </ul>
    </li>
    <div class="leftTabs" style="position:absolute; right:20px; top:32px;">
        <li class="nav-item dropdown {{session()->has('user_id') ? '': 'hideMe'}}" style="z-index: 2;">
            <a class=" nav-link" id="ProfileToggle" style="z-index: 1000;" data-bs-toggle="dropdown" aria-expanded="false"><img style="height: 80%; width:80%;" class="profileImg" src="{{asset('images/user.png')}}" alt="Profile"></a>
            <ul class="dropdown-menu" id="ProfileContainer">
                <li><a class="dropdown-item" href="{{url('/user/profile')}}">Profile ⭕</a></li>
                {{-- <li><a class="dropdown-item" href="#">Another action</a></li> --}}
                <li><a class="dropdown-item" href="{{url('/auth/logout')}}">Log Out <img src="{{asset('images/logout.png')}}" style="height: 16%; width:16%;" alt="Log Out"> </a></li>
            </ul>
        </li>
    </div>
</ul>