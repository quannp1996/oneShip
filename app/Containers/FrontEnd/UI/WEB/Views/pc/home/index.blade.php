@extends('basecontainer::frontend.pc.layouts.home')
@section('seo')
    <meta name="description"
        content="{{ $staticPage->desc->meta_description ?? $staticPage->desc->short_description }}" />
    <meta name="keywords" content="{{ $staticPage->desc->meta_keyword ?? $staticPage->desc->name }}" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:title" content="{{ $staticPage->desc->meta_title ?? $staticPage->desc->name }}" />
    <meta property="og:description"
        content="{{ $staticPage->desc->meta_description ?? $staticPage->desc->short_description }}" />
    <meta property="og:url" content="{{ request()->url() }}" />
    <meta property="og:site_name" content="{{ $staticPage->desc->meta_title ?? $staticPage->desc->name }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image"
        content="{{ ImageURL::getImageUrl(!empty($staticPage->image_seo) ? $staticPage->image_seo : $staticPage->image, 'staticpage', 'social') . '?v=' . time() }}" />
    <meta property="og:image:alt" content="{{ $staticPage->desc->meta_title ?? $staticPage->desc->name }}" />
    <meta property="og:image:width" content="800" />
    <meta property="og:image:height" content="800" />
    <meta property="og:updated_time" content="{{ time() }}" />
    <!-- Twitter SEO -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description"
        content="{{ $staticPage->desc->meta_description ?? $staticPage->desc->short_description }}" />
    <meta name="twitter:title" content="{{ $staticPage->desc->meta_title ?? $staticPage->desc->name }}" />
    <meta name="twitter:image"
        content="{{ ImageURL::getImageUrl(!empty($staticPage->image_seo) ? $staticPage->image_seo : $staticPage->image, 'staticpage', 'social') . '?v=' . time() }}" />
    <meta name="twitter:site" content="{{ request()->url() }}" />
    <!-- Google SEO -->
    <meta itemprop="name" content="{{ $staticPage->desc->meta_title ?? $staticPage->desc->name }}" />
    <meta itemprop="description"
        content="{{ $staticPage->desc->meta_description ?? $staticPage->desc->short_description }}" />
    <meta itemprop="image"
        content="{{ ImageURL::getImageUrl(!empty($staticPage->image_seo) ? $staticPage->image_seo : $staticPage->image, 'staticpage', 'social') . '?v=' . time() }}">
