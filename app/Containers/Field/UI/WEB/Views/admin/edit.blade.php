@extends('basecontainer::admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ 
                @$data->id
                ? route('admin_fields_update_page', ['id' => $data->id])
                : route('admin_fields_store_page')
            }}" method="POST">
                @csrf
                <div class="card card-accent-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="card card-accent-primary">
                                    <div class="card-header">
                                        <strong>Thông tin chung</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="position_">
                                                Tiêu đề 
                                            </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="{{ @$data->lable }}" name="lable">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="position_">
                                                Placeholder
                                            </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="{{ @$data->placeholder }}" name="placeholder">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="position_">
                                                Sắp xếp
                                            </label>
                                            <div class="input-group">
                                                <input type="nummber" class="form-control" value="{{ @$data->sort_order }}" name="sort_order">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="position_">
                                                Trạng thái
                                            </label>
                                            <div class="input-group">
                                                <label class="c-switch c-switch-label c-switch-primary m-0 align-middle">
                                                    <input type="hidden" name="status" value="0">
                                                    <input type="checkbox" name="status" value="1" class="c-switch-input" {{ @$data->status == 1 ? 'checked' : '' }}>
                                                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="position_">
                                                Trường bắt buộc
                                            </label>
                                            <div class="input-group">
                                                <label class="c-switch c-switch-label c-switch-primary m-0 align-middle">
                                                    <input type="hidden" value="0" name="is_required">
                                                    <input type="checkbox" name="is_required" value="1" class="c-switch-input" {{ @$data->is_required == 1 ? 'checked' : '' }}>
                                                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary">
                            <i class="fa fa-dot-circle-o"></i>Lưu</button>
                        <a href="{{ route('admin_field_home_page') }}" class="btn btn-sm btn-danger">
                            <i class="fa fa-ban"></i>
                            Hủy Bỏ
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
