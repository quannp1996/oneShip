<div class="log-header">
    @if (auth('customer')->check())
        <span class="logged">
            <div class="member">
                <img class="avatar" src="{{ auth('customer')->user()->getAvatarImage() }}" alt="" />
                <span class="name">
                    {{ auth('customer')->user()->fullname }}
                </span>
            </div>

            <div class="manage">
                <div class="user-option">
                    <a href="javascript:;" title="" class="active">
                        <img src="{{ asset('template/images/ic-user-1.svg') }}" class="normal" alt="" />
                        <img src="{{ asset('template/images/ic-user-active-1.svg') }}" alt="" class="active" />
                        Thông tin tài khoản
                    </a>
                    <a href="javascript:;" title="">
                        <img src="{{ asset('template/images/ic-user-2.svg') }}" class="normal" alt="" />
                        <img src="{{ asset('template/images/ic-user-active-2.svg') }}" alt=""
                            class="active" />
                        Thay đổi mật khẩu
                    </a>
                    <a href="javascript:;" title="">
                        <img src="{{ asset('template/images/ic-user-3.svg') }}" class="normal" alt="" />
                        <img src="{{ asset('template/images/ic-user-active-3.svg') }}" alt=""
                            class="active" />
                        Trạng thái đơn hàng
                    </a>
                    <a href="{{ route('web_logout_customer') }}" title="">
                        <img src="{{ asset('template/images/ic-user-4.svg') }}" class="normal" alt="" />
                        <img src="{{ asset('template/images/ic-user-active-4.svg') }}" alt=""
                            class="active" />
                        Đăng xuất
                    </a>
                </div>
            </div>
        </span>
    @else
        <a href="{{ route('web_register_page') }}" title="" class="register">Đăng ký</a>
        <a href="{{ route('web_login_page') }}" title="" class="login">Đăng nhập</a>
    @endif
</div>
