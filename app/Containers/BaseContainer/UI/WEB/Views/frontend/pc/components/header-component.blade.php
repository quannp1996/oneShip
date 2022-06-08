<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 col-5 order-0">
                    <div class="logo-header">
                        <a href="{{ route('web.home.index') }}" title="">
                            <img src="{{ ImageURL::getImageUrl($settings['website']['logo'], 'setting', 'medium_seo') }}" alt="" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-12 text-right order-2 order-lg-1 mt-3 mt-lg-0">
                    <form action="" class="form-search-header">
                        <input type="text" name="" id="" placeholder="Nhập từ khóa tìm kiếm" />
                        <button class="submit">
                            <img src="{{ asset('template/images/ic-search-header.svg') }}" alt="" />
                        </button>
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 col-7 text-right order-1 order-lg-2">
                    <div class="accessories-header">
                        @include('basecontainer::frontend.pc.components.includes.header.user')
                        <div class="hotline-mobile-visible d-block d-lg-none">
                            <a href="javascript:;">
                                <img src="{{ asset('template/images/ic-hotline.svg') }}" alt="" />
                            </a>
                        </div>
                        <div class="cart-header">
                            <a href="{{ route('web.cart.index') }}" title="">
                                <img src="{{ asset('template/images/ic-cart.svg') }}" alt="" />
                                <span class="card_items">{{ count($cart['items']) }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-main">
        <div class="container">
            <div class="bg-main">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-9">
                        <div class="category-products--header">
                            <div class="box-title">
                                <a href="javascript:;" class="js-toggle-menu">
                                    <img src="{{ asset('template/images/ic-category-product.svg') }}" alt="" />
                                    danh mục sản phẩm
                                </a>
                            </div>
                            <div class="menu-list">
                                <div class="menu-item" v-for="n in 4" :key="n">
                                    <div class="parent js-click-parent">
                                        <a href="javascript:;" title="" class="title">
                                            Thiết bị vệ sinh
                                        </a>
                                        <a href="javascript:;" title="" class="nav">
                                            <i class="fa fa-chevron-right"></i>
                                        </a>
                                    </div>
                                    <div class="child">
                                        <a href="javascript:;" title="" class="title" v-for="n in 4"
                                            :key="n">
                                            Chậu rửa lavabo
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-3 text-right">
                        <div class="menu menu-main-header">
                            <div class="menu-hamburger">
                                <div class="menu-hamburger-line"></div>
                                <div class="menu-hamburger-line"></div>
                                <div class="menu-hamburger-line"></div>
                            </div>
                            <div class="menu-overlay"></div>
                            <div class="menu-items">
                                <div class="menu-links">
                                    <div class="menu-parent active">
                                        <a href="" title="">Trang chủ</a>
                                    </div>
                                </div>
                                <div class="menu-links">
                                    <div class="menu-parent">
                                        <a href="" title="">Giới thiệu</a>
                                    </div>
                                </div>
                                <div class="menu-links">
                                    <div class="menu-parent">
                                        <a href="" title="">sản phẩm</a>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                    </div>
                                    <div class="menu-sub">
                                        <div class="menu-sub-items">
                                            <div class="childrens" v-for="n in 4" :key="n">
                                                <div class="parent js-click-parent">
                                                    <a href="javascript:;" title="">Sản phẩm mới</a>
                                                    <a href="javascript:;" class="nav">
                                                        <i class="fa fa-chevron-right"></i>
                                                    </a>
                                                </div>
                                                <div class="child">
                                                    <a href="javascript:;">Bộ sưu tập phòng tắm</a>
                                                    <a href="javascript:;">Bộ sưu tập phòng tắm</a>
                                                    <a href="javascript:;">Bộ sưu tập phòng tắm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="menu-links">
                                    <div class="menu-parent">
                                        <a href="" title="">tin tức</a>
                                    </div>
                                </div>
                                <div class="menu-links">
                                    <div class="menu-parent">
                                        <a href="" title="">Liên hệ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 text-right d-none d-lg-block">
                        <div class="hotline-header">
                            <a href="javascript:;">
                                <img src="{{ asset('template/images/ic-hotline.svg') }}" alt="" />
                                Hotline: <span>{{ $settings['contact']['hotline'] }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
