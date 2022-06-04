@extends('basecontainer::admin.layouts.default')
@section('content')
    <div class="row">
        {{-- @if ( $data->id == 1 || !\Auth::user()->checkMyRank($data->rank))
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Cảnh báo!</h4>
                <p>Vì lí do bảo mật nên bạn không thể chỉnh sửa thông tin của <b>{{ $data->title }}</b></p>
                <hr>
                <p class="mb-0" align="right">
                    <a class="btn btn-outline-warning" href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-angle-left"></i>&nbsp; Quay lại</a>
                </p>
            </div>
        @else --}}
        <div class="col-sm-12">
            @if(isset($editMode) && $editMode)
            {!! Form::open(['url' => route('admin_authorization_edit_role', $data->getHashedKey()), 'files' => true ]) !!}
            @else
            {!! Form::open(['url' => route('admin_authorization_add_role'), 'files' => true ]) !!}
            @endif

            @if( count ($errors) > 0)
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

            <div class="card card-accent-primary">
                <div class="card-header">
                    <i class="fa fa-pencil-square-o"></i> SỬA THÔNG TIN
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Tên Nhóm</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" {{isset($editMode) && $editMode ? 'disabled' : ''}} value="{{ old('name', @$data->name) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="display_name">Tên hiển thị</label>
                                <input type="text" class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}" id="display_name" name="display_name" value="{{ old('display_name', @$data->display_name) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">
                            <label for="description">Mô tả ngắn</label>
                                <textarea rows="5" class="form-control" name="description" id="description" >{!! old('description',@$data->description)  !!}</textarea>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="level">Level</label>
                                <input type="text" class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" id="level" name="level" value="{{ old('level', @$data->level) }}" onkeypress="return shop.numberOnly()" maxlength="4" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                                            <?php
                                                $per_found = null;

                                                if( isset($data) ) {
                                                    $per_found = $data->hasPermissionTo($v->name);
                                                }
                                            ?>
                                            {!! Form::checkbox("permissions_ids[]", $v->getHashedKey(), $per_found, isset($options) ? $options : ['class' => 'c-switch-input']) !!}
                                            <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                                        </label>
                                    </div>
                                    <div class="col-sm-10" style="margin-bottom: 10px"><p style="margin-left: 20px">{!! '<b clas="text-uppercase">'.$v->name.'</b> - '.($v->display_name ? $v->display_name : $v->description) !!}</p></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Cập nhật</button>
                &nbsp;&nbsp;
                <a class="btn btn-sm btn-danger" href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-ban"></i> Hủy bỏ</a>
            </div>
            {!! Form::close() !!}
        </div>
        {{-- @endif --}}
    </div>
@stop
