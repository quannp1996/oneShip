@extends('basecontainer::admin.auth.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <div class="login__section">
                                <form class="login-form " id="login-form-page"
                                      action="{{route('post_admin_login_form')}}" method="post">
                                    {{ csrf_field() }}
                                    <h1>{{__('Đăng nhập')}}</h1>
                                    <p class="text-muted">Đăng nhập tài khoản quản trị</p>
                                    @if(session('status'))
                                        <div class="text-danger mb-3">{{ session('status') }}</div>
                                    @else
                                        <div class="text-danger mb-3 d-none" id="status-login"></div>
                                    @endif
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><svg class="c-icon"><use
                                                            xlink:href="admin/vendors/@coreui/icons/svg/free.svg#cil-user"></use></svg></span>
                                        </div>
                                        <input class="form-control {{$errors->has('email') ? 'is-invalid' : '' }}"
                                               type="text" id="email" name="email" value="{{old('email')}}"
                                               placeholder="Email">
                                        <div class="invalid-feedback" id="email_login_page">
                                            {{ $errors->first('email') }}
                                        </div>
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><svg class="c-icon"><use
                                                            xlink:href="admin/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use></svg></span>
                                        </div>
                                        <input class="form-control {{$errors->has('password') ? 'is-invalid' : '' }}"
                                               type="password" id="password" name="password" placeholder="Password">
                                        <div class="invalid-feedback" id="password_login_page">
                                            {{ $errors->first('password') }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-primary px-4" id="btn-login"
                                                    type="submit">{{__('site.dangnhap')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js_bot_all')
    <script>
        $(document).ready(function () {
            $('#login-form-page').on('submit', function (e) {
                var data = $(this).serialize();
                //console.log(data);
                $('#login-form-page input').removeClass('is-invalid').addClass('reverse');
                $.ajax({
                    type: 'POST',
                    url: "{{route('post_admin_login_form')}}",
                    data: data,
                    dataType: 'json',
                    statusCode: {
                        422: function (response) {
                            var json = JSON.parse(response.responseText);
                            if (json !== undefined) {
                                $('#login-form-page div.invalid-feedback').empty();
                                $.each(json.errors, function (key, val) {
                                    $('#' + key).removeClass('reverse').addClass('is-invalid');
                                    $('#login-form-page div#' + key + '_login_page').html(val[0]);
                                });
                            }
                        },
                        200: function (response) {
                            if (response.error === 1) {
                                $('#login-form-page #status-login').html(response.msg).removeClass('d-none').addClass('d-block')
                            } else {
                                // localStorage.setItem("accesstoken", response.data.token.response_content.access_token);
                                shop.redirect(response.data['url']);
                            }
                        },
                        401: function (response) {
                            var json = JSON.parse(response.responseText);
                            $('#login-form-page #status-login').html(json.msg).removeClass('d-none');
                        }
                    },
                    beforeSend: function () {

                    }
                }).done(function (json) {

                }).always(function () {
                    $('#login-form-page').find('button#btn-login').html('Login').attr("disabled", false);
                });

                return false;
            });

            $('.open__forgot__form').click(function () {
                $('.forgot__section').toggle('fast');
                $('.login__section').toggle('fast');
            });

            $('#forgot-form-page').on('submit', function (e) {
                var data = $(this).serialize();
                $('#forgot-form-page input').removeClass('is-invalid').addClass('reverse');
                $.ajax({
                    type: 'POST',
                    url: "{{route('post_admin_reset_link')}}",
                    data: data,
                    dataType: 'json',
                    statusCode: {
                        200: function (json) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công',
                                text: 'Đã gửi đường dẫn cập nhật lại mật khẩu',
                            })
                        },

                        422: function (json) {
                            const errors = json.responseJSON.errors;
                            Object.keys(errors).forEach(element => {
                                $(`.${element}_errors__forgot`).text(errors[element]);
                            });
                        }
                    }
                }).always(function () {
                    $('#forgot-form-page').find('button.btn').attr("disabled", false);
                    $('#forgot-form-page').find('button.btn i').remove();
                });
                return false;
            })
        });
    </script>
@endpush
