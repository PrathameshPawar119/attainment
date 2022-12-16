
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
        <a class="nav-link {{url('/sheets/assignments')==$currentUrl?'active':''}}" href="{{url('/sheets/assignments')}}">Assignments</a>
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
</ul>