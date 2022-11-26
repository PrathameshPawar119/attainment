@section('alert-section')
   <div class="{{$mainclass}}">
        <div class="alert alert-{{$color}}" role="alert" style="height: 36x; line-height:36px; padding:4px 20px;">
        <h5>{{$message}}</h5>
        </div>
    </div>
@endsection