
@php
    $currentUrl = url()->current();
@endphp
<style scoped>
    .hideMe{
        display: none;
    }
</style>
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
        <li class="nav-item {{session()->has('user_id') ? '': 'hideMe'}}" >
            <a class=" nav-link" id="ProfileToggle" style="z-index: 1000;" data-bs-toggle="dropdown" aria-expanded="false"><img style="height: 80%; width:80%;" src="{{asset('images/user.png')}}" alt="Profile"></a>
            <ul class="dropdown-menu dropdown-menu" id="ProfileContainer">
                <li><a class="dropdown-item" href="{{url('/user/profile')}}">Profile</a></li>
                {{-- <li><a class="dropdown-item" href="#">Another action</a></li> --}}
                    <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{url('/auth/logout')}}">Log Out <img src="{{asset('images/logout.png')}}" style="height: 16%; width:16%;" alt="Log Out"> </a></li>
            </ul>
        </li>
    </div>
</ul>