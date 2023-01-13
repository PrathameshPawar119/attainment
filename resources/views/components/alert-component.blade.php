@section('alert-section')
   <div class="{{$mainclass}}">
        <div class="alert alert-{{$color}}" role="alert" style="height: 30x; line-height:30px; padding:4px 20px;">
        <h6>{{$message}}</h6>
        </div>
    </div>
@endsection