<header>
    <div class="admin-header-wrap">
        <a href="javascript:;" class="logo">
            <img style="width: 100px; height: 30px;" src="{{ ImageUrl::getImageUrl($settings['website']['logo'], 'setting', 'original') }}" alt="" class="img-fluid">
        </a>
        <div class="header-right">
            {{-- <div class="header-noti header-right-item">
                <span class="header-noti-icon">
                    <svg class="" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 1.88672C12.4971 1.88672 12.9 2.28966 12.9 2.78672V4.35286C14.2937 4.54743 15.5958 5.19021 16.6023 6.19666C17.8228 7.41724 18.5086 9.07271 18.5086 10.7989V14.8049C18.5086 15.2037 18.667 15.5862 18.949 15.8682C19.2309 16.1502 19.6134 16.3086 20.0122 16.3086C20.5093 16.3086 20.9122 16.7115 20.9122 17.2086C20.9122 17.7057 20.5093 18.1086 20.0122 18.1086H3.98789C3.49083 18.1086 3.08789 17.7057 3.08789 17.2086C3.08789 16.7115 3.49083 16.3086 3.98789 16.3086C4.38668 16.3086 4.76914 16.1502 5.05113 15.8682C5.33312 15.5862 5.49154 15.2037 5.49154 14.8049V10.7989C5.49154 9.07271 6.17725 7.41724 7.39783 6.19666C8.40428 5.19021 9.70641 4.54743 11.1 4.35286V2.78672C11.1 2.28966 11.503 1.88672 12 1.88672ZM6.92951 16.3086H17.0706C16.8348 15.8473 16.7086 15.3326 16.7086 14.8049V10.7989C16.7086 9.5501 16.2125 8.35247 15.3295 7.46945C14.4464 6.58644 13.2488 6.09036 12 6.09036C10.7513 6.09036 9.55364 6.58644 8.67063 7.46945C7.78761 8.35247 7.29154 9.5501 7.29154 10.7989V14.8049C7.29154 15.3326 7.16529 15.8473 6.92951 16.3086ZM10.1623 19.635C10.5923 19.3855 11.143 19.5319 11.3924 19.9619C11.4542 20.0683 11.5428 20.1567 11.6495 20.2181C11.7561 20.2795 11.877 20.3118 12 20.3118C12.1231 20.3118 12.244 20.2795 12.3506 20.2181C12.4573 20.1567 12.5459 20.0683 12.6076 19.9619C12.8571 19.5319 13.4078 19.3855 13.8377 19.635C14.2677 19.8844 14.4141 20.4351 14.1646 20.8651C13.9447 21.2443 13.6289 21.559 13.249 21.7778C12.8692 21.9967 12.4384 22.1118 12 22.1118C11.5616 22.1118 11.1309 21.9967 10.751 21.7778C10.3712 21.559 10.0554 21.2443 9.83544 20.8651C9.58603 20.4351 9.73239 19.8844 10.1623 19.635Z">
                        </path>
                    </svg>
                </span>
                <sup class="count">
                    1
                </sup>
            </div>
            <div class="header-download header-right-item">
                <span class="header-download-icon">
                    <svg class="" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M9.42344 3.15008C10.4934 3.1116 11.5582 3.31636 12.5376 3.74893C13.517 4.1815 14.3855 4.83062 15.0777 5.64742C15.6182 6.28524 16.0403 7.01233 16.326 7.79417C17.3177 7.82027 18.4287 7.95988 19.4495 8.70669C20.2664 9.30427 20.8716 10.1466 21.1773 11.1114C21.483 12.0763 21.4732 13.1134 21.1495 14.0724C20.8258 15.0313 20.205 15.8622 19.3771 16.4444C18.9705 16.7303 18.4091 16.6324 18.1232 16.2259C17.8373 15.8193 17.9351 15.2579 18.3417 14.972C18.8566 14.6099 19.2428 14.0931 19.4441 13.4967C19.6454 12.9003 19.6515 12.2552 19.4613 11.6551C19.2712 11.055 18.8948 10.5311 18.3867 10.1595C17.6645 9.63106 16.8531 9.58816 15.6622 9.58816C15.2513 9.58816 14.8925 9.30986 14.7904 8.91185C14.592 8.13851 14.2207 7.42026 13.7045 6.81118C13.1883 6.20209 12.5407 5.71805 11.8103 5.39548C11.08 5.07291 10.286 4.92022 9.48813 4.94892C8.69025 4.97761 7.90928 5.18693 7.204 5.56113C6.49873 5.93533 5.88753 6.46464 5.41643 7.10923C4.94532 7.75382 4.62658 8.49688 4.48421 9.28248C4.34184 10.0681 4.37954 10.8757 4.59447 11.6447C4.80941 12.4136 5.19598 13.1237 5.72508 13.7216C6.05448 14.0939 6.01976 14.6626 5.64752 14.992C5.27529 15.3215 4.7065 15.2867 4.37709 14.9145C3.66756 14.1127 3.14916 13.1604 2.86092 12.1292C2.57269 11.0981 2.52214 10.015 2.71306 8.9615C2.90399 7.90799 3.33142 6.91152 3.96319 6.04711C4.59495 5.18271 5.41458 4.47288 6.36037 3.97107C7.30616 3.46927 8.35346 3.18856 9.42344 3.15008ZM12.0016 12.105C12.4986 12.105 12.9016 12.5079 12.9016 13.005V17.7827L14.4543 16.23C14.8058 15.8785 15.3756 15.8785 15.7271 16.23C16.0785 16.5814 16.0785 17.1513 15.7271 17.5028L12.638 20.5919C12.2865 20.9433 11.7167 20.9433 11.3652 20.5919L8.27607 17.5028C7.9246 17.1513 7.9246 16.5814 8.27607 16.23C8.62754 15.8785 9.19739 15.8785 9.54886 16.23L11.1016 17.7827V13.005C11.1016 12.5079 11.5045 12.105 12.0016 12.105Z">
                        </path>
                    </svg>
                </span>
            </div>
            <div class="header-currency header-right-item">
                <span class="header-currency-icon">
                    <svg class="" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.14163 6.04219C4.69583 6.04219 4.32734 6.41067 4.32734 6.85647V8.09961H19.6702V6.85647C19.6702 6.41067 19.3017 6.04219 18.8559 6.04219H5.14163ZM19.6702 9.89961H4.32734V17.1422C4.32734 17.588 4.69583 17.9565 5.14163 17.9565H18.8559C19.3017 17.9565 19.6702 17.588 19.6702 17.1422V9.89961ZM2.52734 6.85647C2.52734 5.41656 3.70172 4.24219 5.14163 4.24219H18.8559C20.2958 4.24219 21.4702 5.41656 21.4702 6.85647V17.1422C21.4702 18.5821 20.2958 19.7565 18.8559 19.7565H5.14163C3.70172 19.7565 2.52734 18.5821 2.52734 17.1422V6.85647ZM14.0996 14.9996C14.0996 14.5026 14.5026 14.0996 14.9996 14.0996H16.9996C17.4967 14.0996 17.8996 14.5026 17.8996 14.9996C17.8996 15.4967 17.4967 15.8996 16.9996 15.8996H14.9996C14.5026 15.8996 14.0996 15.4967 14.0996 14.9996Z">
                        </path>
                    </svg>
                </span>
                <span class="currency-value">
                    VND : 0
                </span>
            </div> --}}
            <div class="header-user header-right-item">
                <a class="header-user-info" href="javascript:;" data-toggle-user="">
                    <span class="ava-img">
                        <svg class="" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                            <g clip-path="url(#clip93)">
                                <path
                                    d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z"
                                    fill="#EDF1F6"></path>
                                <circle cx="12" cy="23" r="10" fill="#CFD9E4"></circle>
                                <circle cx="12" cy="10" r="6" fill="#CFD9E4" stroke="#EDF1F6"
                                    stroke-width="2">
                                </circle>
                            </g>
                            <defs>
                                <clipPath id="clip93">
                                    <path
                                        d="M0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12Z"
                                        fill="white"></path>
                                </clipPath>
                            </defs>
                        </svg>
                    </span>
                    <span class="user-name">{{ @$user->fullname }}</span>
                    <i class="arrow">
                        <svg class="" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.36321 7.86321C4.71469 7.51174 5.28453 7.51174 5.63601 7.86321L11.9996 14.2268L18.3632 7.86321C18.7147 7.51174 19.2845 7.51174 19.636 7.86321C19.9875 8.21469 19.9875 8.78453 19.636 9.13601L12.636 16.136C12.2845 16.4875 11.7147 16.4875 11.3632 16.136L4.36321 9.13601C4.01174 8.78453 4.01174 8.21469 4.36321 7.86321Z"
                                fill="#00112F"></path>
                        </svg>
                    </i>
                    <div class="sortby-status-dropdown-menu js-sortby-content">
                        <div class="d-flex ">
                            <div class="">
                                <div class="title">Trạng thái đơn hàng</div>
                                <div class="d-flex flex-column">
                                    <label class="checkbox-custom" for="id-1">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-1">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Đã tạo
                                        </span>

                                    </label>
                                    <label class="checkbox-custom" for="id-2">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-2">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Đã hoàn tất
                                        </span>

                                    </label>
                                    <label class="checkbox-custom" for="id-3">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-3">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Bị hủy
                                        </span>

                                    </label>
                                    <label class="checkbox-custom" for="id-4">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-4">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Hủy </span>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="header-user-dropdown">

                </div>
            </div>
        </div>
    </div>
</header>
@push('js_bot_all')
@endpush
