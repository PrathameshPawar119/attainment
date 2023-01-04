<div>
    <style>
        table{
            border: 9px transparent;
            background:linear-gradient(to right, rgb(248, 234, 248), rgb(226, 233, 247));
            text-align: center;
            border-radius: 8px;
        }
        table tbody tr{
            border-bottom: 1px;
            border-bottom-color: white;
            border-radius: 8px;
        }
        table tbody tr td{
            background:linear-gradient(to right, rgb(244, 217, 244), rgb(207, 218, 241));
            border-radius: 8px;
        }
    </style>
    @php
        $values = explode("-", $values);
    @endphp
    <table class="table table-hover my-4 mx-4">
        <tbody>
            <tr>
                <th>{{$values[0]}}% of Total {{$values[1]}}</th>
                <td>{{$values[2]}}</td>
            </tr>
            <tr>
                <th>Number of Students Scored more than {{$values[2]}}/{{$values[1]}}</th>
                <td>{{$values[3]}}</td>
            </tr>
            <tr>
                <th>% of students scored more than {{$values[2]}}/{{$values[1]}}</th>
                <td>{{$values[4]}}%</td>
            </tr>
            <tr>
                <th>COs</th>
                <td>{{$values[5]=="[1,2,3,4,5,6]" ? "All" : $values[5]}}</td>
            </tr>
            <tr>
                <th>Attainment Level</th>
                <td>{{$values[6]}}</td>
            </tr>
        </tbody>
    </table>
</div>