<div class="partner-tab-content" id="box-owner-info">
    <div class="partner-tab-title-box">
        <div class="partner-tab-title">
            Thông tin tài khoản
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6">
            <div class="partner-edit-form">
                <div class="edit-form-block edit-form-block-sm">
                    <div class="edit-form-title border-bottom-1 text-uppercase">
                        Thông tin cơ bản
                    </div>
                    <form action="{{ route('update_owner_profile') }}" method="POST" id="owner__information" class="form-styled">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-12">
                                <label for="partnerName">Họ và tên</label>
                                <input type="text" name="fullname" class="form-control" value="{{ @$user->fullname }}" id="fullname" aria-describedby="partnerNameHelp" placeholder="Họ và tên">
                                {{-- <small id="partnerNameHelp" class="form-text text-danger">
                                    Error note !
                                </small> --}}
                        </div>
                        <div class="form-group col-12">
                            <label for="parnterTel">Số điện thoại</label>
                            <input type="text" class="form-control" id="parnterPhone" name="phone" value="{{ @$user->phone }}" aria-describedby="parnterTelHelp" placeholder="Nhập số điện thoại">
                            {{-- <small id="parnterTelHelp" class="form-text text-danger">
                                Error note !
                            </small> --}}
                        </div>
                        <div class="form-group col-12">
                            <label for="parnterEmail">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ @$user->email }}" id="parnterEmail" aria-describedby="parnterEmailHelp" placeholder="duongta@lalala.com">
                            {{-- <small id="parnterEmailHelp" class="form-text text-danger">
                                Error note !
                            </small> --}}
                        </div>
                        <div class="row main__address">
                            <div class="form-group col-12">
                                <label for="partnerAddress">Địa chỉ</label>
                                <input type="text" value="{{ @$user->mainAddress->address }}" name="address_book[address]" class="form-control" id="partnerAddress" aria-describedby="partnerAddressHelp" placeholder="Nhập địa chỉ">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="parnterCity">Tỉnh/TP</label>
                                <div class="custom-select-box">
                                    <select id="parnterCity" name="address_book[city_id]" parentID="main__address" class="form-control cityDropdown">
                                        <option value="0" selected>Tỉnh/TP</option>
                                        @foreach ($allCities as $city)
                                        <option value="{{ $city->id }}" {{ @$user->mainAddress->city_id == $city->id ? 'selected' : ''}}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="parnterDistrict">Quận/Huyện</label>
                                <div class="custom-select-box">
                                    <select id="parnterDistrict" name="address_book[district_id]" {{ count(@$allDistricts ?? []) ? '' : 'disabled'}} parentID="main__address" class="form-control districtDropdown">
                                        <option value="0" selected>Quận/Huyện</option>
                                        @foreach ($allDistricts as $district)
                                        <option value="{{ $district->id }}" {{ @$user->mainAddress->district_id == $district->id ? 'selected' : ''}}>{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="parnterWarp">Xã/Phường</label>
                                <div class="custom-select-box">
                                    <select id="parnterWarp" name="address_book[ward_id]" {{ count(@$allWards ?? []) ? '' : 'disabled'}} parentID="main__address" class="form-control wardDropdown">
                                        <option value="0" selected>Xã/Phường</option>
                                        @foreach ($allWards as $ward)
                                            <option value="{{ $ward->id }}" {{ @$user->mainAddress->ward_id == $ward->id ? 'selected' : ''}}>{{ $ward->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 mt-2 text-right">
                            <button type="button" onclick="return profileForm.sendUpdateRequest()" href="javavascript:;" class="btn-custom btn-color btn-custom-size-m">
                                Cập nhật
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="partner-edit-form">
                <div class="edit-form-block edit-form-block-sm">
                    <div class="edit-form-title border-bottom-1 text-uppercase">
                        Bảo mật
                    </div>
                    <div class="verified-box">
                        <div class="box-title">
                            <img src="{{ asset('template/images/surface1.png') }}" alt="" class="lazy img-fluid">
                            <div class="box-info">
                                <strong class="d-block">
                                    Đã bật bảo mật 2 lớp
                                </strong>
                                <small>
                                    Tài khoản của bạn đã được bảo mật mức cao nhất
                                </small>
                            </div>
                        </div>
                        <div class="sms-box">
                            @if ($user->sendOtpViaPhone())
                                <div class="form-group">
                                    <label for="verified-sms" class="label-big-text">Nhận mã xác minh qua tin nhắn SMS <small class="d-block"> Chúng tôi sẽ gửi mã xác minh đến số điện thoại bạn đăng ký dưới đây</small> </label>
                                    <input type="text" id="verified-sms" aria-describedby="verified-smsHelp" value="{{ $user->phone }}" class="form-control">
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="verified-sms" class="label-big-text">Nhận mã xác minh qua Email <small class="d-block"> Chúng tôi sẽ gửi mã xác minh đến email bạn đăng ký dưới đây</small> </label>
                                    <input type="text" id="verified-sms" aria-describedby="verified-smsHelp" value="{{ $user->email }}" class="form-control">
                                </div>
                            @endif
                            
                            <label for="security-method">
                                <input type="checkbox" id="security-method" name="change_method_aut2" onclick="return loginProcess.sendOTPCode()" class="custom-control-input"> 
                                <span class="custom-form-checkbox"></span>
                                Thay đổi phương thức nhận mã xác minh
                            </label>
                        </div>
                        <div class="password-box">
                            <div class="form-group">
                                <label for="changed-pass">Mật khẩu </label>
                                <input type="text" value="******" id="changed-pass" aria-describedby="changed-passHelp" placeholder="" class="form-control">
                            </div>
                            <label for="security-method-1">
                                <input type="checkbox" id="security-method-1" onchange="$('#form-changePassword').toggle();" name="changePassword" class="custom-control-input"> 
                                <span class="custom-form-checkbox"></span>
                                Thay đổi mật khẩu
                            </label>
                            <form id="change__password">
                                @csrf
                                <div id="form-changePassword" style="display: none;">
                                    <div class="form-group">
                                        <label for="partnerOldPass">Mật khẩu cũ</label>
                                        <input type="password" name="password" class="form-control" id="partnerOldPass" aria-describedby="partnerOldPassHelp" placeholder="Nhập mật khẩu hiện tại">
                                        {{-- <small id="partnerOldPassHelp" class="form-text text-danger">
                                            Error note !
                                        </small> --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="partnerNewPass">Mật khẩu mới</label>
                                        <input type="password" name="password2" class="form-control" placeholder="Nhập mật khẩu mới" id="partnerNewPass" aria-describedby="partnerNewPassHelp" placeholder="">
                                        {{-- <small id="partnerNewPassHelp" class="form-text text-danger">
                                            Error note !
                                        </small> --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="partnerReNewPass">Nhập lại mật khẩu mới</label>
                                        <input type="password" name="confirm_password2" class="form-control" placeholder="Nhập lại mật khẩu mới" id="partnerReNewPass" aria-describedby="partnerReNewPassHelp" placeholder="">
                                        {{-- <small id="partnerReNewPassHelp" class="form-text text-danger">
                                            Error note !
                                        </small> --}}
                                    </div>
                                    <p class="text-right">
                                        <button type="button" onclick="return profileForm.changePassword()" class="btn-custom btn-color float-xl-right btn-border-radius-5 btn-custom-size-m">
                                            Thay đổi mật khẩu
                                        </button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('content_popup')
<div id="notEnableFA2" class="popup">
    <div class="popup__overlay"></div>
    <div class="popup__absolute">
      <div class="popup__relative">
        <div class="popup__content">
          <div class="js-event auth__method auth__codesend d-none">
            <h2>Chọn phương thức nhận mã xác minh mới</h2>
            <p>Chúng tôi sẽ gửi mã xác minh cho bạn khi phát hiện đăng nhập từ thiết bị hoặc trình duyệt mới. Chọn phương thức nhận mã xác minh:</p>
            <form action="#" id="form_select_option">
                <div class="radio__custom">
                    <div class="radio__custom-items">
                      <input type="radio" onclick="return loginProcess.setupMethod('phone')" id="send_via__phone" value="phone" name="otp_send_option" {{ $user->otp_method == 'phone'  ? 'checked' : '' }}>
                      <label for="send_via__phone">
                          <div class="box__auth send_via__phone_input">
                            <h4>Nhận qua tin nhắn SMS</h4>
                            <input type="tel" name="phone" id="phone" {{ $user->phone ? 'disabled' : '' }} value="{{ $user->phone }}" placeholder="Nhập số điện thoại">
                          </div>
                      </label>
                    </div>
                    <div class="radio__custom-items">
                      <input type="radio" id="send_via__email" onclick="return loginProcess.setupMethod('email')" value="email" name="otp_send_option" {{ $user->otp_method == 'email'  ? 'checked' : '' }}>
                      <label for="send_via__email">
                          <div class="box__auth send_via__email_input">
                            <h4>Nhận qua Email</h4>
                            <input type="email" name="email" {{ $user->email ? 'disabled' : '' }} id="email" value="{{ $user->email }}" placeholder="Nhập email">
                          </div>
                      </label>
                    </div>
                </div>
                <div class="btn__auth">
                    <a href="javascript:;" onclick="return loginProcess.selectMethod(this)" class="">Tiếp tục</a>
                </div>
            </form>
          </div>
          <!-- Nhập mã xác minh -->
          <div class="js-event auth__method auth__codevalid d-none">
            <h2>Nhập mã xác minh</h2>
            <p class="message_send"></p>
            <form action="#" id="form__step3">
                @csrf
                <div class="box__auth-code">
                    <input type="text" name="otp_code" id="otp_code" placeholder="Nhập mã xác minh">
                </div>
                <div class="box__resend-auth">
                    <span>Bạn chưa nhận được mã? <a href="javascript:;" onclick="return loginProcess.sendOTPCode()" title="">Gửi lại</a> </span>
                </div>
                <div class="btn__auth">
                    <a href="javascript:;" onclick="return loginProcess.checkOtpCode()" class="">Xác nhận</a>
                </div>
                <input type="hidden" value="" name="email" id="email" />
                <input type="hidden" value="" name="phone" id="phone"/>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection
@push('js_bot_all')
<script src="{{ asset('template/js/pages/location.js') }}"></script>
<script src="{{ asset('template/js/pages/customer/profile.js') }}"></script>
<script type="text/javascript">
    const loginProcess = {
        userData: null,
        parentID: 'notEnableFA2',
        otp_method: '{{ $user->otp_method }}',

        openPopup2FA( modalPopup ) {
            $('#' + modalPopup).fadeIn('fast');
            $('#' + modalPopup).addClass('active');
        },

        openForm: function(className){
            $('#' + loginProcess.parentID).find('.js-event').addClass('d-none');
            $('#' + loginProcess.parentID).find('.' + className).removeClass('d-none');
        },

        setupMethod: function(type){
          this.otp_method = type;
        },

        sendOTPCode: function (element) {
            $.ajax({
                url: `${BASE_URL}/owner/sendcode`,
                type: 'POST',
                data: {
                    _token: ENV.token
                },
                dataType: 'json',
                beforeSend: function(){},
                statusCode: {
                   200: function(jsonData){
                      if(jsonData.data.success){
                        $('.auth__codevalid .message_send').text(jsonData.message);
                        loginProcess.openPopup2FA('notEnableFA2');
                        loginProcess.openForm('auth__codevalid');
                      }else{
                          alert(jsonData.message)
                      }
                   },
                   422: function(jsonData){
                      alert('Lỗi');
                   }
                }
            })
        },

        checkOtpCode: function(){
            $.ajax({
                url: `${BASE_URL}/owner/checkcode`,
                type: 'POST',
                data: {
                    _token: ENV.token,
                    otp_code: $('#form__step3 #otp_code').val()
                },
                dataType: 'json',
                beforeSend: function(){
                },
                success: function(jsonData){
                    if(jsonData.data.success){
                        loginProcess.openForm('auth__codesend');
                    }else{
                        alert(jsonData.message)
                    }
                }
            })
        },

        selectMethod: function(){
            $.ajax({
                url: `${BASE_URL}/owner/setup/method`,
                type: 'POST',
                data: {
                    _token: ENV.token,
                    otp_method: this.otp_method
                },
                dataType: 'json',
                beforeSend: function(){
                },
                success: function(jsonData){
                    $('.popup').removeClass('active');
                    $('.popup').fadeOut('fast');
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công',
                        text: 'Thay đổi phương thức xác minh thành công',
                    })
                }
            })
        }
    }
</script>
@endpush