@endsection
@section('content')
    <header>
        <div class="header-wrap">
            <div class="container">
                <div class="header-wrapper">
                    <div class="header-link">
                        <a href="javascript:;">
                            <h3>
                                ƯU ĐÃI CHÀO SHOP MỚI
                            </h3>
                        </a>
                    </div>
                    <div class="header-title">
                        <h3 class="title">Dùng thử KHÔNG GIỚI HẠN&nbsp;+ phí giao hàng chỉ từ 12k</h3>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="banner-home"
            style="background: url({{ $banner ? $banner->getImageUrl() : '' }})">
            <div class="container">
                <div class="banner-home-wrap">
                    <div class="left">
                        <div class="logo">
                            <img src="{{ ImageURL::getImageUrl($settings['website']['logo'], 'setting', '') }}" alt="">
                        </div>
                        <div class="title">
                            <h3>Giải pháp<br>
                                <span class="color">Quản lý Logistíc</span>
                                <br>tối ưu
                            </h3>
                        </div>
                        <div class="small-desc">
                            @if ($banner)
                                @foreach ($banner->buildListItem() as $item)
                                    @if (!empty($item) && !empty(strip_tags($item)))
                                        <p>
                                            <span class="svg-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                                    preserveAspectRatio="none" viewBox="0 0 1536 1896.0833"
                                                    class="" fill="rgba(255, 116, 4, 1)">
                                                    <path
                                                        d="M768 1440V352q-148 0-273 73T297 623t-73 273 73 273 198 198 273 73zm768-544q0 209-103 385.5T1153.5 1561 768 1664t-385.5-103T103 1281.5 0 896t103-385.5T382.5 231 768 128t385.5 103T1433 510.5 1536 896z">
                                                    </path>
                                                </svg>
                                            </span>
                                            {!! $item !!}
                                        </p>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="right">
                        <form action="" id="send_contact" class="form-info" id="form-sections">
                            <h3 class="title">Shop ơi, hãy điền đầy đủ và chính xác để OneClub có thể gửi thông tin
                                tài khoản đến cho Shop nhé!</h3>
                            <div class="form-group" id="shop_name">
                                <input autocomplete="off" tabindex="1" name="shop_name" class="form-control" type="text"
                                    placeholder="1. Tên Shop (*)" value="">
                                <small class="error-message"></small>
                            </div>
                            <div class="form-group" id="email">
                                <input autocomplete="off" tabindex="1" name="email" class="form-control" type="text"
                                    placeholder="2. Email (*)" value="">
                                <small class="error-message"></small>
                            </div>
                            <div class="form-group" id="phone">
                                <input autocomplete="off" tabindex="1" name="phone" class="form-control" type="text"
                                    placeholder="3. Số điện thoại (*)" value="">
                                <small class="error-message"></small>
                            </div>
                            @foreach ($fields as $field)
                                <div class="form-group" id="field_{{ $field->id }}">
                                    <input autocomplete="off" tabindex="1" name="field[{{ $field->id }}]"
                                        class="form-control" type="text" placeholder="{{ $field->placeholder }}"
                                        value="">
                                    <small class="error-message"></small>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <div class="form-radio">
                                    <input type="radio" name="confirm" id="confirm"
                                        value="Tôi xác nhận thông tin trên là chính xác">
                                    <label for="radio">
                                        Tôi xác nhận thông tin trên là chính xác
                                    </label>
                                </div>
                                <small id="radio-message" class="error-message"></small>
                            </div>
                            <button type="submit" class="btn-submit" id="submit_contact_form">
                                Đăng ký
                            </button>
                        </form>
                    </div>
                </div>
                <!-- circle icon-->
                <div class="pos1">
                    <div class="circle-absolute">
                        <div class="circle-element circle-1">
                            <div class="circle-shape">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                    preserveAspectRatio="none" viewBox="0 0 29.77 29.77" class=""
                                    fill="rgba(0, 227, 221, 1)">
                                    <circle cx="14.89" cy="14.89" r="14.89"></circle>
                                </svg>
                            </div>
                        </div>
                        <div class="circle-element circle-2">
                            <div class="circle-shape">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                    preserveAspectRatio="none" viewBox="0 0 29.77 29.77" class=""
                                    fill="rgba(255, 255, 255, 1)">
                                    <circle cx="14.89" cy="14.89" r="14.89"></circle>
                                </svg>
                            </div>
                        </div>
                        <div class="circle-element circle-3">
                            <div class="circle-shape">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                    preserveAspectRatio="none" viewBox="0 0 29.77 29.77" class=""
                                    fill="rgba(255, 116, 4, 1)">
                                    <circle cx="14.89" cy="14.89" r="14.89"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pos2">
                    <div class="circle-absolute">
                        <div class="circle-element circle-1">
                            <div class="circle-shape">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                    preserveAspectRatio="none" viewBox="0 0 29.77 29.77" class=""
                                    fill="rgba(0, 227, 221, 1)">
                                    <circle cx="14.89" cy="14.89" r="14.89"></circle>
                                </svg>
                            </div>
                        </div>
                        <div class="circle-element circle-3">
                            <div class="circle-shape">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                    preserveAspectRatio="none" viewBox="0 0 29.77 29.77" class=""
                                    fill="rgba(255, 116, 4, 1)">
                                    <circle cx="14.89" cy="14.89" r="14.89"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pos3">
                    <div class="circle-absolute">
                        <div class="circle-element circle-1">
                            <div class="circle-shape">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                    preserveAspectRatio="none" viewBox="0 0 29.77 29.77" class=""
                                    fill="rgba(0, 227, 221, 1)">
                                    <circle cx="14.89" cy="14.89" r="14.89"></circle>
                                </svg>
                            </div>
                        </div>
                        <div class="circle-element circle-2">
                            <div class="circle-shape">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                    preserveAspectRatio="none" viewBox="0 0 29.77 29.77" class=""
                                    fill="rgba(255, 255, 255, 1)">
                                    <circle cx="14.89" cy="14.89" r="14.89"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end circle icon -->
            </div>
        </section>
        @if ($staticPage)
            @if ($staticPage->view_type)
                {!! $staticPage->staticpage_content !!}
            @else
                @include('frontend::pc.home.type.static_1')
            @endif
        @endif
    </main>
@endsection
@push('js_bot_all')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
    <script>
        const api_contact_create_contact = '{{ route('api_contact_create_contact') }}';

        $('[data-actions="true"]').click(function(event) {
            $('html,body').animate({
                scrollTop: 10
            }, 'slow');
        });

        $('[data-play-video="true"]').click(function(event) {
            if (!$(this).hasClass('played')) {
                let e = $(this).attr("data-url"),
                    n = $(this).attr("data-width"),
                    i = $(this).attr("data-height");
                $(this).html(
                        '<iframe allowfullscreen frameborder="0" allow="autoplay; encrypted-media" class="lazy" src="' +
                        e + '" width="' + n + '" height="' + i + '"></iframe>'),
                    $(this).addClass("played")
            }
        });
        
        $('#send_contact').submit(function() {
            if (!$("input:radio[name='confirm']").is(":checked")) {
                $('#radio-message').text('Bạn phải xác nhận thông tin là chính xác');
                return false;
            }
            $('#submit_contact_form').attr('disable', 'disable');
            $('.error-message').text('');
            $('#submit_contact_form').html('<span class="dot-elastic"></span>');
            $.post(api_contact_create_contact, $(this).serializeArray()).then(json => {
                window.location.href = '{{ route('web.thankyou.index') }}';
            }).fail(json => {
                const errors = json.responseJSON.errors;
                Object.keys(errors).forEach(item => {
                    const id = item.replace('.', '_');
                    $('#' + id + ' small').text(errors[item][0]);
                })
            }).always(json => {
                $('#submit_contact_form').removeAttr('disable');
                $('#submit_contact_form').html('Đăng ký');
            })
            return false;
        })
    </script>
@endpush
