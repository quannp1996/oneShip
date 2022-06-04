<script type="text/javascript">
    var ENV = {
            version: '{{ env('APP_VER', 0) }}',
            token: '{{ csrf_token() }}',
            @foreach ($def['site_js_val'] as $key => $val)
                {{ $key }}: '{{ $val }}',
            @endforeach
        },
        COOKIE_ID = '{{ env('APP_NAME', '') }}',
        DOMAIN_COOKIE_REG_VALUE = 1,
        DOMAIN_COOKIE_STRING = '{{ config('session.domain') }}';
        API_URL = '{{ env('API_URL', '') }}/v1/{{$currentLang}}';
    var BASE_URL = '{{ url('/') }}';
</script>

@foreach ($def['site_js'] as $js)
    {!! \FunctionLib::addMedia($js, $versionMedia) !!}
@endforeach

@yield('js_bot')

@foreach ($def['site_js_override'] as $js)
    {!! \FunctionLib::addMedia($js, $versionMedia) !!}
@endforeach

@stack('js_bot_all')
