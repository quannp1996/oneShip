@php($def = isset($def) ? $def : FunctionLib::tplShareGlobal('web', $settings ?? []))
@php($seoDefault = FunctionLib::getSeo('web', $def))
@php($versionMedia = $settings['other']['version'] ?? 0)
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['website']['site_name'] }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin>
    <link rel="preload"
        href="https://fonts.googleapis.com/css?family=Open Sans:bold,regular|Montserrat:bold,regular&display=swap"
        as="style">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Open Sans:bold,regular|Montserrat:bold,regular&amp;display=swap"
        as="style" onload="this.onload = null; this.rel = 'stylesheet';">
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
    @yield('seo')
</head>

<body>
    {!! $settings['other']['script_body'] !!}
    <div class="admin-page">
        @include('frontend::dashboard.components.sidebar')
        <div class="admin-page-layout">
            <!-- admin -header -->
            @include('frontend::dashboard.components.headbar')
            <!-- end admin header-->
            @yield('content')
        </div>
    </div>
</body>
<script>
    var BASE_URL = '{{ url('/') }}';
</script>
<script type="text/javascript">
    var ENV = {
        version: '{{ env('APP_VER', 0) }}',
        token: '{{ csrf_token() }}',
    };
    var COOKIE_ID = '{{ env('APP_NAME', '') }}';
    var DOMAIN_COOKIE_REG_VALUE = 1;
    var DOMAIN_COOKIE_STRING = '{{ config('session.domain') }}';
    var API_URL = '{{ env('API_URL', '') }}/v1/{{ $currentLang }}';
    var BASE_URL = '{{ url('/') }}';
</script>
<script src="{{ asset('template/js/jquery-3.4.1.js') }}"></script>
<script src="{{ asset('template/libs/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('template/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/vue_dev.js') }}"></script>
<script src="{{ asset('template/js/httpvueloader.js') }}"></script>
<script src="{{ asset('template/js/setup.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
@stack('js_bot_all')

</html>
