@extends('basecontainer::Desktop.layouts.default')
@section('content')
<main>
    <div class="breadcrumb" style="background-image: url({{ asset('template/images/bg-breadcrumb.jpg') }});">
        <div class="container">

        </div>
    </div>
    <div class="owner-profile not-logged-in">
        <div class="owner-profile">
            <div class="owner-info">
                <div class="container">
                    <div class="owner-info-top">
                        <div class="owner-big-avatar">
                            <div class="owner-avatar-img">
                                <img src="{{ asset('template/images/avatar-default.png') }}" alt="" class="lazy img-fluid" data-src="" >
                            </div>
                            <p class="followed text-center mt-2">
                                <strong class="number_of_follow"> {{ @$customer->follow_me_count ?? 0 }} </strong>
                                người theo dõi
                            </p>
                            @if (auth('customer')->check() && auth('customer')->id() != $customer->id)
                                <button onclick="return ownerFollowAction.followToggle({{ $customer->id }})" class="btn-custom btn-followed ">
                                    <i class="fa fa-rss" aria-hidden="true"></i>
                                    @if (auth('customer')->user()->hasFollowCurrentContractor($customer->id))
                                        <span id="follow-action">Hủy theo dõi</span>
                                    @else
                                        <span id="follow-action">Theo dõi ngay</span>
                                    @endif
                                </button>
                            @endif
                        </div>  
                        <div class="owner-short-info">
                            <p class="name">
                                {{ @$customer->fullname }}
                            </p>
                            <div class="owner-short-infos">
                                <div class="item">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <div class="item-content">
                                        Địa chỉ :
                                        <span class="item-value">
                                            {{ @$customer->mainAddress->address }}
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="item">
                                    <img src="{{ asset('template/images/ic-handshake.png') }}" alt=""  class="lazy img-fluid">
                                    <div class="item-content">
                                        Đối tác đã hợp tác:
                                        <BR>
                                        @foreach ($partnerHasCooperated as $partner)
                                            <a target="_blank" href="{{ $partner->generateDetailLink() }}">
                                                <span class="item-value">  
                                                    {{ $partner->name }} 
                                                </span>
                                        </a>
                                        @endforeach
                                    </div>
                                   
                                </div>
                            </div>
                            <!-- -->
                        </div>

                        <div class="partner-actions">
                            <a href="javascript:;" class="btn-color btn-custom btn-custom-has-img btn-upload-profile float-lg-right float-md-none float-none float-sm-right">
                                <img src="{{ asset('template/images/ic-envelope.png') }}" alt="Liên hệ">
                                Liên hệ
                            </a>
                            <div class="social-share mt-3 d-inline-block">
                                Chia sẻ cho bạn bè :
                                <a href="javascript:;" target="_blank" class="share-icon ml-1">
                                    <img src="{{ asset('template/images/ic-facebook.png') }}" alt="" class="img-fluid lazy">
                                </a>
                                <a href="javascript:;" target="_blank" class="share-icon ml-1">
                                    <img src="{{ asset('template/images/ic-mail-red.png') }}" alt="" class="img-fluid lazy">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="partner-main-content">
                <div class="container">
                    <div class="partner-tab-content active" id="box-congtrinh">
                        <div class="partner-tab-title-box">
                            <div class="partner-tab-title">
                                Công trình của tôi ({{$constructions->total()}})
                            </div>
                            <div class="partner-tab-box-actions ">
                                <form action="" id="partner-search" class="partner-search d-flex align-items-end flex-wrap">
                                    <div class="ml-auto mr-auto mr-lg-0 sort-box">
                                        <div class="custom-select-box">
                                            <select name="construction_type_id" class="js-drop-search form-control">
                                                <option value=""> Tất cả </option>
                                                @if($constructionTypes)
                                                    @foreach($constructionTypes as $type)
                                                        <option value="{{$type->id}}" @if($request->construction_type_id==$type->id) selected @endif> {{$type->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if($constructions->total() > 0)
                            <div class="project-list">
                                @foreach ($constructions as $construction)
                                    @include('construction::Desktop.components.owner_item',['construction'=>$construction,'evaluationRates'=>$evaluationRates])
                                @endforeach
                            </div>
                            @if ($constructions->currentPage() < $constructions->lastPage())
                                <div class="text-center">
                                    <a href="javascript:;" class="load-more view-more-project" data-page="2" data-perpage="{{$constructions->perPage()}}">Tải thêm <span id="count-load">{{$constructions->total() - ($constructions->perPage() * $constructions->currentPage())}}</span> công trình <i aria-hidden="true" class="fa fa-angle-down"></i><i aria-hidden="true" class="fa fa-spin fa-spinner"></i></a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('js_bot')
{!! \FunctionLib::addMedia('template/libs/fancybox/jquery.fancybox.min.js') !!}
{!! \FunctionLib::addMedia('template/libs/fancybox/jquery.fancybox.min.css') !!}
<script>
        $(window).bind("load", function() {
            // doi tabs noi dung
            RunFn.changeTabPartner();
            $('.js-drop-search').on('change',function(){
                $('#partner-search').submit()
            }) 
            let titleFancybox = '';
            titleFancybox = $('[data-fancybox="gallery"]').attr('data-title');
            $('[data-fancybox="gallery"]').fancybox({
                margin: [44, 0, 22, 0],
                loop: true,
                thumbs: {
                    autoStart: true,
                    axis: 'x'
                },
                onInit: function() {
                    if (titleFancybox != undefined) {
                        $('.fancybox-inner').append('<h1 class="title_fancybox">' + titleFancybox +
                            '</h1>')
                    }
                },
            });
            $('body').on('click','.load-more',function(){
            var object = $(this);
            var page = $(this).data('page');

            object.addClass('loading');

            var data = new FormData();
            var other_data = $('.form-search').serializeArray();
            $.each(other_data,function(key,input){
                data.append(input.name,input.value);
            });
            data.append('page',page);
            data.append('owner_id',{{@$request->owner_id??0}});
            data.append('_token',ENV.token);
            
            $.ajax({
                url: "{{ route('owner.get_more_owner_building') }}",
                method: 'get',
                data:{
                    owner_id: "{{ auth('customer')->id() }}",
                    page: page
                },
                success: function(response) {
                    object.removeClass('loading');
                    if (response.success) {
                        if (response.data.length > 0) {
                            object.data('page',parseInt(page) + 1);
                            count_items = parseInt($('#count-load').text() - parseInt(object.data('perpage')));
                            if(count_items < 1){
                                object.hide();
                            }else{
                                $('#count-load').text(count_items);
                            }
                            return $('.project-list').append(response.data);
                        }
                        Swal.fire({
                            title: 'Thông báo',
                            text:  'Đã tải hết toàn bộ công trình',
                            showCloseButton: true,
                            icon: "info"
                        }).then( () => {
                            object.hide();
                        });
                    } else {
                        Swal.fire({
                            title: 'Thông báo',
                            text:  'Có lỗi sảy ra! Hãy thử lái',
                            showCloseButton: true,
                            icon: "info"
                        })
                    }
                }
            });
        })
        // open all gallery 
        $('.js-trigger-fancybox').on('click', function(e) {
            e.preventDefault;
            let dataFancybox = $(this).attr('data-target');
            $(dataFancybox).click();
        })
    });
</script>
@endsection
@push('js_bot_all')
    <script src="{{ asset('template/js/pages/customer/detail.js') }}"></script>
@endpush
