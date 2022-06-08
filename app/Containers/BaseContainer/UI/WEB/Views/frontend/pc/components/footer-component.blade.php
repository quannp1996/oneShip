<footer>
    <div class="container">
        <div class="footer-wrapper">
            <div class="left">
                <a href="javascript:;" class="logo-footer">
                    <img src="{{ ImageURL::getImageUrl($settings['website']['logo'], 'setting', '') }}" alt="">
                </a>
                <h3 class="footer-title">
                    CÔNG TY TNHH SHOPLINE VIETNAM
                </h3>
                <div class="footer-addrs">
                    <div class="item">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="100%" height="100%" viewBox="0 0 24 24" fill="rgba(255,255,255,1)">
                                <path d="M10,20V14H14V20H19V12H22L12,3L2,12H5V20H10Z"></path>
                            </svg>
                        </span>
                        {{ $settings['website']['address'] }}
                    </div>
                    <div class="item">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"
                                preserveAspectRatio="none" viewBox="0 0 1536 1896.0833" class=""
                                fill="rgba(255,255,255,1)">
                                <path
                                    d="M1023 960h316q-1-3-2.5-8t-2.5-8l-212-496H414L202 944q-1 2-2.5 8t-2.5 8h316l95 192h320zm513 30v482q0 26-19 45t-45 19H64q-26 0-45-19t-19-45V990q0-62 25-123l238-552q10-25 36.5-42t52.5-17h832q26 0 52.5 17t36.5 42l238 552q25 61 25 123z">
                                </path>
                            </svg>
                        </span>
                        Số ĐKKD: 0316320302 cấp lần đầu ngày 15/06/2020 tại Sở Kế hoạch và Đầu tư TP. HCM.
                    </div>
                    <div class="item">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="100%" height="100%" viewBox="0 0 24 24" fill="rgba(255,255,255,1)">
                                <path
                                    d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z">
                                </path>
                            </svg>
                        </span>
                        {{ $settings['contact']['hotline'] }}
                    </div>
                </div>
            </div>
            <div class="right">
                <h3 class="footer-title">
                    LIÊN KẾT
                </h3>
                <a href="javascript:;" class="footer-link">
                    Đăng nhập hệ thống
                </a>
                <a href="javascript:;" class="footer-link">
                    Điều khoản sử dụng
                </a>
                <a href="javascript:;" class="footer-link">
                    Chính sách quyền riêng tư
                </a>
            </div>
        </div>
    </div>
</footer>
