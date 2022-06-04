@extends('basecontainer::frontend.pc.layouts.home')
@section('seo')
    <meta name="description" content="{{ $staticPage->desc->meta_description ?? $staticPage->desc->short_description }}" />
    <meta name="keywords" content="{{ $staticPage->desc->meta_keyword ?? $staticPage->desc->name }}" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:title" content="{{ $staticPage->desc->meta_title ?? $staticPage->desc->name }}" />
    <meta property="og:description" content="{{ $staticPage->desc->meta_description ?? $staticPage->desc->short_description }}" />
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
    <meta name="twitter:description" content="{{ $staticPage->desc->meta_description ?? $staticPage->desc->short_description }}" />
    <meta name="twitter:title" content="{{ $staticPage->desc->meta_title ?? $staticPage->desc->name }}" />
    <meta name="twitter:image"
        content="{{ ImageURL::getImageUrl(!empty($staticPage->image_seo) ? $staticPage->image_seo : $staticPage->image, 'staticpage', 'social') . '?v=' . time() }}" />
    <meta name="twitter:site" content="{{ request()->url() }}" />
    <!-- Google SEO -->
    <meta itemprop="name" content="{{ $staticPage->desc->meta_title ?? $staticPage->desc->name }}" />
    <meta itemprop="description" content="{{ $staticPage->desc->meta_description ?? $staticPage->desc->short_description }}" />
    <meta itemprop="image"
        content="{{ ImageURL::getImageUrl(!empty($staticPage->image_seo) ? $staticPage->image_seo : $staticPage->image, 'staticpage', 'social') . '?v=' . time() }}">
@endsection
@section('content')
    <main>
        <section class="banner-home" style="background: url({{ $banner ? $banner->getImageUrl() : '' }})">
            <div class="container">
                <div class="banner-home-wrap">
                    <div class="left">
                        <div class="logo">
                            <img src="{{ ImageURL::getImageUrl($settings['website']['logo'], 'setting', '') }}" alt="">
                        </div>
                        <div class="title">
                            <h3>
                                <span class="color">Đăng Ký</span>
                                <br>Thành Công
                            </h3>
                        </div>
                        <div class="small-desc">
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
                        </div>
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
            $.post(api_contact_create_contact, $(this).serializeArray()).then(json => {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: json.message
                }).then(r => {
                    $(this).reset();
                })
            }).fail(json => {
                const errors = json.responseJSON.errors;
                Object.keys(errors).forEach(item => {
                    const id = item.replace('.', '_');
                    $('#' + id + ' small').text(errors[item][0]);
                })
            }).always(json => {
                $('#submit_contact_form').removeAttr('disable');
            })
            return false;
        })
    </script>
@endpush
