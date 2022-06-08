<div class="tab-pane active" id="general">
    <div class="tab-content p-0">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="image">Avatar</label>
                    <input type="file" id="image" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}">
                    <div class="mt-2">
                        @if(!empty(@$data->avatar))
                            <div class="pull-right">
                                <img src="{{ $avatar }}" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" disabled value="{{ $data->email }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input type="text" class="form-control" id="name" name="name"  value="{{ $data->name }}"/>
                </div>
            </div>
        </div>
        <div class="accordion pb-1" id="accordionPassword">
            <a class="btn btn-link text-primary pl-0" data-toggle="collapse" data-target="#passwordForm" aria-expanded="true" aria-controls="collapseOne">
                Thay đổi mật khẩu<i class="fa fa-pencil"></i>
            </a>
            <div id="passwordForm" class="collapse" aria-labelledby="headingOne" data-parent="#accordionPassword">
                    {{-- <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="old_password">Mật khẩu cũ</label>
                                <input type="password" class="form-control" id="old_password" name="old_password"/>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="password">Mật khẩu mới</label>
                                <input type="password" class="form-control" id="password" name="password"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="password1">Nhập lại mật khẩu mới</label>
                                <input type="password" class="form-control" id="password1" onkeyup="return confirmPassword(this)" name="password1"/>
                            </div>
                            <small style="display: none" id="errors_confirm__password" class="text-danger">Nhập lại mật khẩu không đúng</small>
                        </div>
                    </div>
            </div>    
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="phone" class="form-control" id="phone" name="phone"  value="{{ $data->phone }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="phone">Giới tính</label>
                    {!! Form::select('gender', [
                        'Nữ',
                        'Nam'
                    ], @$data->gender  , [
                    'id' => 'gender',
                    'class' => 'form-control',
                    ]) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="phone">Ngày sinh</label>
                    <input type="text" class="form-control datepicker" value="{{ $data->birth }}" name="birth" id="birth"/>
                </div>
            </div>
        </div>
    </div>
</div>