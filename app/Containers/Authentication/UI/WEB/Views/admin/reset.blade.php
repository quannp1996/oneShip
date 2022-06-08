@extends('basecontainer::admin.auth.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <div class="login__section">
                                <form class="update-password-form" id="update-password-form" action="{{route('update_password_addmin')}}" method="post">
                                    {{ csrf_field() }}
                                    <h1 class="text-muted">Cập nhật mật khẩu</h1>
                                    @if(session('status'))
                                        <div class="text-danger mb-3">{{ session('status') }}</div>
                                    @else
                                        <div class="text-danger mb-3 d-none" id="status-login"></div>
                                    @endif
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><svg class="c-icon"><use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}"></use></svg></span>
                                        </div>
                                        <input class="form-control {{$errors->has('password') ? 'is-invalid' : '' }}" type="password" id="email" name="password" value="{{old('password')}}" placeholder="Mật khẩu mới">
                                        <div class="invalid-feedback" id="password">
                                            {{ $errors->first('email') }}
                                        </div>
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><svg class="c-icon"><use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-lock-locked') }}"></use></svg></span>
                                        </div>
                                        <input class="form-control {{$errors->has('password2') ? 'is-invalid' : '' }}" type="password" id="password2" name="password2" placeholder="Nhập lại mật khẩu mới">
                                        <div class="invalid-feedback" id="password2">
                                            {{ $errors->first('password') }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-primary px-4" type="submit">Xác nhận</button>
                                        </div>
                                        <div class="col-6 text-right">
                                            <a href="{{ route('get_admin_login_page') }}">
                                                Đăng nhập?
                                            </a>
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{ $request->email }}" name="email" />
                                    <input type="hidden" value="{{ $request->token }}" name="token" />
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#update-password-form').on('submit', function (e) {
            var data = $(this).serialize();
            $('#update-password-form input').removeClass('is-invalid').addClass('reverse');
            $.ajax({
                type: 'POST',
                url: "{{route('update_password_addmin')}}",
                data: data,
                dataType: 'json',
                statusCode: {
                    422: function(response){
                        const errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(element => {
                            $('div#'+ element).text(errors[element]);
                            $('div#'+ element).show('fast');
                        });
                    },
                    200: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công',
                            text: response.msg,
                        }).then(function(){
                            location.href = '{{ route('get_admin_login_page') }}';
                        });
                    },
                    401: function(response) {
                        
                    }
                },
                beforeSend: function(){
                    $('.invalid-feedback').text('');
                }
            }).done(function(json) {

            }).always(function(){
                $('#update-password-form').find('button.btn').attr("disabled", false);
                $('#update-password-form').find('button.btn i').remove();
            });
            return false;
        })
    });
</script>
@endpush
