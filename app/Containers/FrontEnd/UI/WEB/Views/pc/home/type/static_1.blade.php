<section class="home-content">
    <div class="container">
        <div class="box-title">
            {!! $staticPage->desc->short_description !!}
        </div>
        @foreach ($staticPage->buildItems() as $key => $item)
            @if (!$loop->last)
                @if ($key % 2 == 0)
                    <div class="box-content box-content-{{ $key + 1 }}">
                        <div class="left">
                            <div class="img-box">
                                <img src="{{ asset('upload/staticpage/' . $item->item_image) }}" alt="">
                            </div>
                        </div>
                        <div class="right">
                            <div class="text-box">
                                {!! $item->item_description !!}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="box-content box-content-2">
                        <div class="left">
                            <div class="text-box">
                                <a href="javascript:;" class="btn-box" data-actions="true">
                                    Giao hàng thông minh tiết kiệm
                                </a>
                                <div class="small-desc">
                                    @foreach ($staticPage->splitDesc(@$item->item_description ?? '') as $desc)
                                        @if (!empty($desc))
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
                                                {!! $desc !!}
                                            </p>
                                        @endif
                                    @endforeach
                                </div>
                                <a class="btn-use" href="javascript:;" data-actions="true">
                                    Sử dụng ngay
                                </a>
                            </div>
                        </div>
                        <div class="right">
                            <div class="img-box">
                                <img src="{{ asset('upload/staticpage/' . $item->item_image) }}" alt="">
                                <!-- static dots -->
                                <div class="absolute-dots">
                                    <div class="dots-group">
                                        @for ($i = 0; $i < 8; $i++)
                                            <div class="dots-element">
                                                <div class="dots-shape">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                                        preserveAspectRatio="none" viewBox="0 0 29.77 29.77"
                                                        class="" fill="rgba(0, 227, 221, 1)">
                                                        <circle cx="14.89" cy="14.89" r="14.89"></circle>
                                                    </svg>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                <!-- end static dots-->
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
        <div class="box-content box-content-4">
            <div class="box-title color-theme">
                <span>{{ $staticPage->desc->name }}</span>
            </div>
            <div class="rating-star">
                @for ($i = 0; $i < 5; $i++)
                    <span class="svg-star">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none"
                            viewBox="0 0 1664 1896.0833" class="" fill="rgba(6, 40, 83, 1)">
                            <path
                                d="M1664 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5T1321 1619q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5T301 1569q0-6 2-20l86-500L25 695Q0 668 0 647q0-37 56-46l502-73L783 73q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                            </path>
                        </svg>
                    </span>
                @endfor
            </div>
            <div class="list-img">
                @if ($staticPage->images)
                    @foreach (json_decode($staticPage->images) as $image)
                        <a href="javascript:;" class="">
                            <img src="{{ ImageURL::getImageUrl($image, 'staticpage', '') }}" alt="">
                        </a>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="box-content box-content-video">
            <div class="left">
                <div class="text-box">
                    {!! $item->item_description !!}
                </div>
            </div>
            <div class="right">
                <div class="video-box">
                    <a class="video-wrapper" 
                        href="javascript:;" 
                        data-play-video="true"
                        data-url="{{ $item->item_title }}" 
                        data-width="100%"
                        data-height="100%"
                    >
                        <img src="{{ asset('upload/staticpage/' . $item->item_image) }}" alt="">
                        <span class="icon-play">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                preserveAspectRatio="none" viewBox="0 0 408.7 408.7" fill="rgba(0, 0, 0, 0.5)">
                                <polygon fill="#fff" points="163.5 296.3 286.1 204.3 163.5 112.4 163.5 296.3">
                                </polygon>
                                <path
                                    d="M204.3,0C91.5,0,0,91.5,0,204.3S91.5,408.7,204.3,408.7s204.3-91.5,204.3-204.3S316.7,0,204.3,0ZM163.5,296.3V112.4l122.6,91.9Z"
                                    transform="translate(0 0)"></path>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
