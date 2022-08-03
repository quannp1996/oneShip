@extends('basecontainer::frontend.pc.layouts.home')

@section('content')
    <div class="admin-main-layout">
        <div class="admin-main-container">
            <div class="admin-card">
                <div class="admin-card-body">
                    <div class="text-center title">
                        🔥🔥🔥NHẬN NGAY 200.000VND VÀO VÍ🔥🔥🔥🔥
                    </div>
                    <div class="content-nd py-3 text-center">
                        Hi Oneshiper, Bạn biết Oneship có gì mới chưa?! Oneship đang có chương trình khuyến
                        mãi<br />
                        🔔🔔🔔 Khách hàng tạo tài khoản mới sẽ 🆘NHẬN NGAY 200.000vnd 🆘vào tài khoản khi hoàn tất
                        cung cấp thông tin tại
                        <a href="javascript:;" target="_blank">đây</a><br />
                        🔔🔔🔔 Thời gian áp dụng từ ngày 13.05.2022 cho đến khi có thông báo tiếp theo.<br />
                        <br />
                        Ngoài ra, Oneship bạn có thể:<br />
                        💥Liên kết tài khoản vận chuyển riêng với Oneship để đi đơn.<br />
                        💥Cài đặt thông báo tình trạng đơn hàng qua Email hoặc tin nhắn<br />
                        💥Chủ động kiểm tra tình trạng đơn hàng cho vận đơn mà bạn đang có<br />
                        Hãy liên hệ với OneShip qua tin nhắn tại góc trái màn hình, nếu bạn có thắc mắc hoặc cần hỗ
                        trợ nhé!
                    </div>
                </div>
            </div>
            <div class="admin-card">
                <div class="admin-card-body p-0">

                    <div class="admin-card-row">
                        <div class="col-7">
                            <div class="left-created-order">
                                <div class="title">
                                    Tạo hoặc nhập đơn hàng
                                </div>
                                <p class="desc">
                                    Hãy tạo đơn giao hàng đầu tiên. Trải nghiệm dịch vụ vận chuyển đa kênh cùng
                                    OneShip!
                                </p>
                                <div>
                                    <button type="button" class="color-btn btn-themes"><span>Tạo đơn
                                            hàng</span></button>
                                    <button type="button" class="nocolor-btn btn-themes"><span>Tạo hàng
                                            loạt</span></button>
                                </div>

                            </div>
                        </div>
                        <div class="col-4">
                            <div class="right-created-order">
                                <img src="images/img-right.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="admin-card">
                <div class="admin-card-body p-0">
                    <div class="admin-card-head">
                        <div class="admin-card-head-wrapper">
                            <div class="admin-card-head-title">Số lượng vận đơn (0)</div>
                            <div class="admin-card-extra">
                                <span class="admin-dropdown-trigger">
                                    <span>2022/05/10~2022/06/08</span>
                                    <svg class="svg-arrow" focusable="false" viewBox="0 0 24 24" aria-hidden="true"
                                        style="font-size: 16px;">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4.36321 7.86321C4.71469 7.51174 5.28453 7.51174 5.63601 7.86321L11.9996 14.2268L18.3632 7.86321C18.7147 7.51174 19.2845 7.51174 19.636 7.86321C19.9875 8.21469 19.9875 8.78453 19.636 9.13601L12.636 16.136C12.2845 16.4875 11.7147 16.4875 11.3632 16.136L4.36321 9.13601C4.01174 8.78453 4.01174 8.21469 4.36321 7.86321Z"
                                            fill="#00112F"></path>
                                    </svg>
                                </span>
                                <div class="admin-dropdown-trigger-content">
                                    <ul class="list-unstyled p-0 m-0">
                                        <li class="item">
                                            <div class="custom-radio-input">
                                                <input type="radio" id="type1" value="1" name="form_check" checked>
                                                <label for="type1">
                                                    <span class="icon-radio"></span>
                                                    30 ngày qua
                                                </label>
                                            </div>
                                        </li>
                                        <li class="item">
                                            <div class="custom-radio-input">
                                                <input type="radio" id="type2" value="2" name="form_check">
                                                <label for="type2">
                                                    <span class="icon-radio"></span>
                                                    60 ngày qua
                                                </label>
                                            </div>
                                        </li>
                                        <li class="item">
                                            <div class="custom-radio-input">
                                                <input type="radio" id="type3" value="3" name="form_check">
                                                <label for="type3">
                                                    <span class="icon-radio"></span>
                                                    90 ngày qua
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="admin-card-body ">
                    <div class="d-flex ">
                        <div class="item pt-10 col-20">
                            <p class="value text-24 lh-32 mb-0">
                                0
                            </p>
                            <p class="label text-415066 mb-0 text-12">
                                Đợi giao hàng đi
                            </p>
                        </div>
                        <div class="item pt-10 col-20">
                            <p class="value text-24 lh-32 mb-0">
                                0
                            </p>
                            <p class="label text-415066 mb-0 text-12">
                                Đợi lấy hàng
                            </p>
                        </div>
                        <div class="item pt-10 col-20">
                            <p class="value text-24 lh-32 mb-0">
                                0
                            </p>
                            <p class="label text-415066 mb-0 text-12">
                                Đang giao
                            </p>
                        </div>
                        <div class="item pt-10 col-20">
                            <p class="value text-24 lh-32 mb-0">
                                0
                            </p>
                            <p class="label text-415066 mb-0 text-12">
                                Hoàn thành
                            </p>
                        </div>
                        <div class="item pt-10 col-20">
                            <p class="value text-24 lh-32 mb-0">
                                0
                            </p>
                            <p class="label text-415066 mb-0 text-12">
                                Trả lại hàng
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="admin-card">
                <div class="admin-card-body p-0">
                    <div class="admin-card-head">
                        <div class="admin-card-head-wrapper">
                            <div class="admin-card-head-title">Số lượng đơn hàng（0）</div>
                            <div class="admin-card-extra">
                                <span class="admin-dropdown-trigger">
                                    <span>2022/05/10~2022/06/08</span>
                                    <svg class="svg-arrow" focusable="false" viewBox="0 0 24 24" aria-hidden="true"
                                        style="font-size: 16px;">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4.36321 7.86321C4.71469 7.51174 5.28453 7.51174 5.63601 7.86321L11.9996 14.2268L18.3632 7.86321C18.7147 7.51174 19.2845 7.51174 19.636 7.86321C19.9875 8.21469 19.9875 8.78453 19.636 9.13601L12.636 16.136C12.2845 16.4875 11.7147 16.4875 11.3632 16.136L4.36321 9.13601C4.01174 8.78453 4.01174 8.21469 4.36321 7.86321Z"
                                            fill="#00112F"></path>
                                    </svg>
                                </span>
                                <div class="admin-dropdown-trigger-content">
                                    <ul class="list-unstyled p-0 m-0">
                                        <li class="item">
                                            <div class="custom-radio-input">
                                                <input type="radio" id="type1" value="1" name="form_check" checked>
                                                <label for="type1">
                                                    <span class="icon-radio"></span>
                                                    30 ngày qua
                                                </label>
                                            </div>
                                        </li>
                                        <li class="item">
                                            <div class="custom-radio-input">
                                                <input type="radio" id="type2" value="2" name="form_check">
                                                <label for="type2">
                                                    <span class="icon-radio"></span>
                                                    60 ngày qua
                                                </label>
                                            </div>
                                        </li>
                                        <li class="item">
                                            <div class="custom-radio-input">
                                                <input type="radio" id="type3" value="3" name="form_check">
                                                <label for="type3">
                                                    <span class="icon-radio"></span>
                                                    90 ngày qua
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="admin-card-body ">
                    <div class="d-flex ">
                        <div class="item pt-10 col-20">
                            <p class="value text-24 lh-32 mb-0">
                                0
                            </p>
                            <p class="label text-415066 mb-0 text-12">
                                Đợi giao hàng đi
                            </p>
                        </div>
                        <div class="item pt-10 col-20">
                            <p class="value text-24 lh-32 mb-0">
                                0
                            </p>
                            <p class="label text-415066 mb-0 text-12">
                                Đợi lấy hàng
                            </p>
                        </div>
                        <div class="item pt-10 col-20">
                            <p class="value text-24 lh-32 mb-0">
                                0
                            </p>
                            <p class="label text-415066 mb-0 text-12">
                                Đang giao
                            </p>
                        </div>
                        <div class="item pt-10 col-20">
                            <p class="value text-24 lh-32 mb-0">
                                0
                            </p>
                            <p class="label text-415066 mb-0 text-12">
                                Hoàn thành
                            </p>
                        </div>
                        <div class="item pt-10 col-20">
                            <p class="value text-24 lh-32 mb-0">
                                0
                            </p>
                            <p class="label text-415066 mb-0 text-12">
                                Trả lại hàng
                            </p>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
@push('js_bot_all')
    <script>
        
    </script>
@endpush