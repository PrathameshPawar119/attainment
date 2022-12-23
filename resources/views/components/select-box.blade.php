
<div class="SelectBox" style="width:110px; max-height:90px; overflow-y:scroll; padding:4px;">
    @php
        $parameters = json_decode($parameters);
        $ids = json_decode($ids);
    @endphp
    @for($i = 0; $i < 6; $i++)
        <div class="checkBoxRow form-check">
            <input type="checkbox" name="{{$parameters[$i]}}" id="{{$ids[$i]}}" class="form-check-input">
            <label for="{{$ids[$i]}}" class="form-check-label">{{$parameters[$i]}}</label>
        </div>
    @endfor

</div>