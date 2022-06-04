@extends('basecontainer::admin.layouts.default')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if(isset($editMode) && $editMode)
            {!! Form::open(['url' => route('admin_authorization_edit_perm', $data->getHashedKey()), 'files' => true ]) !!}
            @else
            {!! Form::open(['url' => route('admin_authorization_add_perm'), 'files' => true ]) !!}
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
                                <label for="name">Định danh</label>
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
                                <label for="containers">Container</label>
                                <select {{isset($editMode) && $editMode ? 'disabled' : ''}} class="form-control" name="containers" id="containers">
                                    <option value="">-- Chọn Container --</option>
                                    @foreach($containers as $item)
                                    <option {{isset($data->containers) && $data->containers == $item ? 'selected' : ''}} value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
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