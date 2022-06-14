@extends('basecontainer::frontend.pc.layouts.home')
@section('content')
    <div class="admin-main-layout">


        <div class="admin-main-container xl">
            <div class="d-flex justify-content-between mt-20">
                <div class="title text-30 font-weight-bold lh-32">
                    <button type="button" class="btn-themes btn-icons">
                        <span class="icon-svg">
                            <span role="img" aria-label="arrow-left">
                                <svg viewBox="64 64 896 896" focusable="false" data-icon="arrow-left" width="1em"
                                    height="1em" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 000 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z">
                                    </path>
                                </svg>
                            </span>
                        </span>
                    </button>

                    Tạo đơn hàng

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
                                    <label for="name" class="admin-form-item-required" title="name">
                                        Họ tên
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Vui lòng nhập " id="name" class="admin-form-input"
                                                type="text" value="" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-3 mb-3">
                                <div class="admin-form-item-label">
                                    <label for="mobile" class="admin-form-item-required" title="mobile">
                                        Số điện thoại
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Vui lòng nhập " id="zipcode" class="admin-form-input"
                                                type="text" value="" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-3 mb-3">
                                <div class="admin-form-item-label">
                                    <label for="email" class="admin-form-item-required" title="email">
                                        Email
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Vui lòng nhập " id="email" class="admin-form-input"
                                                type="text" value="" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-3"></div>
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
                                                <input type="hidden" class="" placeholder="" value="" id="">
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
                                            <input placeholder="Vui lòng nhập thôn/ Xóm" id="warp" class="admin-form-input"
                                                type="text" value="" />
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
                            <div class="col-3 mb-3">
                                <div class="admin-form-item-label">
                                    <label for="addr1" class="admin-form-item-required" title="addr1">
                                        Địa chỉ 1
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Vui lòng nhập " id="addr1" class="admin-form-input"
                                                type="text" value="" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-3 mb-3">
                                <div class="admin-form-item-label">
                                    <label for="addr2" class="admin-form-item-required" title="addr2">
                                        Địa chỉ 2
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Vui lòng nhập " id="addr2" class="admin-form-input"
                                                type="text" value="" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="admin-card">
                <div class="admin-card-body p-0">

                    <div class="admin-card-head py-3">
                        <div class="title">
                            Địa chỉ người nhận
                        </div>

                    </div>
                    <div class="admin-card-body">
                        <div class="admin-card-row">
                            <div class="col-3 mb-3">
                                <div class="admin-form-item-label">
                                    <label for="name" class="" title="name">
                                        Họ tên
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Vui lòng nhập " id="name" class="admin-form-input"
                                                type="text" value="" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-3 mb-3">
                                <div class="admin-form-item-label">
                                    <label for="mobile" class="" title="mobile">
                                        Số điện thoại
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Vui lòng nhập " id="zipcode" class="admin-form-input"
                                                type="text" value="" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-3 mb-3">
                                <div class="admin-form-item-label">
                                    <label for="email" class="" title="email">
                                        Email
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Vui lòng nhập " id="email" class="admin-form-input"
                                                type="text" value="" />
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
@endsection
