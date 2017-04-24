@if(Session::has(MESSAGE))
    <div class="widget">
        <div class="alert {{Session::get(STATUS)}}">
            {{ Session::get(MESSAGE) }}
        </div>
    </div>
@endif
