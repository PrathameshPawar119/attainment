@section('alert-section')
   <div class="{{$mainclass}}" style="height: 60px;">
        <div class="alert alert-{{$color}}" role="alert" style="height: 36x; line-height:36px; padding:6px 20px;">
        <h5>{{$message}}</h5>
        </div>
    </div>
@endsection