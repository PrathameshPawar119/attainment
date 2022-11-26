  <div class="{{$mainclass}}">
    <label for="{{$id}}" class="form-label">{{$label}}</label>
    <input type="{{$type}}" class="form-control" name="{{$name}}" id="{{$id}}" aria-describedby="emailHelp" value="{{$value}}">
    <span class="text-danger">
        @error($name)
            {{$message}}
        @enderror
    </span>
  </div>