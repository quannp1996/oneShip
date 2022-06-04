<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<meta name="csrf-token" id="csrf-token-meta" content="{{ csrf_token() }}">
<link rel="shortcut icon" async href="{{ \ImageURL::getImageUrl(@$settings['website']['favicon'], 'setting', 'original') }}">

@if (\View::hasSection('title'))
    @yield('title')
@else
    {!! \FunctionLib::siteTitle(@$site_title, @$def['site_title']) !!}
@endif

@if (View::hasSection('facebook_meta'))
    @yield('facebook_meta')
@else
    {!! $seoDefault['facebook_meta'] !!}
    {!! $seoDefault['twitter_meta'] !!}
    {!! $seoDefault['g_meta'] !!}
@endif
