@php
$def = \FunctionLib::tplShareGlobal('admin');
$def['site_title'] = 'Quản trị';
@endphp

<!doctype html>
<html lang="{{ $currentLang }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ @$def['site_description'] }}">
    <meta name="keyword" content="{{ @$def['site_keyword'] }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset(@$def['favicon']) }}">

    @if (\View::hasSection('title'))
        @yield('title')
    @else
        {!! \FunctionLib::siteTitle(@$site_title, @$def['site_title']) !!}
    @endif

    @if (isset($def['website']['go_production']) && $def['website']['go_production'])
        <link rel="stylesheet" href="{{ asset('admin/css/all.css') }}?v={{ time() }}">
    @else
        @foreach ($def['site_media'] as $css)
            {!! \FunctionLib::addMedia($css) !!}
        @endforeach

        <!-- Main styles for this application -->
        @foreach ($def['site_css'] as $css)
            {!! \FunctionLib::addMedia($css) !!}
        @endforeach
    @endif

    @yield('css')

    @stack('css_bot_all')
    <!-- top script -->
    @yield('js_top')
</head>

<body class="c-app">
    @include('basecontainer::admin.layouts.components.loader')
    @include('basecontainer::admin.layouts.components.sidebar')
    <div class="c-wrapper c-fixed-components">
        @include('basecontainer::admin.layouts.components.header')
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
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
        API_URL = '{{ env('API_URL', '') }}/v1';
    </script>

    <script>
        ENV.accessToken = localStorage.getItem('accesstoken');
        ENV.headerParams = {
            'Authorization': 'Bearer ' + ENV.accessToken
        };
    </script>
    <!-- Bootstrap and necessary plugins -->
    @foreach ($def['site_js'] as $js)
        {!! \FunctionLib::addMedia($js) !!}
    @endforeach
    {{-- @endif --}}
    <!-- other script -->
    @if (session()->has('flash_message'))
        <script>
            Swal.fire({
                title: $.i18n("{{ session('flash_level') }}"),
                text: $.i18n("{{ session('flash_message') }}"),
                showCloseButton: true,
                icon: "{{ session('flash_level') }}"
            });
        </script>
    @endif

    @if (count($errors) > 0)
        @php($errorText = '')
        @foreach ($errors->all() as $error)
            @php($errorText .= '<code class="d-block">' . $error . '</code>')
        @endforeach

        <script>
            Swal.fire({
                title: $.i18n('error'),
                html: `{!! $errorText !!}`,
                showCloseButton: true,
                icon: "error"
            });
        </script>
    @endif

    @yield('js_bot')
    @stack('js_bot_all')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropify').dropify({
                messages: {
                    'default': 'Kéo và thả tệp vào đây hoặc nhấp chuột tại đây.',
                    'replace': 'Kéo và thả hoặc nhấp chuột để thay thế',
                    'remove': 'Xóa',
                    'error': 'Xin lỗi, có gì đó không đúng tại đây.'
                },
                error: {
                    'fileSize': 'The file size is too big (1M max).'
                }
            });
        })
    </script>
</body>

</html>
