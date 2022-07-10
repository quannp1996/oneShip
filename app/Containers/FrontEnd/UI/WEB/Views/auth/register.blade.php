@extends('basecontainer::frontend.pc.layouts.un_author')

@section('content')
    <div class="register-page" id="registerVUE">
        <div class="left">
            <img src="{{ asset('template/images/register-bg.jpg') }}" alt="" class="img-fluid left-bg">
            <div class="left-title">
                <img src="{{ asset('template/images/logo.svg') }}" alt="" class="img-fluid">
                <div class="logo-desc">Giao hàng All-in-One</div>
            </div>
        </div>
        <div class="right">
            <div class="language">
                <div class="dropdown">
                    <button class="lang-active dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span role="img" class="anticon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" class="">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.28379 4.22348C7.1908 3.99849 6.97109 3.85199 6.72764 3.85266C6.4842 3.85333 6.26529 4.00103 6.17353 4.22652L4.92446 7.29622L4.31173 8.73695C4.18204 9.04189 4.32411 9.39423 4.62905 9.52391C4.93399 9.6536 5.28633 9.51153 5.41601 9.20659L5.87527 8.12671H7.60806L8.08534 9.21311C8.21863 9.51649 8.57262 9.65438 8.876 9.5211C9.17939 9.38781 9.31728 9.03382 9.18399 8.73044L8.5518 7.29143L7.28379 4.22348ZM7.1026 6.92671H6.37035L6.73362 6.03396L7.1026 6.92671Z"
                                    fill="#415066"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M1.63147 3.20654C1.63147 2.33665 2.33665 1.63147 3.20654 1.63147H10.3174C11.1873 1.63147 11.8925 2.33665 11.8925 3.20654V10.3174C11.8925 11.1873 11.1873 11.8925 10.3174 11.8925H3.20654C2.33665 11.8925 1.63147 11.1873 1.63147 10.3174V3.20654ZM3.20654 2.74992C2.95435 2.74992 2.74992 2.95435 2.74992 3.20654V10.3174C2.74992 10.5696 2.95435 10.774 3.20654 10.774H10.3174C10.5696 10.774 10.7741 10.5696 10.7741 10.3174V3.20654C10.7741 2.95435 10.5696 2.74992 10.3174 2.74992H3.20654Z"
                                    fill="#415066"></path>
                                <path
                                    d="M14.0004 6.73327C14.3318 6.73327 14.6004 7.0019 14.6004 7.33327V11.6673C14.6004 13.2873 13.2871 14.6006 11.6671 14.6006H7.28054C6.94917 14.6006 6.68054 14.332 6.68054 14.0006C6.68054 13.6692 6.94917 13.4006 7.28054 13.4006H11.6671C12.6244 13.4006 13.4004 12.6245 13.4004 11.6673V7.33327C13.4004 7.0019 13.6691 6.73327 14.0004 6.73327Z"
                                    fill="#415066"></path>
                            </svg>
                        </span>
                        Tiếng Việt
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">English</a>
                        <a class="dropdown-item" href="#">Tiếng Việt</a>
                        <a class="dropdown-item" href="#">Chinese</a>
                    </div>
                </div>
            </div>
            <div class="register-box">
                <form action="{{ route('web_regiser_post') }}" method="POST" id="register_form"
                    @submit.prevent="sendRegister()">
                    <div class="title">
                        Đăng ký
                    </div>
                    {{-- <div class="form-group">
                        <div class="dropdown dropdown-country">
                            <button class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="dropdown-country-input">
                                    <input type="hidden" class="" placeholder="" value="" id="">
                                    <small class="label-helper">
                                        Quốc gia/Vùng
                                    </small>
                                    <span class="current-country"> Việt Nam </span>
                                </div>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">English</a>
                                <a class="dropdown-item" href="#">Tiếng Việt</a>
                                <a class="dropdown-item" href="#">Chinese</a>
                            </div>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <div class="custom-form-input">
                            <input type="text" class="input-text" v-model="form.email" placeholder="Email" value=""
                                id="">
                            <small class="label-helper">
                                Email
                            </small>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <div class="custom-form-input custom-form-code">
                            <input type="text" class="input-text input-disabled" disabled placeholder="Mã xác nhận" value=""
                                id="">
                            <small class="label-helper">
                                Mã xác nhận
                            </small>
                            <a href="javascript:;" class="send-code">
                                Gửi
                            </a>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <div class="custom-form-input custom-form-password">
                            <input type="password" class="input-text" v-model="form.password" placeholder="Mật khẩu"
                                value="" id="">
                            <small class="label-helper">
                                Mật khẩu
                            </small>
                            <a href="javascript:;" class="view-password">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-custom">
                            <span class="checkbox-custom-input">
                                <input type="checkbox" v-model="form.accpect" class="d-none" value="" />
                                <span class="checkbox-custom-icon"></span>
                            </span>
                            <span class="checkbox-custom-name">Tôi đồng ý với </span>

                        </label>
                        <a class="link text-theme" href="javascript:;" data-toggle="modal"
                            data-target="#modalDieuKien">《Điều kiện》</a>
                        &
                        <a class="link text-theme" href="javascript:;" data-toggle="modal" data-target="#modalChinhsach">《
                            Chính sách quyền riêng tư》</a>
                    </div>
                    <div class="form-group">
                        <button color="primary" type="submit" class="btn btn-theme login-btn"><span>Đăng ký</span></button>
                    </div>
                </form>
                <!-- Modal -->
                <div class="modal fade" id="modalDieuKien" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-scroll">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-body ">
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.
                                        Voluptatem, cum quis laudantium itaque odio fugiat eaque vel reprehenderit aut
                                        optio, doloremque voluptas suscipit praesentium sapiente nesciunt. Impedit, magni!
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus deserunt odit,
                                        exercitationem a maiores eligendi iusto natus laudantium amet sequi animi, aliquam
                                        doloremque tempore illum quae corporis modi delectus soluta.
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.
                                        Voluptatem, cum quis laudantium itaque odio fugiat eaque vel reprehenderit aut
                                        optio, doloremque voluptas suscipit praesentium sapiente nesciunt. Impedit, magni!
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus deserunt odit,
                                        exercitationem a maiores eligendi iusto natus laudantium amet sequi animi, aliquam
                                        doloremque tempore illum quae corporis modi delectus soluta.
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.
                                        Voluptatem, cum quis laudantium itaque odio fugiat eaque vel reprehenderit aut
                                        optio, doloremque voluptas suscipit praesentium sapiente nesciunt. Impedit, magni!
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus deserunt odit,
                                        exercitationem a maiores eligendi iusto natus laudantium amet sequi animi, aliquam
                                        doloremque tempore illum quae corporis modi delectus soluta.
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.
                                        Voluptatem, cum quis laudantium itaque odio fugiat eaque vel reprehenderit aut
                                        optio, doloremque voluptas suscipit praesentium sapiente nesciunt. Impedit, magni!
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus deserunt odit,
                                        exercitationem a maiores eligendi iusto natus laudantium amet sequi animi, aliquam
                                        doloremque tempore illum quae corporis modi delectus soluta.
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.
                                        Voluptatem, cum quis laudantium itaque odio fugiat eaque vel reprehenderit aut
                                        optio, doloremque voluptas suscipit praesentium sapiente nesciunt. Impedit, magni!
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus deserunt odit,
                                        exercitationem a maiores eligendi iusto natus laudantium amet sequi animi, aliquam
                                        doloremque tempore illum quae corporis modi delectus soluta.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modalChinhsach" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-scroll">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="modal-body ">
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.
                                        Voluptatem, cum quis laudantium itaque odio fugiat eaque vel reprehenderit aut
                                        optio, doloremque voluptas suscipit praesentium sapiente nesciunt. Impedit, magni!
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus deserunt odit,
                                        exercitationem a maiores eligendi iusto natus laudantium amet sequi animi, aliquam
                                        doloremque tempore illum quae corporis modi delectus soluta.
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.
                                        Voluptatem, cum quis laudantium itaque odio fugiat eaque vel reprehenderit aut
                                        optio, doloremque voluptas suscipit praesentium sapiente nesciunt. Impedit, magni!
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus deserunt odit,
                                        exercitationem a maiores eligendi iusto natus laudantium amet sequi animi, aliquam
                                        doloremque tempore illum quae corporis modi delectus soluta.
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.
                                        Voluptatem, cum quis laudantium itaque odio fugiat eaque vel reprehenderit aut
                                        optio, doloremque voluptas suscipit praesentium sapiente nesciunt. Impedit, magni!
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus deserunt odit,
                                        exercitationem a maiores eligendi iusto natus laudantium amet sequi animi, aliquam
                                        doloremque tempore illum quae corporis modi delectus soluta.
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.
                                        Voluptatem, cum quis laudantium itaque odio fugiat eaque vel reprehenderit aut
                                        optio, doloremque voluptas suscipit praesentium sapiente nesciunt. Impedit, magni!
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus deserunt odit,
                                        exercitationem a maiores eligendi iusto natus laudantium amet sequi animi, aliquam
                                        doloremque tempore illum quae corporis modi delectus soluta.
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis, assumenda.
                                        Voluptatem, cum quis laudantium itaque odio fugiat eaque vel reprehenderit aut
                                        optio, doloremque voluptas suscipit praesentium sapiente nesciunt. Impedit, magni!
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus deserunt odit,
                                        exercitationem a maiores eligendi iusto natus laudantium amet sequi animi, aliquam
                                        doloremque tempore illum quae corporis modi delectus soluta.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="line-warp">
                        <span class="line line-left"></span>
                        <span class="text">hoặc</span>
                        <span class="line line-right"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="social-login">
                        <a href="javascript:;">
                            <img src="{{ asset('template/images/ic-fb.svg') }}" alt="" class="img-fluid">
                        </a>
                        <a href="javascript:;">
                            <img src="{{ asset('template/images/ic-google.svg') }}" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex align-items-center justify-content-center pb-4">
                        <span class="">
                            Bạn đã có tài khoản ?
                        </span>
                        <a href="{{ route('web_login_index') }}" class="text-theme ml-1"> Đăng nhập </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js_bot_all')
    <script>
        const api = {
            register: '{{ route('web_regiser_post') }}'
        }
    </script>
    <script src="{{ asset('template/js/jquery-3.4.1.js') }}"></script>
    <script src="{{ asset('template/libs/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('template/libs/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/pages/register.js') }}"></script>
@endpush
