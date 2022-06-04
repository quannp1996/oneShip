@extends('basecontainer::admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['url' => route('admin_field_home_page'), 'method' => 'get', 'id' => 'searchForm']) !!}
            <div class="card card-accent-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><i
                                                class="fa fa-bookmark-o"></i></span></div>
                                <input type="text" name="lable" class="form-control" placeholder="Tên trường"
                                       value="{{ $search_data->lable }}">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><i
                                                class="fa fa-calendar"></i></span></div>
                                <input type="text" name="time_from" class="datepicker form-control"
                                       placeholder="Ngày tạo từ" autocomplete="off"
                                       value="{{ $search_data->time_from }}">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><i
                                                class="fa fa-calendar"></i></span></div>
                                <input type="text" name="time_to" class="datepicker form-control"
                                       placeholder="Ngày tạo đến" autocomplete="off"
                                       value="{{ $search_data->time_to }}">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><i
                                                class="fa fa-list"></i></span></div>
                                <select id="status" name="status" class="form-control">
                                    <option value="">-- Chọn trạng thái --</option>
                                    <option value="2"{{ $search_data->status == 2 ? ' selected="selected"' : '' }}>Đang
                                        hiển thị
                                    </option>
                                    <option value="1"{{ $search_data->status == 1 ? ' selected="selected"' : '' }}>Đang
                                        ẩn
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                    <a href="{{ route('admin_field_home_page') }}" class="btn btn-sm btn-primary"><i
                                class="fa fa-refresh"></i> Reset</a>
                    <a href="{{ route('admin_fields_add_page') }}" class="btn btn-sm btn-primary"><i
                                class="fa fa-plus"></i> Thêm mới</a>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="card card-accent-primary">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Danh sách
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th width="100">ID</th>
                                <th>Tên trường</th>
                                <th width="55">Thứ tự</th>
                                <th width="100">Ngày tạo</th>
                                <th width="55">Lệnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->lable }}</td>
                                    <td width="55">{{ $item->sort_order }}</td>
                                    <td width="100">{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin_fields_edit_page', ['id' => $item->id]) }}" class="btn text-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a data-href="{{ route('admin_fields_delete', ['id' => $item->id]) }}" class="btn text-danger" onclick="admin.delete_this(this);">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('basecontainer::admin.inc.bottom-pager-infor')
                </div>
            </div>
        </div>
    </div>
@stop
@push('js_bot_all')
    <script>
        $('.datepicker').datetimepicker({
            format: 'd/m/Y',
            timepicker: false
        });
    </script>
@endpush
