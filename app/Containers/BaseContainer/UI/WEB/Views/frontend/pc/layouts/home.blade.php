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
        <link rel="preload" href="https://fonts.googleapis.com/css?family=Open Sans:bold,regular|Montserrat:bold,regular&display=swap" as="style">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans:bold,regular|Montserrat:bold,regular&amp;display=swap" as="style" onload="this.onload = null; this.rel = 'stylesheet';">
        <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
        @yield('seo')
    </head>
    <body class="home">
        {!! $settings['other']['script_body'] !!}
        @yield('content')
        <x-footer-component :menus="$menus"></x-footer-component>
    </body>
    @stack('js_bot_all')
</html>
