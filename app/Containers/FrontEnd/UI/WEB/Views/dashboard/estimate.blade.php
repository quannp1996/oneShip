@extends('basecontainer::frontend.pc.layouts.home')

@section('content')
    <div class="admin-page" id="estimateVUE">
        @include('frontend::dashboard.components.sidebar')
        <div class="admin-page-layout">
            <!-- admin -header -->
            @include('frontend::dashboard.components.headbar')
            <!-- end admin header-->
            <div class="admin-main-layout">
                <div class="admin-main-container xl">
                    <div class="d-flex justify-content-between mt-20">
                        <div class="title text-30 font-weight-bold lh-32">
                            Ước tính phí vận chuyển
                        </div>
                    </div>
                    <div class="admin-card">
                        <div class="admin-card-body p-0">
                            <div class="admin-card-head py-3">
                                <div class="title">
                                    Địa chỉ người gửi
                                </div>
                            </div>
                            <div class="admin-card-body">
                                <div class="admin-card-row">
                                    <div class="col-3 mb-3">
                                        <div class="admin-form-item-label">
                                            <label for="city" class="admin-form-item-required" title="city">
                                                Tỉnh/ Thành phố
                                            </label>
                                        </div>
                                        <div class="admin-form-item-control">
                                            <div class="dropdown dropdown-custom">
                                                <button class=" dropdown-toggle" type="button" id="dropdownMenuButton"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <div class="dropdown-custom-input">
                                                        <input type="hidden" class="" placeholder="" value=""
                                                            id="">
                                                        <span class="current-custom"> Ha Noi </span>
                                                    </div>
                                                </button>
                                                <div class="dropdown-menu" aria-disabled="true" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Ho Chi Minh</a>
                                                    <a class="dropdown-item" href="#">Da Nang</a>
                                                    <a class="dropdown-item" href="#">Ha Tinh</a>
                                                    <a class="dropdown-item" href="#">Ho Chi Minh</a>
                                                    <a class="dropdown-item" href="#">Da Nang</a>
                                                    <a class="dropdown-item" href="#">Ha Tinh</a>
                                                    <a class="dropdown-item" href="#">Ho Chi Minh</a>
                                                    <a class="dropdown-item" href="#">Da Nang</a>
                                                    <a class="dropdown-item" href="#">Ha Tinh</a>
                                                    <a class="dropdown-item" href="#">Ho Chi Minh</a>
                                                    <a class="dropdown-item" href="#">Da Nang</a>
                                                    <a class="dropdown-item" href="#">Ha Tinh</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-3 mb-3">
                                        <div class="admin-form-item-label">
                                            <label for="district" class="admin-form-item-required" title="district">
                                                Quận/ Huyện
                                            </label>
                                        </div>
                                        <div class="admin-form-item-control">
                                            <div class="admin-form-item-control-input">
                                                <div class="admin-form-item-control-input-content">
                                                    <input placeholder="Vui lòng nhập quận/ Huyện" id="district"
                                                        class="admin-form-input" type="text" value="" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-3 mb-3">
                                        <div class="admin-form-item-label">
                                            <label for="warp" class="admin-form-item-required" title="warp">
                                                Thôn/ Xóm
                                            </label>
                                        </div>
                                        <div class="admin-form-item-control">
                                            <div class="admin-form-item-control-input">
                                                <div class="admin-form-item-control-input-content">
                                                    <input placeholder="Vui lòng nhập thôn/ Xóm" id="warp"
                                                        class="admin-form-input" type="text" value="" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-3 mb-3">
                                        <div class="admin-form-item-label">
                                            <label for="zipcode" class="admin-form-item-required" title="zipcode">
                                                Mã zip code
                                            </label>
                                        </div>
                                        <div class="admin-form-item-control">
                                            <div class="admin-form-item-control-input">
                                                <div class="admin-form-item-control-input-content">
                                                    <input placeholder="Vui lòng nhập mã zip code" id="zipcode"
                                                        class="admin-form-input" type="text" value="" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="admin-card-head py-3">
                                <div class="title">
                                    Địa chỉ người nhận
                                </div>

                            </div>
                            <div class="admin-card-body">
                                <div class="admin-card-row">
                                    <div class="col-3 mb-3">
                                        <div class="admin-form-item-label">
                                            <label for="city" class="admin-form-item-required" title="city">
                                                Tỉnh/ Thành phố
                                            </label>
                                        </div>
                                        <div class="admin-form-item-control">
                                            <div class="dropdown dropdown-custom">
                                                <button class=" dropdown-toggle" type="button" id="dropdownMenuButton"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <div class="dropdown-custom-input">
                                                        <input type="hidden" class="" placeholder="" value=""
                                                            id="">
                                                        <span class="current-custom"> Ha Noi </span>
                                                    </div>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Ho Chi Minh</a>
                                                    <a class="dropdown-item" href="#">Da Nang</a>
                                                    <a class="dropdown-item" href="#">Ha Tinh</a>
                                                    <a class="dropdown-item" href="#">Ho Chi Minh</a>
                                                    <a class="dropdown-item" href="#">Da Nang</a>
                                                    <a class="dropdown-item" href="#">Ha Tinh</a>
                                                    <a class="dropdown-item" href="#">Ho Chi Minh</a>
                                                    <a class="dropdown-item" href="#">Da Nang</a>
                                                    <a class="dropdown-item" href="#">Ha Tinh</a>
                                                    <a class="dropdown-item" href="#">Ho Chi Minh</a>
                                                    <a class="dropdown-item" href="#">Da Nang</a>
                                                    <a class="dropdown-item" href="#">Ha Tinh</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-3 mb-3">
                                        <div class="admin-form-item-label">
                                            <label for="district" class="admin-form-item-required" title="district">
                                                Quận/ Huyện
                                            </label>
                                        </div>
                                        <div class="admin-form-item-control">
                                            <div class="admin-form-item-control-input">
                                                <div class="admin-form-item-control-input-content">
                                                    <input placeholder="Vui lòng nhập quận/ Huyện" id="district"
                                                        class="admin-form-input" type="text" value="" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-3 mb-3">
                                        <div class="admin-form-item-label">
                                            <label for="warp" class="admin-form-item-required" title="warp">
                                                Thôn/ Xóm
                                            </label>
                                        </div>
                                        <div class="admin-form-item-control">
                                            <div class="admin-form-item-control-input">
                                                <div class="admin-form-item-control-input-content">
                                                    <input placeholder="Vui lòng nhập thôn/ Xóm" id="warp"
                                                        class="admin-form-input" type="text" value="" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-3 mb-3">
                                        <div class="admin-form-item-label">
                                            <label for="zipcode" class="admin-form-item-required" title="zipcode">
                                                Mã zip code
                                            </label>
                                        </div>
                                        <div class="admin-form-item-control">
                                            <div class="admin-form-item-control-input">
                                                <div class="admin-form-item-control-input-content">
                                                    <input placeholder="Vui lòng nhập mã zip code" id="zipcode"
                                                        class="admin-form-input" type="text" value="" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="admin-card-head py-3">
                                <div class="title">
                                    Trọng lượng
                                </div>
                            </div>
                            <div class="admin-card-body">

                                <div class="admin-card-row">
                                    <div class="col-3 mb-3">
                                        <div class="admin-form-item-label">
                                            <label for="kg" class="admin-form-item-required" title="kg">
                                                Trọng lượng kiện hàng
                                            </label>
                                        </div>
                                        <div class="admin-form-item-control">
                                            <div class="admin-form-item-control-input">
                                                <div class="admin-form-item-control-input-content">
                                                    <span class="admin-input-adon ">
                                                        <input placeholder="Vui lòng nhập" id="weight"
                                                            class="admin-form-input admin-adon-input" type="text"
                                                            value="" />
                                                        <span class="admin-input-group-addon">Kg</span>
                                                    </span>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="admin-card bg-transparent">
                        <div class=" d-flex align-items-center justify-content-end">
                            <button class="btn-themes nocolor-btn mr-2" data-dismiss="modal" type="button">
                                Hủy
                            </button>
                            <button class="btn-themes color-btn" type="submit">
                                Ước tính phí vận chuyển
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js_bot_all')
@endsection