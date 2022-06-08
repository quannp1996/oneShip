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

                $.ajax({
                    url: "{{ route('owner.get_more_owner_building') }}",
                    method: 'GET',
                    data:{
                        construction_type_id: $('select[name="construction_type_id"]').val(),
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