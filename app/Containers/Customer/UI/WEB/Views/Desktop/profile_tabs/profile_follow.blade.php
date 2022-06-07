<div class="partner-tab-content " id="box-doitac">
    <div class="partner-tab-title-box">
        <div class="partner-tab-title">
            @if ($peopleFollowingMe->count() > 0)
                Đang theo dõi ({{ $peopleFollowingMe->count() }})
            @else   
                Chưa có ai theo dõi 
            @endif
        </div>
        <div class="partner-tab-box-actions ">
            <form action="" class="partner-search d-flex align-items-end flex-wrap">
                <div class="sort-box sort-box ml-auto">
                    <div class="custom-select-box">
                        <select name="sort_by" id="sort_by" class="form-control" onchange="return sortFollower(this)">
                            <option value="created_at DESC" @if($request->sort_by == 'created_at DESC') selected @endif>
                                Gần đây nhất
                            </option>
                            <option value="created_at ASC" @if($request->sort_by == 'created_at ASC') selected @endif>Cũ nhất</option>
                        </select>
                    </div>
                </div>

            </form>
        </div>
        
    </div>

    <div class="owner-followed-list">
        <div class="row" id="follow-area">
            @forelse ($peopleFollowingMe as $follower)
                @if (!$follower->customer->contractor)
                    <div class="col-12 col-md-6 col-xl-4 follow-item">
                        <div class="followed-item-wrap">
                            <div class="followed-item is-person">
                                <div class="follower-ava">
                                    @if (!empty($follower->customer->avatar))
                                        <img src="{{ \ImageURL::getImageUrl($follower->customer->avatar, 'customer', 'avatar') }}" alt="" class="lazy img-fluid">
                                    @else 
                                        <img src="{{ asset('template/images/avatar-user.png') }}" alt="" class="lazy img-fluid">
                                    @endif 
                                </div>
                                <div class="followed-info">
                                <p class="name">{{ $follower->customer->fullname }}</p>
                                <p class="info-item">
                                    <i class="fa fa-rss" aria-hidden="true"></i>
                                    <span>{{ $totalFollowOfThoseFollower[$follower->customer->id]['total_follow'] }} người theo dõi</span>
                                </p>
                                <p class="info-item">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span>
                                        @if (!empty($follower->customer->mainAdress->address))
                                            {{ $follower->customer->mainAdress->address }}
                                        @else   
                                            Đang cập nhật
                                        @endif 
                                    </span>
                                </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else   
                <div class="col-12 col-md-6 col-xl-4 follow-item">
                    <div class="followed-item-wrap">
                    <div class="followed-item is-company">
                        <div class="follower-ava">
                            @if (!empty($follower->customer->contractor->logo))
                                <img src="{{ \ImageURL::getImageUrl($follower->customer->contractor->logo, 'contractor', 'logo') }}" 
                                     alt="" class="lazy img-fluid">
                            @else 
                                <img src="{{ asset('template/images/logo-partner.png') }}" alt="" class="lazy img-fluid">
                            @endif 
                        </div>

                        <div class="followed-info">
                            <p class="name">{{ $follower->customer->contractor->name }}</p>
                            <div class="detail-product-rate">
                                <div class="rate">
                                    <span class="stars-active" style="width: {{ $follower->customer->contractor->getStarPercent() }}%;">
                                        <i aria-hidden="true" class="fa fa-star"></i> 
                                        <i aria-hidden="true" class="fa fa-star"></i> 
                                        <i aria-hidden="true" class="fa fa-star"></i> 
                                        <i aria-hidden="true" class="fa fa-star"></i>
                                        <i aria-hidden="true" class="fa fa-star"></i>
                                    </span>

                                    <span class="stars-inactive">
                                        <i aria-hidden="true" class="fa fa-star"></i> 
                                        <i aria-hidden="true" class="fa fa-star"></i> 
                                        <i aria-hidden="true" class="fa fa-star"></i> 
                                        <i aria-hidden="true" class="fa fa-star"></i>
                                        <i aria-hidden="true" class="fa fa-star"></i>
                                    </span>
                                </div>

                                <span class="avg-rate">
                                    {{ $follower->customer->contractor->rate_point }} sao
                                </span>
                                <span class="amount-rate"><a href="javascript:;" data-id="#box-danhgia" class="js-triggertab">({{  $follower->customer->contractor->rate_count}} đánh giá)</a></span>
                            </div>
                            <p class="info-item">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>
                                    @if (!empty($follower->customer->mainAdress->address))
                                        {{ $follower->customer->mainAdress->address }}
                                    @else   
                                        Đang cập nhật
                                    @endif 
                                </span>
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
                @endif
            @empty
                <!-- Empty -->
            @endforelse
        </div><!-- /.End row -->
    </div>
</div><!-- /.End tab -->

@push('js_bot_all')
    <script>
        function sortFollower(element) {
            return $('#follow-area').html($('.follow-item').get().reverse());
        }
    </script>
@endpush 