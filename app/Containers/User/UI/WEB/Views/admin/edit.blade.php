@extends('basecontainer::admin.layouts.default')
@section('content')
    @if (isset($editMode) && $editMode)
        {!! Form::open(['url' => route('admin_user_edit_page', $data->getHashedKey()), 'files' => true]) !!}
    @else
        {!! Form::open(['url' => route('admin_user_add_page'), 'files' => true]) !!}
    @endif
    <div class="row">
        <div class="col-sm-6">
            <div class="card card-accent-primary">
                <div class="card-header">
                    <i class="fa fa-user"></i>
                    @if (isset($editMode) && $editMode)
                        Chỉnh sửa thông tin
                    @else
                        Thêm người dùng mới
                    @endif
                </div>
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{!! $error !!}</div>
                            @endforeach
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success">
                            {!! session('status') !!}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    id="email" name="email" {{ isset($editMode) && $editMode ? 'disabled' : '' }}
                                    value="{{ old('email', @$data->email) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="password">Mật khẩu </label>
                                <input type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password"
                                    name="password">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="password_confirm">Nhập lại mật khẩu </label>
                                <input type="password"
                                    class="form-control{{ $errors->has('password_confirm') ? ' is-invalid' : '' }}"
                                    id="password_confirm" name="password_confirm">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="name">Họ và tên</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    id="name" name="name" value="{{ old('name', @$data->name) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="phone">Số điện thoại </label>
                                <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                    id="phone" name="phone" value="{{ old('phone', @$data->phone) }}" required
                                    maxlength="11">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card accordion">
                <div class="card-header">
                    <a class="card-header-action" data-toggle="collapse" href="#accorRoles"
                       aria-expanded="false" aria-controls="accorRoles">
                        <span>Nhóm quyền</span>
                    </a>
                    <div class="card-header-actions">
                        <a class="card-header-action" data-toggle="collapse" href="#accorRoles"
                            aria-expanded="false" aria-controls="accorRoles">
                            <svg class="c-icon mr-2">
                                <use xlink:href="/admin/vendors/@coreui/icons/svg/free.svg#cil-hamburger-menu"></use>
                            </svg></a></div>
                </div>
                <div class="card-body accordion collapse {{ isset($editMode) && $editMode ? 'hide' : 'show' }}"
                    id="accorRoles">
                    @php($user_roles = old('roles', []))
                        @foreach ($roles as $k => $v)
                            <div class="row">
                                <div class="col-sm-2">
                                    <label class="c-switch c-switch-label c-switch-outline-primary">
                                        <?php
                                        $per_found = null;

                                        if (isset($data)) {
                                        $per_found = $data->hasRole($v->name);
                                        }
                                        ?>
                                        {!! Form::checkbox('roles_ids[]', $v->getHashedKey(), $per_found, isset($options) ? $options : ['class' => 'c-switch-input']) !!}
                                        <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                                    </label>
                                </div>
                                <div class="col-sm-10">{!! '<b clas="text-uppercase">' . $v->name . '</b> - ' . ($v->display_name ? $v->display_name : '---') . ' - ' . $v->description !!}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card accordion">
                    <div class="card-header">
                        <a class="card-header-action" data-toggle="collapse"
                           href="#accorPermission" aria-expanded="false" aria-controls="accorPermission">
                            <span>Cấp Quyền đặc biệt</span>
                        </a>
                        <div class="card-header-actions">
                            <a class="card-header-action" data-toggle="collapse"
                                href="#accorPermission" aria-expanded="false" aria-controls="accorPermission"><svg
                                    class="c-icon mr-2">
                                    <use xlink:href="/admin/vendors/@coreui/icons/svg/free.svg#cil-hamburger-menu"></use>
                                </svg></a></div>
                    </div>
                    <div class="card-body accordion collapse {{ isset($editMode) && $editMode ? 'hide' : 'show' }}"
                        id="accorPermission">
                        <div class="row">
                            @foreach ($all_perms as $k => $perm_group)
                                <div class="col-sm-3">
                                    <div class="card card-accent-primary">
                                        <div class="card-header"><b>{{ $k }}</b></div>
                                        <div class="card-body">
                                            @foreach ($perm_group as $v)
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label class="c-switch c-switch-label c-switch-outline-primary">
                                                            {!! Form::checkbox('permissions_ids[]', $v->getHashedKey(), isset($user_perms[$v->name]), isset($options) ? $options : ['class' => 'c-switch-input']) !!}
                                                            <span class="c-switch-slider" data-checked="On"
                                                                data-unchecked="Off"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-10">{!! '<b clas="text-uppercase">' . $v->name . '</b> - ' . ($v->display_name ? $v->display_name : $v->description) !!}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=row>
            <div class="col-12">
                <div class="card card-accent-primary">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> {{ $editMode ? 'Cập nhật' : 'Thêm mới' }}</button>
                        <a class="btn btn-sm btn-danger ml-3" href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-ban"></i> Hủy bỏ</a>
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    @endsection
