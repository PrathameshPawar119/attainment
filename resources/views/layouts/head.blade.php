
@php
    $currentUrl = url()->current();
@endphp
<ul class="nav nav-tabs">
    <li class="nav_logo px-2"><h2><i><u>Attainment</u>.com</i></h2></li>
        <li class="nav-item">
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
        <a class="nav-link {{url('/sheets/cis')==$currentUrl?'active':''}}" href="{{url('/sheets/cis')}}"><b>CIS</b></a>
    </li>

    <div class="leftTabs" style="position:absolute; right:20px;">
        <li class="nav-item">
            <a class="nav-link {{url('/user/criteriaInput')==$currentUrl?'active':''}}" href="{{url('/user/criteriaInput')}}"><b>Criteria</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{url('/user/Profile')==$currentUrl?'active':''}}" href="{{url('/user/profile')}}" style="z-index: 1000;">Logo</a>
        </li>
    </div>
</ul>