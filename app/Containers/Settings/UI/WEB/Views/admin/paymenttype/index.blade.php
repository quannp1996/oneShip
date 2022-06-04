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

        {!! Form::open(['url' => route('admin_paymenttype_home_page'), 'method' => 'get', 'id' => 'searchForm']) !!}
        <div class="card card-accent-primary">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-bookmark-o"></i></span></div>
                            <input type="text" name="name" class="form-control" placeholder="Tiêu đề" value="{{ $search_data->name }}">
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-calendar"></i></span></div>
                            <input type="text" name="time_from" class="datepicker form-control" placeholder="Ngày tạo từ" autocomplete="off" value="{{ $search_data->time_from }}">
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-calendar"></i></span></div>
                            <input type="text" name="time_to" class="datepicker form-control" placeholder="Ngày tạo đến" autocomplete="off" value="{{ $search_data->time_to }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-list"></i></span></div>
                            <select id="status" name="status" class="form-control">
                                <option value="">-- Chọn trạng thái --</option>
                                <option value="2"{{ $search_data->status == 2 ? ' selected="selected"' : '' }}>Đang hiển thị</option>
                                <option value="1"{{ $search_data->status == 1 ? ' selected="selected"' : '' }}>Đang ẩn</option>
                                {{-- <option value="-1"{{ $search_data->status == -1 ? ' selected="selected"' : '' }}>Đã xóa</option> --}}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                <a href="{{ route('admin_paymenttype_home_page') }}" class="btn btn-sm btn-primary"><i class="fa fa-refresh"></i> Reset</a>
                <a href="{{ route('admin_paymenttype_add_page') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
            </div>
        </div>
        {!! Form::close() !!}

        <div class="card card-accent-primary">
            <div class="card-body p-0">
                <table class="table table-bordered table-striped ">
                    <thead>
                    <tr>
                        <th width="55">ID</th>
                        <th>Tiêu đề</th>
                        <th>Sắp xếp</th>
                        {{-- <th width="125">Ảnh</th> --}}
                        <th width="100">Ngày tạo</th>
                        <th width="55">Lệnh</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td align="center">{{ $item->id }}</td>
                        <td>
                            <div class="mb-2">{{ @$item->desc->name }}</div>
                            <div>
                                <small>{!! @$item->desc->short_description !!}</small>
                            </div>
                        </td>
                        <td>
                            {{ @$item->sort_order }}
                        </td>
                        {{-- <td align="center">
                            @if(isset($item->desc) && $item->desc->image != '')
                                <img src="{{ $item->desc->getImageUrl('small') }}" width="100" />
                            @else
                                ---
                            @endif
                        </td> --}}
                        <td align="center">{!! $item->created_at ? Carbon\Carbon::parse($item->created_at)->format("d/m/Y H:i:s") : '---' !!} </td>
                        <td align="center">
                            @if($item->status == 2)
                                <a href="javascript:void(0)" data-route="{{route('admin_paymenttype_disable', $item->id)}}" class="text-primary" onclick="admin.updateStatus(this,{{$item->id}},1)" title="Đang hiển thị, Click để ẩn"><i class="fa fa-eye"></i></a>
                            @else
                                <a href="javascript:void(0)" data-route="{{route('admin_paymenttype_enable', $item->id)}}" class="text-danger" onclick="admin.updateStatus(this,{{$item->id}}, 2)" title="Đang ẩn, Click để hiển thị"><i class="fa fa-eye"></i></a>
                            @endif
                            @if($item->status != -1)
                            <a href="{{ route('admin_paymenttype_edit_page', $item->id) }}" class="btn text-primary"><i class="fa fa-pencil"></i></a>
                            <a data-href="{{ route('admin_paymenttype_delete', $item->id) }}"  class="btn text-danger" onclick="admin.delete_this(this);"><i class="fa fa-trash"></i></a>
                            @endif
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
