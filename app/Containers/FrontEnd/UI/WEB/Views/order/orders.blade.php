@extends('basecontainer::frontend.pc.layouts.home')
@section('content')
    <div class="admin-main-layout">
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
                <div class="position-relative">
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
                                                    <div class="sortby-status-dropdown ">
                                                        <a class="" href="javascript:;">
                                                            <span class="admin-select-selection-item admin-form-input">
                                                                Trạng thái đơn hàng
                                                                <span role="img" class="icon-svg"><svg class=""
                                                                        aria-hidden="true">
                                                                        <use xlink:href="#icon-Filter"></use>
                                                                    </svg></span>
                                                            </span>
                                                        </a>
                                                        <div class="sortby-status-dropdown-menu ">
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
                                                    <div class="sortby-status-dropdown ">
                                                        <a class="" href="javascript:;">
                                                            <span class="admin-select-selection-item admin-form-input">
                                                                Trạng thái vận chuyển
                                                                <span role="img" class="icon-svg"><svg class=""
                                                                        aria-hidden="true">
                                                                        <use xlink:href="#icon-Filter"></use>
                                                                    </svg></span>
                                                            </span>
                                                        </a>
                                                        <div class="sortby-status-dropdown-menu ">
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
                                        <a href="javascript:;" class="mb-16 mr-16">
                                            <span class="admin-form-input">
                                                Lọc
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
                                        <a href="javascript:;" class="mb-16 mr-16">
                                            <span class="admin-form-input">
                                                Lọc
                                            </span>
                                        </a>
                                    </div>
                                    <div class="d-flex justify-content-end mt-16">
                                        <a href="javascript:;"
                                            class="\">
                                            <span class="admin-form-input">
                                            Chỉnh sửa tiêu đề
                                            </span>
                                        </a>
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
@endsection
