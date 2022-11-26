
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
        <a class="nav-link {{url('/students/oralPract')==$currentUrl?'active':''}}" href="{{url('/students/oralPract')}}">Oral-Practical</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{url('/students/endsem')==$currentUrl?'active':''}}" href="{{url('/students/endsem')}}">End-Sem</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{url('/students/assignments')==$currentUrl?'active':''}}" href="{{url('/students/assignments')}}">Assignments</a>
    </li>
     <li class="nav-item">
        <a class="nav-link {{url('/students/ia')==$currentUrl?'active':''}}" href="{{url('/students/ia')}}">IA</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{url('/students/experiments')==$currentUrl?'active':''}}" href="{{url('/students/experiments')}}">Experiments</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{url('/students/cis')==$currentUrl?'active':''}}" href="{{url('/students/cis')}}"><b>CIS</b></a>
    </li>
</ul>