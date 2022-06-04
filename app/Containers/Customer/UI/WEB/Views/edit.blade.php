@extends('basecontainer::admin.layouts.default_for_iframe')
@section('content')
    <div class="row" id="sectionContent">
        <div class="col-12">
            <div class="card mb-0">
                <form action="{{ route('admin.customers.update', ['id' => $customer->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-header d-flex">
                        <button class="btn btn-link">Sửa thông tin KH: {{ $customer->email }}</button>
                        <div class="d-flex ml-auto">
                            <button type="button" class="btn btn-secondary mr-2"
                                onclick='return closeFrame(@bladeJson($customer))'>Đóng lại</button>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="nav nav-tabs nav-underline nav-underline-primary">
                            <li class="nav-item">
                                <a class="nav-link active" href="#thong_tin_chung" data-toggle="tab" role="tab"
                                    aria-controls="thong_tin_chung">
                                    Thông tin chung
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#address_book" data-toggle="tab" role="tab"
                                    aria-controls="nhom_quyen">
                                    Sổ địa chỉ
                                </a>
                            </li>

                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#nhom_quyen" data-toggle="tab" role="tab"
                                    aria-controls="nhom_quyen">
                                    Nhóm quyền
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#quyen_dac_biet" data-toggle="tab" role="tab"
                                    aria-controls="quyen_dac_biet">
                                    Quyền đặc biệt
                                </a>
                            </li> --}}
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="thong_tin_chung" role="tabpanel">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text"
                                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                    id="email" name="email"
                                                    {{ isset($editMode) && $editMode ? 'disabled' : '' }}
                                                    value="{{ old('email', @$customer->email) }}" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="password">Mật khẩu </label>
                                                <input type="password"
                                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                    id="password" name="password" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="password_confirm">Nhập lại mật khẩu </label>
                                                <input type="password"
                                                    class="form-control{{ $errors->has('password_confirm') ? ' is-invalid' : '' }}"
                                                    id="password_confirm" name="password_confirm" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="name">Họ và tên</label>
                                                <input type="text"
                                                    class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}"
                                                    id="fullname" name="fullname"
                                                    value="{{ old('fullname', $customer->fullname ?? '') }}" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="phone">Số điện thoại </label>
                                                <input type="text"
                                                    class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                    id="phone" name="phone" value="{{ old('phone', @$customer->phone) }}"
                                                    required maxlength="11" />
                                            </div>
                                        </div>
                                    </div>

                                    {{-- @php($customerGroups = $customer->groups->pluck('id')->toArray())
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="phone">Nhóm khách hàng </label>
                                                <select name="customer_group_ids[]" id="customer_group_ids"
                                                    class="form-control select2" multiple>
                                                    <option value="">-- Chọn --</option>
                                                    @foreach ($groups as $group)
                                                        <option value="{{ $group->id }}" @if (in_array($group->id, old('customer_group_ids', $customerGroups))) selected @endif>
                                                            {{ $group->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div><!-- /.End thong tin chung -->

                            <div class="tab-pane" id="address_book" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Họ Tên</th>
                                                <th scope="col">Địa Chỉ</th>
                                                <th scope="col">Số Điện Thoại</th>
                                                <th scope="col" class="text-center">Địa chỉ mặc định</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse (@$customer->addresses as $address)
                                                <tr>
                                                    <td scope="col">{{ @$address->name }}</td>
                                                    <td scope="col">
                                                        {{ @$address->address }}
                                                        <p class="mb-0">Thành phố: <strong>{{ @$address->province->name }}</strong></p>
                                                        <p class="mb-0">Quận/ huyện: <strong>{{ @$address->district->name }}</strong></p>
                                                        <p class="mb-0">Xã/ phường: <strong>{{ @$address->ward->name }}</strong></p>
                                                    </td>
                                                    <td scope="col">{{ @$address->phone }}</td>
                                                    <td scope="col" class="text-center">
                                                        <i class="fa {{ $address->is_default ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }}"></i>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">Chưa có thông tin</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="nhom_quyen" role="tabpanel">
                                <div class="card-body accordion collapse {{ isset($editMode) && $editMode ? 'hide' : 'show' }}"
                                    id="accorRoles">
                                    @php($user_roles = old('roles', []))
                                    @foreach ($roles as $k => $v)
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label class="c-switch c-switch-label c-switch-outline-primary">
                                                    <?php
                                                    $per_found = null;
                                                    
                                                    if (isset($customer)) {
                                                        $per_found = $customer->hasRole($v->name);
                                                    }
                                                    ?>
                                                    {!! Form::checkbox('roles_ids[]', $v->getHashedKey(), $per_found, isset($options) ? $options : ['class' => 'c-switch-input']) !!}
                                                    <span class="c-switch-slider" data-checked="On"
                                                        data-unchecked="Off"></span>
                                                </label>
                                            </div>
                                            <div class="col-sm-10">{!! '<b clas="text-uppercase">' . $v->name . '</b> - ' . ($v->display_name ? $v->display_name : '---') . ' - ' . $v->description !!}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div><!-- /.End nhom quyen -->

                            <div class="tab-pane" id="quyen_dac_biet" role="tabpanel">
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
                                                                    <label
                                                                        class="c-switch c-switch-label c-switch-outline-primary">
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
                            </div><!-- /.End quyen dac biet -->
                        </div>

                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
