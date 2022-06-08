@extends('basecontainer::Desktop.layouts.default')
@section('content')
<main>
    <div class="breadcrumb" style="background-image: url({{ asset('template/images/bg-breadcrumb.jpg') }});">
        <div class="container">

        </div>
    </div>
    <div class="owner-profile logged-in">
        <div class="owner-profile">
            <div class="owner-info">
                <div class="container">
                    <div class="owner-info-top">
                        <div class="owner-big-avatar">
                            <div class="owner-avatar-img">
                                <img src="{{ $user->getAvatarImage() }}" id="customer_avatar" alt="" class="lazy img-fluid" data-src="" >
                                <a href="javascript:;" class="hover-change-ava">
                                    <input type="file" id="avatar__image" style="position: absolute; top: -1000px"/>
                                    <img src="{{ asset('template/images/ic-camera.png') }}" alt="" id="change_avatar" class="lazy img-fluid">
                                    <span class="d-block">
                                        Thay đổi ảnh 
                                    </span>
                                </a>
                            </div>
                            <p class="followed text-center mt-2">
                                <strong class="number_of_follow"> {{ count($peopleFollowingMe) }} </strong>
                                người theo dõi
                            </p>
                        </div>  
                        <div class="owner-short-info">
                            <p class="name">
                               {{ $user->fullname }}
                            </p>
                            <div class="owner-short-infos">
                                <div class="item">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <div class="item-content">
                                        Địa chỉ :
                                        <span class="item-value">
                                            {{ $user->mainAddress->address }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="partner-actions">
                            <a href="{{ route('construction.create') }}" class="btn-custom btn-upload-profile btn-custom-has-img">
                                <img src="{{ asset('template/images/ic-upload.png') }}" alt="Đăng công trình">
                                Đăng công trình
                            </a>
                        </div>
                        <div class="partner-tabs">
                            <a href="javascript:;" class="partner-tab-item js-changetab-parnter active text-uppercase" data-id="#box-congtrinh">
                                Công trình 
                                <span class="count">({{$constructions->total()}})</span>
                            </a>
                            <a href="javascript:;" class="partner-tab-item  js-changetab-parnter  text-uppercase" data-id="#box-doitac">
                               Đang theo dõi
                            </a>
                            <a href="javascript:;" class="partner-tab-item  js-changetab-parnter  text-uppercase" data-id="#box-owner-info">
                               Thông tin tài khoản
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="partner-main-content">
                <div class="container">
                    @include('customer::Desktop.profile_tabs.profile_buildings')

                    @include('customer::Desktop.profile_tabs.profile_follow')

                    @include('customer::Desktop.profile_tabs.profile_account')
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('js_bot_all')
<script>
    $(window).bind("load", function () {
        // doi tabs noi dung
        RunFn.changeTabPartner();
        let titleFancybox = '';
        titleFancybox = $('[data-fancybox="gallery"]').attr('data-title');
        $('[data-fancybox="gallery"]').fancybox({
            margin: [44, 0, 22, 0],
            loop: true,
            thumbs: {
                autoStart: true,
                axis: 'x'
            },
            onInit: function () {
                if(titleFancybox != undefined){
                    $('.fancybox-inner').append('<h1 class="title_fancybox">'+ titleFancybox +'</h1>')
                }
            },
        });
        $('.js-trigger-fancybox').on('click', function(e){
            e.preventDefault;
            let dataFancybox = $(this).attr('data-target');
                $(dataFancybox).click();
            })
        });
</script>
@endpush