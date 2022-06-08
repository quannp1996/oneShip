@foreach ($def['site_media'] as $css)
    {!! \FunctionLib::addMedia($css, $versionMedia) !!}
@endforeach

<!-- Main styles for this application -->
@foreach ($def['site_css'] as $css)
    {!! \FunctionLib::addMedia($css, $versionMedia) !!}
@endforeach

@yield('css')

@stack('css_bot_all')

@foreach ($def['site_css_override'] as $css)
    {!! \FunctionLib::addMedia($css, $versionMedia) !!}
@endforeach

{!! \FunctionLib::addMedia(route('web_localization_i18n_js'), $versionMedia) !!}

@yield('js_top')
