@if (count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{!! $error !!}</div>
        @endforeach
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success">
        {!! session('status') !!}
    </div>
@endif