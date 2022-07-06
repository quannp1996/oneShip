@extends('basecontainer::frontend.pc.layouts.home')
@section('content')
    <div class="admin-main-layout" id="orderAPP">
        <svg aria-hidden="true" style="position: absolute; width: 0px; height: 0px; overflow: hidden;">
            <symbol id="icon-Filter" viewBox="0 0 1024 1024">
                <path
                    d="M111.402667 166.698667a38.4 38.4 0 0 1 34.858666-22.229334H877.653333a38.4 38.4 0 0 1 29.312 63.146667l-283.477333 335.274667v334.848a38.4 38.4 0 0 1-55.594667 34.304l-146.304-73.130667a38.4 38.4 0 0 1-21.205333-34.346667v-261.674666L116.949333 207.658667a38.4 38.4 0 0 1-5.546666-40.96z m117.632 54.570666l239.104 282.752a38.4 38.4 0 0 1 9.088 24.789334v252.032l69.504 34.730666v-286.72a38.4 38.4 0 0 1 9.045333-24.832l239.146667-282.752H229.034667z">
                </path>
            </symbol>
        </svg>
        <div class="admin-main-container xxl">
            <div class="d-flex justify-content-between mt-20">
                <div class="title text-24 lh-32">
                    Quản lý đơn hàng
                </div>
                <div class="d-flex align-items-center position-relative">
                    <div class="btn-themes nocolor-btn mr-2">
                        <div class="d-flex align-items-center">
                            <span class="icon-svg">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" class="">
                                    <path
                                        d="M7.57656 9.47171C7.68909 9.58424 7.8417 9.64745 8.00083 9.64745C8.15996 9.64745 8.31257 9.58424 8.42509 9.47171L10.7108 7.186C10.9451 6.95169 10.9451 6.57179 10.7108 6.33747C10.4765 6.10316 10.0966 6.10316 9.86228 6.33747L8.60083 7.59892V2.28555C8.60083 1.95418 8.3322 1.68555 8.00083 1.68555C7.66946 1.68555 7.40083 1.95418 7.40083 2.28555L7.40083 7.59892L6.13938 6.33747C5.90506 6.10316 5.52517 6.10316 5.29085 6.33747C5.05654 6.57179 5.05654 6.95169 5.29085 7.186L7.57656 9.47171Z">
                                    </path>
                                    <path
                                        d="M3.3618 7.99992C3.3618 7.66855 3.09318 7.39992 2.7618 7.39992C2.43043 7.39992 2.1618 7.66855 2.1618 7.99992V12.5714C2.1618 13.0336 2.34543 13.4769 2.67228 13.8037C2.99912 14.1306 3.44243 14.3142 3.90466 14.3142H12.0951C12.5574 14.3142 13.0007 14.1306 13.3275 13.8037C13.6544 13.4769 13.838 13.0336 13.838 12.5714V7.99992C13.838 7.66855 13.5694 7.39992 13.238 7.39992C12.9066 7.39992 12.638 7.66855 12.638 7.99992V12.5714C12.638 12.7153 12.5808 12.8534 12.479 12.9552C12.3772 13.057 12.2391 13.1142 12.0951 13.1142H3.90466C3.76069 13.1142 3.62261 13.057 3.5208 12.9552C3.419 12.8534 3.3618 12.7153 3.3618 12.5714V7.99992Z">
                                    </path>
                                </svg>
                            </span>
                            Xuất đơn hàng
                        </div>
                    </div>
                    <div class="btn-themes color-btn dropdown-hover">
                        <div class="d-flex align-items-center">
                            <span class="icon-svg">
                                <svg class="" focusable="false" viewBox="0 0 24 24" aria-hidden="true"
                                    style="    color: rgb(255, 255, 255);stroke: transparent;fill: currentColor;">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.9993 4.24219C12.4964 4.24219 12.8993 4.64513 12.8993 5.14219V11.0993H18.8565C19.3535 11.0993 19.7565 11.5023 19.7565 11.9993C19.7565 12.4964 19.3535 12.8993 18.8565 12.8993H12.8993V18.8565C12.8993 19.3535 12.4964 19.7565 11.9993 19.7565C11.5023 19.7565 11.0993 19.3535 11.0993 18.8565V12.8993H5.14219C4.64513 12.8993 4.24219 12.4964 4.24219 11.9993C4.24219 11.5023 4.64513 11.0993 5.14219 11.0993H11.0993V5.14219C11.0993 4.64513 11.5023 4.24219 11.9993 4.24219Z">
                                    </path>
                                </svg>
                            </span>
                            Tạo đơn hàng
                        </div>
                        <div class="dropdown-trigger-content">
                            <ul class="list-unstyled p-0 m-0">
                                <li class="item">
                                    <a href="{{ route('web_orders_create') }}">
                                        Tạo đơn hàng
                                    </a>
                                </li>
                                <li class="item">
                                    <a href="javascript:;">
                                        Tạo hàng loạt
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="admin-card">
                <div class="admin-card-body">
                    <ul class="nav admin-nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="sender-tab" data-toggle="tab" href="#sender" role="tab"
                                aria-controls="sender" aria-selected="true">
                                Tất cả
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="waiting-tab" data-toggle="tab" href="#waiting" role="tab"
                                aria-controls="waiting" aria-selected="false">
                                Đợi xử lý
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="waiting-print-tab" data-toggle="tab" href="#waiting-print"
                                role="tab" aria-controls="waiting-print" aria-selected="false">
                                Đợi in
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="printed-tab" data-toggle="tab" href="#printed" role="tab"
                                aria-controls="printed" aria-selected="false">
                                Đã in
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="sending-tab" data-toggle="tab" href="#sending" role="tab"
                                aria-controls="sending" aria-selected="false">
                                Vận chuyển
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab"
                                aria-controls="done" aria-selected="false">
                                Đã hoàn tất
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="saved-tab" data-toggle="tab" href="#saved" role="tab"
                                aria-controls="saved" aria-selected="false">
                                Lưu trữ
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="sender" role="tabpanel"
                            aria-labelledby="sender-tab">
                            <div class="admin-card-row justify-content-between">
                                <div class="col-8">
                                    <div class="admin-card-row mt-16">
                                        <div class="search-box mb-16 mr-16">
                                            <span class="search-box-wrap">
                                                <div class="keysuggest">
                                                    <div class="keysuggest-dropdown js-customdropdown-holder">
                                                        <span
                                                            class="admin-select-selection-item js-customdropdown-value">Từ
                                                            khóa</span>
                                                        <div class="keysuggest-dropdown-menu js-customdropdown-parent">
                                                            <a class="keysuggest-item js-customdropdown-item"
                                                                href="javascript:;">Từ khóa</a>
                                                            <a class="keysuggest-item js-customdropdown-item"
                                                                href="javascript:;">Tìm kiếm đa nguồn</a>
                                                            <a class="keysuggest-item js-customdropdown-item"
                                                                href="javascript:;">Số diện thoại người nhận</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="keyinput">
                                                    <span class="search-input">
                                                        <input
                                                            placeholder="Tìm kiếm mã đơn hàng/thông tin đơn hàng/sản phẩm/thông tin người nhận/ghi chú"
                                                            class="admin-form-input" type="text" value="" />
                                                        <span class="icon-svg">
                                                            <span role="img" tabindex="-1"
                                                                class="anticon searchBtn-fXszSa">
                                                                <svg width="20" height="20" viewBox="0 0 20 20"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M9.28525 4.32178C6.54355 4.32178 4.32097 6.54436 4.32097 9.28606C4.32097 12.0278 6.54355 14.2503 9.28525 14.2503C10.6218 14.2503 11.835 13.7222 12.7274 12.8632C12.7467 12.8383 12.7678 12.8143 12.7906 12.7914C12.8135 12.7686 12.8375 12.7475 12.8624 12.7282C13.7214 11.8358 14.2495 10.6226 14.2495 9.28606C14.2495 6.54436 12.027 4.32178 9.28525 4.32178ZM14.3558 13.296C15.2285 12.194 15.7495 10.8009 15.7495 9.28606C15.7495 5.71594 12.8554 2.82178 9.28525 2.82178C5.71513 2.82178 2.82097 5.71594 2.82097 9.28606C2.82097 12.8562 5.71513 15.7503 9.28525 15.7503C10.8001 15.7503 12.1932 15.2293 13.2952 14.3566L15.8978 16.9592C16.1907 17.2521 16.6655 17.2521 16.9584 16.9592C17.2513 16.6664 17.2513 16.1915 16.9584 15.8986L14.3558 13.296Z"
                                                                        fill="#415066"></path>
                                                                </svg>
                                                            </span>
                                                        </span>
                                                    </span>

                                                </div>
                                            </span>
                                        </div>
                                        <div class="sortby-time-box mb-16 mr-16">
                                            <span class="sortby-time-box-wrap">
                                                <div class="sortby-time">
                                                    <div class="sortby-time-dropdown js-customdropdown-holder">
                                                        <span
                                                            class="admin-select-selection-item js-customdropdown-value">Mọi
                                                            lúc</span>
                                                        <div class="sortby-time-dropdown-menu js-customdropdown-parent">
                                                            <a class="sortby-time-item js-customdropdown-item"
                                                                href="javascript:;">Mọi lúc</a>
                                                            <a class="sortby-time-item js-customdropdown-item"
                                                                href="javascript:;">Một ngày trước / hôm qua</a>
                                                            <a class="sortby-time-item js-customdropdown-item"
                                                                href="javascript:;">3 ngày trước</a>
                                                            <a class="sortby-time-item js-customdropdown-item"
                                                                href="javascript:;">7 ngày trước</a>
                                                            <a class="sortby-time-item js-customdropdown-item"
                                                                href="javascript:;">30 ngày trước</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </span>
                                        </div>
                                        <div class="sortby-date mb-16 mr-16">
                                            <input type="text" name="datetimes" class="admin-form-input"
                                                placeholder="Ngày bắt đầu - Ngày kết thúc" />
                                        </div>
                                        <div class="sortby-status mb-16 mr-16">
                                            <span class="sortby-status-box-wrap">
                                                <div class="sortby-status">
                                                    <div class="sortby-status-dropdown position-relative ">
                                                        <a class="js-show-sortby" href="javascript:;">
                                                            <span class="admin-select-selection-item admin-form-input">
                                                                Trạng thái đơn hàng
                                                                <span role="img" class="icon-svg"><svg class=""
                                                                        aria-hidden="true">
                                                                        <use xlink:href="#icon-Filter"></use>
                                                                    </svg></span>
                                                            </span>
                                                        </a>
                                                        <div class="sortby-status-dropdown-menu js-sortby-content">
                                                            <div class="d-flex ">
                                                                <div class="">
                                                                    <div class="title">Trạng thái đơn hàng</div>
                                                                    <div class="d-flex flex-column">
                                                                        <label class="checkbox-custom" for="id-1">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-1">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Đã tạo
                                                                            </span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-2">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-2">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Đã hoàn tất
                                                                            </span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-3">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-3">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Bị hủy
                                                                            </span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-4">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-4">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Hủy </span>

                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <div class="title">Trạng thái thanh toán</div>
                                                                    <div class="d-flex flex-column">
                                                                        <label class="checkbox-custom" for="id-5">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-5">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Đã thanh
                                                                                toán</span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-6">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-6">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Chưa thanh
                                                                                toán </span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-7">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-7">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Đã hoàn lại
                                                                            </span>

                                                                        </label>

                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <div class="title">Trạng thái giao hàng</div>
                                                                    <div class="d-flex flex-column">
                                                                        <label class="checkbox-custom" for="id-8">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-8">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Đợi giao
                                                                                hàng đi </span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-9">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-9">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Vận chuyển
                                                                            </span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-10">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-10">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Hoàn thành
                                                                            </span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-11">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-11">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Đã hoàn lại
                                                                            </span>

                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </span>
                                        </div>
                                        <div class="sortby-status mb-16 mr-16">
                                            <span class="sortby-status-box-wrap">
                                                <div class="sortby-status">
                                                    <div class="sortby-status-dropdown position-relative">
                                                        <a class="js-show-sortby" href="javascript:;">
                                                            <span class="admin-select-selection-item admin-form-input">
                                                                Trạng thái vận chuyển
                                                                <span role="img" class="icon-svg"><svg class=""
                                                                        aria-hidden="true">
                                                                        <use xlink:href="#icon-Filter"></use>
                                                                    </svg></span>
                                                            </span>
                                                        </a>
                                                        <div
                                                            class="sortby-status-dropdown-menu sortby-status-dropdown-menu-small js-sortby-content">
                                                            <div class="d-flex ">
                                                                <div class="">
                                                                    <div class="d-flex flex-column">
                                                                        <label class="checkbox-custom" for="id-22">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-22">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Đợi xử
                                                                                lý</span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-23">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-23">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Giao hàng
                                                                                thất bại </span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-24">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-24">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Đang xử lý
                                                                            </span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-25">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-25">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Đợi in
                                                                            </span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-26">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-26">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Đã in
                                                                            </span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-27">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-27">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Vận chuyển
                                                                            </span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-28">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-28">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Đã hoàn
                                                                                tất </span>

                                                                        </label>
                                                                        <label class="checkbox-custom" for="id-29">
                                                                            <span class="checkbox-custom-input">
                                                                                <input type="checkbox" class="d-none"
                                                                                    value="" id="id-29">
                                                                                <span class="checkbox-custom-icon"></span>
                                                                            </span>
                                                                            <span class="checkbox-custom-name">Đã hoàn
                                                                                lại </span>

                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </span>
                                        </div>
                                        <a class="" href="javascript:;" onclick="showFilterBars();">
                                            <span class="admin-select-selection-item admin-form-input">
                                                Lọc
                                                <span role="img" class="icon-svg small"><svg class=""
                                                        aria-hidden="true">
                                                        <use xlink:href="#icon-Filter"></use>
                                                    </svg></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="d-flex justify-content-end mt-16">
                                        <a href="javascript:;" class="mb-16 mr-16">
                                            <span class="admin-form-input">
                                                Quản lý thẻ tùy chỉnh
                                            </span>
                                        </a>
                                        <div class="filter-dropdown js-customdropdown-holder mb-16 mr-16">
                                            <span class="admin-select-selection-item js-customdropdown-value">Lọc</span>
                                            <div class="filter-dropdown-menu js-customdropdown-parent"
                                                style="display: none;">
                                                <a class="filter-item-dropdown js-customdropdown-item"
                                                    href="javascript:;">Lọc theo</a>
                                                <a class="filter-item-dropdown js-customdropdown-item"
                                                    href="javascript:;">Thời gian tạo ( từ mới đến cũ )</a>
                                                <a class="filter-item-dropdown js-customdropdown-item"
                                                    href="javascript:;">Thời gian tạo ( từ cũ đến mới )</a>
                                                <a class="filter-item-dropdown js-customdropdown-item"
                                                    href="javascript:;">Mã đơn hàng ( giảm dần )</a>
                                                <a class="filter-item-dropdown js-customdropdown-item"
                                                    href="javascript:;">Mã đơn hàng ( tăng dần )</a>
                                                <a class="filter-item-dropdown js-customdropdown-item"
                                                    href="javascript:;">Tên người nhận (Z-A)</a>
                                                <a class="filter-item-dropdown js-customdropdown-item"
                                                    href="javascript:;">Tên người nhận (A-Z)</a>
                                            </div>
                                        </div>
                                        <a href="javascript:;" class="javascript:;" onclick="showEditBars();">
                                            <span class="admin-form-input">
                                                Chỉnh sửa tiêu đề
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="sorted-value-box">
                                <div class="d-flex align-items-center">
                                    {{-- <div>
                                        <button type="button" class="btn-themes nocolor-btn btn-themes-small"
                                            data-toggle="modal" data-target="#exampleModal">
                                            <span class="icon-svg smm">
                                                <span role="img" class="color-748399">
                                                    <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                                        width="1em" height="1em" fill="currentColor"
                                                        aria-hidden="true" focusable="false" class="">
                                                        <path
                                                            d="M8.59961 10.0006C8.59961 9.50353 9.00255 9.10059 9.49961 9.10059H14.4996C14.9967 9.10059 15.3996 9.50353 15.3996 10.0006C15.3996 10.4976 14.9967 10.9006 14.4996 10.9006H9.49961C9.00255 10.9006 8.59961 10.4976 8.59961 10.0006Z">
                                                        </path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M18.9996 20.9006C20.049 20.9006 20.8996 20.0499 20.8996 19.0006V8.40602C20.8996 6.99893 20.3406 5.64947 19.3457 4.65451C18.3507 3.65955 17.0013 3.10059 15.5942 3.10059H4.99961C3.95027 3.10059 3.09961 3.95124 3.09961 5.00059V19.0006C3.09961 20.0499 3.95027 20.9006 4.99961 20.9006H18.9996ZM4.99961 4.90059C4.94438 4.90059 4.89961 4.94536 4.89961 5.00059V19.0006C4.89961 19.0558 4.94438 19.1006 4.99961 19.1006H7.09961V15.0006C7.09961 13.9512 7.95027 13.1006 8.99961 13.1006H14.9996C16.049 13.1006 16.8996 13.9512 16.8996 15.0006V19.1006H18.9996C19.0548 19.1006 19.0996 19.0558 19.0996 19.0006V8.40602C19.0996 7.47632 18.7303 6.5847 18.0729 5.9273C17.4155 5.26991 16.5239 4.90059 15.5942 4.90059H4.99961ZM15.0996 19.1006V15.0006C15.0996 14.9454 15.0548 14.9006 14.9996 14.9006H8.99961C8.94438 14.9006 8.89961 14.9454 8.89961 15.0006V19.1006H15.0996Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </span>
                                            <span>Lưu điều kiện tìm kiếm</span>
                                        </button>
                                    </div> --}}
                                    <div style="flex : 1 1 0% ; " class="ml-2">
                                        <span class="sorted-value-tag">
                                            Ngày đặt hàng: 2022-05-18 ~ 2022-06-16
                                            <span class="icon-svg">
                                                <span role="img" aria-label="close" tabindex="-1"
                                                    class="color-748399">
                                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="close"
                                                        width="1em" height="1em" fill="currentColor"
                                                        aria-hidden="true">
                                                        <path
                                                            d="M563.8 512l262.5-312.9c4.4-5.2.7-13.1-6.1-13.1h-79.8c-4.7 0-9.2 2.1-12.3 5.7L511.6 449.8 295.1 191.7c-3-3.6-7.5-5.7-12.3-5.7H203c-6.8 0-10.5 7.9-6.1 13.1L459.4 512 196.9 824.9A7.95 7.95 0 00203 838h79.8c4.7 0 9.2-2.1 12.3-5.7l216.5-258.1 216.5 258.1c3 3.6 7.5 5.7 12.3 5.7h79.8c6.8 0 10.5-7.9 6.1-13.1L563.8 512z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </span>
                                        </span>
                                    </div>
                                    <div style="flex: 0 0 72px ; max-width : 72px; margin-left : auto ;">
                                        <button type="button" class="btn-themes nocolor-btn btn-themes-small">
                                            <span class="icon-svg smm">
                                                <span role="img" class="color-748399">
                                                    <svg width="1em" height="1em" viewBox="0 0 12 12"
                                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                                        aria-hidden="true" focusable="false" class="">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M3.01625 3.64658C3.71262 2.76487 4.79056 2.19999 6.00005 2.19999C8.09873 2.19999 9.80005 3.90131 9.80005 5.99999C9.80005 6.24852 10.0015 6.44999 10.25 6.44999C10.4986 6.44999 10.7 6.24852 10.7 5.99999C10.7 3.40425 8.59579 1.29999 6.00005 1.29999C4.25982 1.29999 2.74107 2.246 1.9291 3.64966C1.86224 3.76524 1.85016 3.90454 1.89613 4.0299C1.94209 4.15526 2.04135 4.25374 2.16708 4.2987L3.48739 4.77092C3.7214 4.85462 3.97896 4.73277 4.06265 4.49875C4.14635 4.26474 4.02449 4.00719 3.79048 3.9235L3.01625 3.64658ZM1.75005 5.54999C1.99858 5.54999 2.20005 5.75146 2.20005 5.99999C2.20005 8.09867 3.90137 9.79999 6.00005 9.79999C7.20953 9.79999 8.28747 9.2351 8.98385 8.35339L8.20961 8.07648C7.9756 7.99278 7.85375 7.73523 7.93744 7.50122C8.02114 7.26721 8.27869 7.14535 8.5127 7.22905L9.83302 7.70127C9.95874 7.74624 10.058 7.84471 10.104 7.97007C10.1499 8.09544 10.1379 8.23474 10.071 8.35031C9.25902 9.75397 7.74028 10.7 6.00005 10.7C3.40431 10.7 1.30005 8.59573 1.30005 5.99999C1.30005 5.75146 1.50152 5.54999 1.75005 5.54999Z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </span>
                                            <span>Xóa</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="admin-table mt-20">
                                <div class="admin-table-container" style="position: relative; overflow-x: auto;">
                                    <div>
                                        <table style="table-layout: fixed;">
                                            <colgroup>
                                                <col style="width: 44px;" />
                                                <col style="width: 200px;" />
                                                <col style="width: 200px;" />
                                                <col style="width: 150px;" />
                                                <col style="width: 230px;" />
                                                <col style="width: 300px;" />
                                                <col style="width: 160px;" />
                                                <col style="width: 180px;" />
                                                <col style="width: 280px;" />
                                                <col style="width: 155px;" />
                                                <col style="width: 120px;" />
                                                <col style="width: 80px;" />
                                            </colgroup>
                                            <thead class="admin-table-thead">
                                                <tr>
                                                    <th class="admin-table-cell admin-table-cell-fix-left"
                                                        style="position: sticky; left: 0px;">
                                                        <label class="checkbox-custom mb-0" for="aaa">
                                                            <span class="checkbox-custom-input">
                                                                <input type="checkbox" class="d-none" value=""
                                                                    id="aaa" />
                                                                <span class="checkbox-custom-icon"></span>
                                                            </span>
                                                        </label>
                                                    </th>
                                                    <th class="admin-table-cell admin-table-cell-fix-left admin-table-cell-fix-left-last"
                                                        style="position: sticky; left: 44px;">Mã đơn hàng</th>
                                                    <th class="admin-table-cell">
                                                        <div>Người bán</div>
                                                        <span class="tips">Kiểu tích hợp</span>
                                                    </th>
                                                    <th class="admin-table-cell">Trạng thái đơn hàng</th>
                                                    <th class="admin-table-cell">Khu vực gửi hàng</th>
                                                    <th class="admin-table-cell">Người nhận</th>
                                                    <th class="admin-table-cell">Phương thức giao hàng</th>
                                                    <th class="admin-table-cell">Thông tin nhận hàng</th>
                                                    <th class="admin-table-cell">
                                                        <div>Hãng vận chuyển<span class="tips">(Dịch vụ)</span></div>
                                                        <div class="tips">Mã vận đơn trên</div>
                                                    </th>
                                                    <th class="admin-table-cell">Trạng thái vận chuyển OneShip</th>
                                                    <th class="admin-table-cell">Thời gian tạo</th>
                                                    <th class="admin-table-cell" style="text-align: right;">Ghi chú đơn
                                                        hàng</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>

                                    <div class="admin-table-body" v-if="orders && orders.length">
                                        <div>
                                            <div class="d-flex custom-row" v-for="item in orders">
                                                <div class="variable-cell variable-cell-fix-left"
                                                    style="width: 44px; left: 0px;">
                                                    <span>
                                                        <label class="checkbox-custom mb-0" for="a1">
                                                            <span class="checkbox-custom-input">
                                                                <input type="checkbox" class="d-none" value=""
                                                                    id="a1" />
                                                                <span class="checkbox-custom-icon"></span>
                                                            </span>
                                                        </label>
                                                    </span>
                                                </div>
                                                <div class="variable-cell variable-cell-fix-left"
                                                    style="width: 200px; left: 44px;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="order-id color-15bbb9 h-20 lh-20 mr-1" v-text="item.code"></div>
                                                        <span role="img" tabindex="-1" class="icon-svg smm ">
                                                            <svg viewBox="0 0 14 15" class="color-748399"
                                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                                                aria-hidden="true" focusable="false" class="">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M2.99952 3.0251C2.87354 3.0251 2.75272 3.07514 2.66364 3.16422C2.57456 3.2533 2.52452 3.37412 2.52452 3.5001V8.0001C2.52452 8.12607 2.57456 8.24689 2.66364 8.33597C2.75272 8.42505 2.87354 8.4751 2.99952 8.4751H3.49952C3.78947 8.4751 4.02452 8.71015 4.02452 9.0001C4.02452 9.29005 3.78947 9.5251 3.49952 9.5251H2.99952C2.59506 9.5251 2.20717 9.36443 1.92118 9.07843C1.63519 8.79244 1.47452 8.40455 1.47452 8.0001V3.5001C1.47452 3.09564 1.63519 2.70775 1.92118 2.42176C2.20717 2.13577 2.59506 1.9751 2.99952 1.9751H7.49952C7.90397 1.9751 8.29186 2.13577 8.57785 2.42176C8.86385 2.70775 9.02452 3.09564 9.02452 3.5001V4.0001C9.02452 4.29005 8.78947 4.5251 8.49952 4.5251C8.20957 4.5251 7.97452 4.29005 7.97452 4.0001V3.5001C7.97452 3.37412 7.92447 3.2533 7.83539 3.16422C7.74631 3.07514 7.62549 3.0251 7.49952 3.0251H2.99952ZM6.49952 6.5251C6.23718 6.5251 6.02452 6.73776 6.02452 7.0001V11.5001C6.02452 11.7624 6.23718 11.9751 6.49952 11.9751H10.9995C11.2619 11.9751 11.4745 11.7624 11.4745 11.5001V7.0001C11.4745 6.73776 11.2619 6.5251 10.9995 6.5251H6.49952ZM4.97452 7.0001C4.97452 6.15786 5.65728 5.4751 6.49952 5.4751H10.9995C11.8418 5.4751 12.5245 6.15786 12.5245 7.0001V11.5001C12.5245 12.3423 11.8418 13.0251 10.9995 13.0251H6.49952C5.65728 13.0251 4.97452 12.3423 4.97452 11.5001V7.0001Z">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="variable-cell" style="width: 200px;">
                                                    <div>
                                                        <div class="d-flex align-items-center flex-wrap">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="26"
                                                                height="26" viewBox="0 0 26 26" fill="none"
                                                                style="font-size: 18px; width: 16px;">
                                                                <path
                                                                    d="M22.3 25.5H3.19995C1.39995 25.5 0 24.1 0 22.3V3.19995C0 1.39995 1.39995 0 3.19995 0H22.3C24.1 0 25.5 1.39995 25.5 3.19995V22.3C25.5 24.1 24.1 25.5 22.3 25.5Z"
                                                                    fill="#02C9C4"></path>
                                                                <path
                                                                    d="M12.9001 20.7001C10.7001 20.7001 8.60012 19.9001 7.00012 18.6001L6.6001 18.3001L8.6001 16.1001L8.90015 16.3001C9.90015 17.0001 11.1001 17.6001 12.9001 17.6001C13.7001 17.6001 16.0001 17.3001 16.0001 15.9001C16.0001 15.0001 14.8001 14.6001 12.7001 14.1001C10.1001 13.5001 6.80017 12.7001 6.80017 9.1001C6.80017 6.4001 9.30017 4.6001 13.3002 4.6001C15.6002 4.6001 17.3001 5.40009 18.1001 5.90009L18.5001 6.1001L17.1001 8.80011L16.7001 8.50012C15.7001 7.90012 14.5002 7.50012 13.3002 7.50012C11.7002 7.50012 9.90015 7.90012 9.90015 9.00012C9.90015 10.1001 11.2002 10.5001 13.3002 10.9001C15.9002 11.5001 19.1001 12.1001 19.1001 15.7001C19.0001 19.0001 16.7001 20.7001 12.9001 20.7001Z"
                                                                    fill="#00112F"></path>
                                                            </svg>
                                                            <p class="mb-0">Tạo thủ công</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="variable-cell" style="width: 150px;">
                                                    <div>
                                                        <p class="d-block mb-0 w-100 color-748399">-</p>
                                                        <p class="d-block mb-0 w-100 color-748399">Đã thanh toán</p>
                                                        <p class="d-block mb-0 w-100 color-748399">-</p>
                                                    </div>
                                                </div>
                                                <div class="variable-cell" style="width: 230px;">
                                                    <div>
                                                        <p class="d-block mb-0 w-100 color-748399 text-12">
                                                            VN-đống đa-Thu Do Ha Noi
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="variable-cell" style="width: 300px;">
                                                    <div>
                                                        <p class="d-block mb-0 w-100 text-14 text-black">
                                                            name
                                                        </p>
                                                        <p class="d-block mb-0 w-100 color-748399 text-12">
                                                            VN-Tỉnh Bến Tre-Huyện Mỏ Cày Nam
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="variable-cell" style="width: 160px;">
                                                    <div>
                                                        <p class="d-block mb-0 w-100 color-748399 text-12">
                                                            Phương thức giao hàng
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="variable-cell" style="width: 180px;">
                                                    <div>
                                                        <p class="d-block mb-0 w-100 color-748399 text-12">
                                                            Tự gửi hàng
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="variable-cell" style="width: 280px;">
                                                    <div class="d-flex align-items-center flex-wrap"
                                                        style="row-gap: 0px;">
                                                        <img class="img-fluid mr-2" src="images/ic-ghtk-standard.png"
                                                            width="50" />
                                                        <div>GHN-Standard</div>
                                                    </div>
                                                </div>
                                                <div class="variable-cell" style="width: 155px;">
                                                    <span class="admin-tag admin-tag-waiting">Đợi xử lý</span>
                                                </div>
                                                <div class="variable-cell" style="width: 120px;">
                                                    <span class="color-748399">2022-06-14 14:42:11</span>
                                                </div>
                                                <div class="variable-cell" style="width: 80px;">
                                                    <span class="color-748399">Ghi chú laskdj lkmz x,cm kajsdh kajshd
                                                        ,nzx,mcn</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-3">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <ul class=" custom-paging">
                                            <li class="paging-prev disabled">
                                                <a href="javascript:;">
                                                    <span role="img" aria-label="left" class="icon-svg small">
                                                        <svg viewBox="64 64 896 896" focusable="false" data-icon="left"
                                                            width="1em" height="1em" fill="currentColor"
                                                            aria-hidden="true">
                                                            <path
                                                                d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </li>
                                            <li title="1" class="item-paging active" tabindex="0"><a
                                                    rel="nofollow">1</a></li>
                                            <li class="paging-next disabled">
                                                <a href="javascript:;">
                                                    <span role="img" aria-label="right" class="icon-svg small">
                                                        <svg viewBox="64 64 896 896" focusable="false" data-icon="right"
                                                            width="1em" height="1em" fill="currentColor"
                                                            aria-hidden="true">
                                                            <path
                                                                d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="ant-pagination-options">

                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="receiver" role="tabpanel" aria-labelledby="receiver-tab">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- fixed filter bars -->

    <div id="fixed-filter-bars">

        <div class="overlay-filter-bars" onclick="closeFilterBars()"></div>

        <div class="filter-bars-wrap">
            <div class="filter-bars-wrapper-body">
                <div class="filter-bars-body">
                    <div class="d-flex align-items-center justify-content-between filter-bars-title">
                        <span class="color-00112f font-weight-bold">Lọc</span>
                        <a href="javascript:;" class="icon-svg" onclick="closeFilterBars()">
                            <span class="color-00112f ">
                                <span role="img" class="anticon delIcon-pj-eVU">
                                    <svg width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                                        class="">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.36321 5.36321C5.71469 5.01174 6.28453 5.01174 6.63601 5.36321L11.9996 10.7268L17.3632 5.36321C17.7147 5.01174 18.2845 5.01174 18.636 5.36321C18.9875 5.71469 18.9875 6.28453 18.636 6.63601L13.2724 11.9996L18.636 17.3632C18.9875 17.7147 18.9875 18.2845 18.636 18.636C18.2845 18.9875 17.7147 18.9875 17.3632 18.636L11.9996 13.2724L6.63601 18.636C6.28453 18.9875 5.71469 18.9875 5.36321 18.636C5.01174 18.2845 5.01174 17.7147 5.36321 17.3632L10.7268 11.9996L5.36321 6.63601C5.01174 6.28453 5.01174 5.71469 5.36321 5.36321Z">
                                        </path>
                                    </svg>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="list-item">
                        <div class="item">
                            <a class="title d-flex align-items-center justify-content-between color-748399"
                                data-toggle="collapse" href="#multiCollapseExample1" role="button"
                                aria-expanded="false" aria-controls="multiCollapseExample1">
                                Kênh bán hàng gốc
                                <span role="img" aria-label="right" class="icon-svg smm color-748399">
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em"
                                        height="1em" fill="currentColor" aria-hidden="true" style="">
                                        <path
                                            d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z">
                                        </path>
                                    </svg>
                                </span>
                            </a>
                            <div class="collapse item-scroll" id="multiCollapseExample1">
                                <div class="d-flex flex-column">
                                    <label class="checkbox-custom" for="id-woocommerce">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-woocommerce">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Woocommerce </span>

                                    </label>
                                    <label class="checkbox-custom" for="id-woocommerce">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-woocommerce">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Woocommerce </span>

                                    </label>
                                    <label class="checkbox-custom" for="id-woocommerce">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-woocommerce">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Woocommerce </span>

                                    </label>
                                    <label class="checkbox-custom" for="id-woocommerce">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-woocommerce">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Woocommerce </span>

                                    </label>
                                    <label class="checkbox-custom" for="id-woocommerce">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-woocommerce">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Woocommerce </span>

                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <a class="title d-flex align-items-center justify-content-between color-748399"
                                data-toggle="collapse" href="#multiCollapseExample2" role="button"
                                aria-expanded="false" aria-controls="multiCollapseExample2">
                                Phương thức giao hàng

                                <span role="img" aria-label="right" class="icon-svg smm color-748399">
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em"
                                        height="1em" fill="currentColor" aria-hidden="true" style="">
                                        <path
                                            d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z">
                                        </path>
                                    </svg>
                                </span>
                            </a>
                            <div class="collapse item-scroll" id="multiCollapseExample2">
                                <div class="d-flex flex-column">
                                    <label class="checkbox-custom" for="id-nhantaicuahang">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-nhantaicuahang">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Nhận tại cửa hàng </span>

                                    </label>
                                    <label class="checkbox-custom" for="id-giaohangtannoi">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-giaohangtannoi">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Giao hàng tận nơi </span>

                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <a class="title d-flex align-items-center justify-content-between color-748399"
                                data-toggle="collapse" href="#multiCollapseExample3" role="button"
                                aria-expanded="false" aria-controls="multiCollapseExample3">
                                Ghi chú đơn hàng

                                <span role="img" aria-label="right" class="icon-svg smm color-748399">
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em"
                                        height="1em" fill="currentColor" aria-hidden="true" style="">
                                        <path
                                            d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z">
                                        </path>
                                    </svg>
                                </span>
                            </a>
                            <div class="collapse item-scroll" id="multiCollapseExample3">
                                <div class="d-flex flex-column">
                                    <label class="checkbox-custom" for="id-ghichudonhang">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-ghichudonhang">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Ghi chú đơn hàng </span>

                                    </label>
                                    <label class="checkbox-custom" for="id-ghichuoneship">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-ghichuoneship">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Ghi chú Oneship</span>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter-bars-footer">
                    <div class="d-flex align-items-center justify-content-end">
                        <button type="button" class="btn-themes nocolor-btn">
                            <span>Xóa</span>
                        </button>
                        <button type="button" class="btn-themes color-btn">
                            <span>Gửi</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- chinh sua tieu de -->
    <div id="fixed-edit-bars">

        <div class="overlay-edit-bars" onclick="closeEditBars()"></div>

        <div class="edit-bars-wrap">
            <div class="edit-bars-wrapper-body">
                <div class="edit-bars-body">
                    <div class="d-flex align-items-center justify-content-between edit-bars-title">
                        <span class="color-00112f font-weight-bold">Chỉnh sửa tiêu đề</span>
                        <a href="javascript:;" class="icon-svg" onclick="closeEditBars()">
                            <span class="color-00112f ">
                                <span role="img" class="anticon delIcon-pj-eVU">
                                    <svg width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                                        class="">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.36321 5.36321C5.71469 5.01174 6.28453 5.01174 6.63601 5.36321L11.9996 10.7268L17.3632 5.36321C17.7147 5.01174 18.2845 5.01174 18.636 5.36321C18.9875 5.71469 18.9875 6.28453 18.636 6.63601L13.2724 11.9996L18.636 17.3632C18.9875 17.7147 18.9875 18.2845 18.636 18.636C18.2845 18.9875 17.7147 18.9875 17.3632 18.636L11.9996 13.2724L6.63601 18.636C6.28453 18.9875 5.71469 18.9875 5.36321 18.636C5.01174 18.2845 5.01174 17.7147 5.36321 17.3632L10.7268 11.9996L5.36321 6.63601C5.01174 6.28453 5.01174 5.71469 5.36321 5.36321Z">
                                        </path>
                                    </svg>
                                </span>
                            </span>
                        </a>
                    </div>
                    <p class="color-00112f mb-2">
                        Vui lòng giữ ít nhất 5 tiêu đề
                    </p>
                    <div class="edit-bars-content">
                        <p class="title">
                            Kéo để sắp xếp hoặc lựa chọn Hiển thị/Ẩn tiêu đề
                        </p>
                        <div class="list-drag">
                            <div class="drag-item disabled-row">
                                <div class="drag-list-item">
                                    <div class="drag-list-sort-icon-wrap">
                                        <div class="drag-list-sort-icon"></div>
                                    </div>
                                    <div class="drag-list-column-cell">
                                        <label class="checkbox-custom" for="id-madonhang">
                                            <span class="checkbox-custom-input">
                                                <input type="checkbox" class="d-none" value="" id="id-madonhang">
                                                <span class="checkbox-custom-icon"></span>
                                            </span>
                                            <span class="checkbox-custom-name">Mã đơn hàng </span>

                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="drag-item">
                                <div class="drag-list-item">
                                    <div class="drag-list-sort-icon-wrap">
                                        <div class="drag-list-sort-icon"></div>
                                    </div>
                                    <div class="drag-list-column-cell">
                                        <label class="checkbox-custom" for="id-nguoiban">
                                            <span class="checkbox-custom-input">
                                                <input type="checkbox" class="d-none" value="" id="id-nguoiban">
                                                <span class="checkbox-custom-icon"></span>
                                            </span>
                                            <span class="checkbox-custom-name">Người bán </span>

                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="edit-bars-footer">
                    <div class="d-flex align-items-center justify-content-between">
                        <button type="button" class="btn-themes nocolor-btn">
                            <span>Khôi phục cài đặt mặc định</span>
                        </button>
                        <button type="button" class="btn-themes nocolor-btn">
                            <span>Hủy</span>
                        </button>
                        <button type="button" class="btn-themes color-btn">
                            <span>Thêm</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js_bot_all')
    <script>
        var api = {
            fetch: '{{ route('ajax.orders.index') }}'
        }

        function showFilterBars() {
            $('#fixed-filter-bars').addClass('opened');
        }

        function closeFilterBars() {
            $('#fixed-filter-bars').removeClass('opened');
        }

        function showEditBars() {
            $('#fixed-edit-bars').addClass('opened');
        }

        function closeEditBars() {
            $('#fixed-edit-bars').removeClass('opened');
        }
        $(document).ready(function() {
            $('.js-customdropdown-holder').on('click', function(e) {
                e.stopPropagation();
                $(this).find('.js-customdropdown-parent').slideToggle(200);
            })
            $('.js-show-sortby').on('click', function(e) {
                e.stopPropagation();
                $(this).parent().find('.js-sortby-content').slideToggle(200);
            })
            $('.js-customdropdown-item').on('click', function(e) {
                e.stopPropagation();
                let text = $(this).text();
                $(this).parents('.js-customdropdown-holder').find('.js-customdropdown-value').text(text);
            })

            $('input[name="datetimes"]').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(24, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });


            $(document).mousedown(function(n) {
                n.stopPropagation();
                if (!$(n.target).parents().hasClass("js-customdropdown-holder")) {
                    $('.js-customdropdown-parent').slideUp();
                }
                if (!$(n.target).parents().hasClass("sortby-status")) {
                    $('.js-sortby-content').slideUp();
                }
            });
        })
    </script>
    <script src="{{ asset('js/pages/orders.js') }}?v={{ $settings['other']['version'] }}"></script>
@endpush
