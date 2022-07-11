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
                <a class="nav-link" id="waiting-print-tab" data-toggle="tab" href="#waiting-print" role="tab"
                    aria-controls="waiting-print" aria-selected="false">
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
                <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done"
                    aria-selected="false">
                    Đã hoàn tất
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="saved-tab" data-toggle="tab" href="#saved" role="tab" aria-controls="saved"
                    aria-selected="false">
                    Lưu trữ
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="sender" role="tabpanel" aria-labelledby="sender-tab">
                <div class="admin-card-row justify-content-between">
                    <div class="col-8">
                        <div class="admin-card-row mt-16">
                            <div class="search-box mb-16 mr-16">
                                <span class="search-box-wrap">
                                    <div class="keysuggest">
                                        <div class="keysuggest-dropdown js-customdropdown-holder">
                                            <span class="admin-select-selection-item js-customdropdown-value">Từ
                                                khóa</span>
                                            <div class="keysuggest-dropdown-menu js-customdropdown-parent">
                                                <a class="keysuggest-item js-customdropdown-item" href="javascript:;">Từ
                                                    khóa</a>
                                                <a class="keysuggest-item js-customdropdown-item"
                                                    href="javascript:;">Tìm kiếm đa nguồn</a>
                                                <a class="keysuggest-item js-customdropdown-item" href="javascript:;">Số
                                                    diện thoại người nhận</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="keyinput">
                                        <span class="search-input">
                                            <input
                                                placeholder="Tìm kiếm mã đơn hàng/thông tin đơn hàng/sản phẩm/thông tin người nhận/ghi chú"
                                                class="admin-form-input" type="text" value="" />
                                            <span class="icon-svg">
                                                <span role="img" tabindex="-1" class="anticon searchBtn-fXszSa">
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
                                            <span class="admin-select-selection-item js-customdropdown-value">Mọi
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
                            {{-- <div class="sortby-status mb-16 mr-16">
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
                            </div> --}}
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
                            {{-- <a href="javascript:;" class="mb-16 mr-16">
                                <span class="admin-form-input">
                                    Quản lý thẻ tùy chỉnh
                                </span>
                            </a> --}}
                            <div class="filter-dropdown js-customdropdown-holder mb-16 mr-16">
                                <span class="admin-select-selection-item js-customdropdown-value">Lọc</span>
                                <div class="filter-dropdown-menu js-customdropdown-parent" style="display: none;">
                                    <a class="filter-item-dropdown js-customdropdown-item" href="javascript:;">Lọc
                                        theo</a>
                                    <a class="filter-item-dropdown js-customdropdown-item" href="javascript:;">Thời
                                        gian tạo ( từ mới đến cũ )</a>
                                    <a class="filter-item-dropdown js-customdropdown-item" href="javascript:;">Thời
                                        gian tạo ( từ cũ đến mới )</a>
                                    <a class="filter-item-dropdown js-customdropdown-item" href="javascript:;">Mã đơn
                                        hàng ( giảm dần )</a>
                                    <a class="filter-item-dropdown js-customdropdown-item" href="javascript:;">Mã đơn
                                        hàng ( tăng dần )</a>
                                    <a class="filter-item-dropdown js-customdropdown-item" href="javascript:;">Tên
                                        người nhận (Z-A)</a>
                                    <a class="filter-item-dropdown js-customdropdown-item" href="javascript:;">Tên
                                        người nhận (A-Z)</a>
                                </div>
                            </div>
                            {{-- <a href="javascript:;" class="javascript:;" onclick="showEditBars();">
                                <span class="admin-form-input">
                                    Chỉnh sửa tiêu đề
                                </span>
                            </a> --}}
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
                        {{-- <div style="flex : 1 1 0% ; " class="ml-2">
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
                        </div> --}}
                        {{-- <div style="flex: 0 0 72px ; max-width : 72px; margin-left : auto ;">
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
                        </div> --}}
                    </div>
                </div>
                @include('frontend::order.sections.list.table')
            </div>
            <div class="tab-pane fade" id="receiver" role="tabpanel" aria-labelledby="receiver-tab">
            </div>
        </div>
    </div>
</div>
