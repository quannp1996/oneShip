@extends('basecontainer::admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-5"><h1>{{ $site_title }}</h1></div>

            @if( count($errors) > 0)
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

            {!! Form::open(['url' => route('admin_staticpage_home_page'), 'method' => 'get', 'id' => 'searchForm']) !!}
            <div class="card card-accent-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><i
                                                class="fa fa-bookmark-o"></i></span></div>
                                <input type="text" name="name" class="form-control" placeholder="Tiêu đề"
                                       value="{{ $search_data->name }}">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><i
                                                class="fa fa-navicon"></i></span></div>
                                {!! Form::select('position', $positions, $search_data->position , [
                                     'id' => 'position',
                                     'class' => 'form-control',
                                 ]) !!}
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
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                    <a href="{{ route('admin_staticpage_home_page') }}" class="btn btn-sm btn-primary"><i
                                class="fa fa-refresh"></i> Reset</a>
                    <a href="{{ route('admin_staticpage_add_page') }}" class="btn btn-sm btn-primary"><i
                                class="fa fa-plus"></i> Thêm mới</a>
                </div>
            </div>
            {!! Form::close() !!}

            <div class="card card-accent-primary">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Danh sách
                </div>

                <div class="card-body table-responsive">
                    @if(empty($data) || $data->isEmpty())
                        <h4 align="center">Không tìm thấy dữ liệu phù hợp</h4>
                    @else
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="55">ID</th>
                                <th width="80">Sắp xếp</th>
                                <th>Tiêu đề</th>
                                <th width="100">Ngày tạo</th>
                                <th width="85">Ẩn/Hiện</th>
                                <th width="55">Sửa</th>
                                <th width="55">Xóa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td align="center">{{ $item->id }}</td>
                                    <td align="center">{{ $item->sort_order ?? 0 }}</td>
                                    <td>
                                        <div class="mb-2">{{ @$item->desc->name }}</div>
                                        @php($positions = $item->positions())
                                        @if($positions)
                                            <div>
                                                <b>Vị trí:</b>
                                                @foreach($positions as $k => $n)
                                                    <span class="badge badge-pill badge-secondary">{{ $n }} <span
                                                                class="text-danger">({{$k}})</span></span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>
                                    <td align="center">{!! $item->created_at ? $item->created_at->format("d/m/Y H:i:s") : '---' !!}</td>
                                    <td align="center">
                                        @if($item->status == 2)
                                            <a href="javascript:void(0)" class="text-primary"
                                                data-route="{{route('admin_staticpage_disable', $item->id)}}"
                                                onclick="admin.updateStatus(this,{{$item->id}},1)"
                                                data-toggle="tooltip" data-placement="top"
                                                data-original-title="Đang hiển thị, Click để ẩn">
                                                <i class="fa fa-eye"></i></a>
                                        @else
                                            <a href="javascript:void(0)" class="text-danger"
                                                data-route="{{route('admin_staticpage_enable', $item->id)}}"
                                                onclick="admin.updateStatus(this,{{$item->id}},2)"
                                                data-toggle="tooltip" data-placement="top"
                                                data-original-title="Đang ẩn, Click để hiển thị">
                                                <i class="fa fa-eye"></i></a>
                                        @endif
                                    </td>
                                    <td align="center">
                                        <a href="{{ route('admin_staticpage_edit_page', $item->id) }}"
                                            data-toggle="tooltip" data-placement="top"
                                            data-original-title="Chỉnh sửa"
                                            class="text-primary">
                                            <i class="fa fa-pencil"></i></a>
                                    </td>
                                    <td align="center">
                                        <a data-href="{{ route('admin_staticpage_delete', $item->id) }}"
                                            data-toggle="tooltip" data-placement="top"
                                            data-original-title="Xóa"
                                            class="btn text-danger" onclick="admin.delete_this(this);">
                                            <i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="pull-right">Tổng cộng: {{ $data->count() }} bản ghi / {{ $data->lastPage() }}
                            trang
                        </div>
                        {!! $data->links('basecontainer::admin.inc.paginator') !!}
                    @endif
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
