@php
$def = \FunctionLib::tplShareGlobal('admin');
$def['site_title'] = "Quản trị";
@endphp

<!doctype html>
<html lang="{{ @$defLang }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{@$def['site_description']}}">
    <meta name="keyword" content="{{@$def['site_keyword']}}">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <link rel="shortcut icon" href="{{asset(@$def['favicon'])}}">

@if(\View::hasSection('title'))
    @yield('title')
@else
    {!! \FunctionLib::siteTitle(@$site_title, @$def['site_title']) !!}
@endif

<!-- Icons -->
@foreach(@$def['site_media'] as $css)
    {!! \FunctionLib::addMedia($css) !!}
@endforeach

<!-- Main styles for this application -->
@foreach(@$def['site_css'] as $css)
    {!! \FunctionLib::addMedia($css) !!}
@endforeach

<!-- Styles required by this views -->
@yield('css')

@stack('css_after_all')
<!-- top script -->
@yield('js_top')
</head>
<body class="c-app flex-row align-items-center">
    @yield('content')

<script type="text/javascript">
    var ENV = {
        version: '{{ env('APP_VER', 0) }}',
        token: '{{ csrf_token() }}',
@foreach($def['site_js_val'] as $key => $val)
        {{$key}}: '{{$val}}',
@endforeach
    },
    COOKIE_ID = '{{ env('APP_NAME', '') }}',
    DOMAIN_COOKIE_REG_VALUE = 1,
    DOMAIN_COOKIE_STRING = '{{ config('session.domain') }}';
</script>

<!-- Bootstrap and necessary plugins -->
@foreach(@$def['site_js'] as $js)
{!! \FunctionLib::addMedia($js) !!}
@endforeach

<!-- other script -->
@yield('js_bot')
@stack('js_bot_all')

<script type="text/javascript">

</script>

</body>
</html>
