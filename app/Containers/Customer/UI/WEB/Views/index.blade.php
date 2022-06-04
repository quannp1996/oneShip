@extends('basecontainer::admin.layouts.default')

@section('right-breads')
    {!! $data->appends($search_data->toArray())->links('order::inc.paginator') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="mb-5">
                <h1>{{ $site_title }}</h1>
            </div>
            @include('basecontainer::admin.inc.alert-errors-top-index')

            {!! Form::open(['url' => route('admin.customers.index'), 'method' => 'get', 'id' => 'searchForm']) !!}
            <div class="card card-accent-primary">
                <div class="card-body">
                    <input type="hidden" name="is_filter" value="1">
                    @include('customer::inc.filter_inputs',['search_data' => $search_data])
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-primary"><i
                            class="fa fa-refresh"></i> Reset</a>
                    {{-- <a class="btn btn-sm btn-primary" style='color:white' href="{{ route('admin_product_add') }}"><i
                            class="fa fa-plus"></i>Thêm mới</a> --}}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-accent-primary">
                <div class="card-header d-flex py-0">
                    {{-- <a href="javascript:void(0)" onclick="return window.history.back();"><i class="fa fa-reply" aria-hidden="true"></i> Quay lại</a>
                        @include('customer::inc.filter')
                        <a href="{{ route('admin.customers.create') }}" class="ml-auto">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Tạo khách hàng
                        </a> --}}
                    <ul class="nav nav-tabs nav-underline nav-underline-primary card-header-tabs"
                        style="border-bottom: unset;border-color:unset;">
                        <li class="nav-item">
                            <a class="nav-link {{ empty($search_data->status) ? 'active' : '' }}"
                                href="{{ route('admin.customers.index') }}">
                                Tất cả ({{ $data->total() }})
                            </a>
                        </li>

                        @foreach ($status as $status_key => $itm_status)
                            <li class="nav-item">
                                <a class="nav-link {{ !empty($search_data->status) && $search_data->status == $status_key ? 'active' : '' }}"
                                    href="{{ route('admin.customers.index', ['status' => $status_key]) }}">
                                    {{ $itm_status }}
                                    ({{ isset($data->counting[$status_key]) ? $data->counting[$status_key] : 0 }})
                                </a>
                            </li>
                        @endforeach

                        {{-- @foreach ($groups as $group)
                            <li class="nav-item">
                                <a class="nav-link @if (!empty($search_data['group_id']) && $search_data['group_id'] == $group->id) active @endif"
                                    href="{{ route('admin.customers.index', ['group_id' => $group->id]) }}">
                                    {{ $group->title ?? $group->display_name }}
                                </a>
                            </li>
                        @endforeach --}}

                        {{-- @include('customer::inc.filter',['search_data' => $search_data]) --}}
                    </ul>
                </div>


                <table class="table table-hover table-bordered mb-0" id="tableCustomer">
                    <thead>
                        <tr>
                            <th>
                                ID
                                <a href="javascript:void(0)"
                                    onclick="return addQueryParams('sort[id]', {{ !(!empty($search_data->sort['id']) ? 1 : '0') }})">
                                    <i class="fa fa-long-arrow-{{ empty($search_data->sort['id']) ? 'down' : 'up' }}"
                                        aria-hidden="true"></i>
                                </a>
                            </th>
                            <th>
                                Tên
                                <a href="javascript:void(0)"
                                    onclick="return addQueryParams('sort[fullname]', {{ !(!empty($search_data->sort['fullname']) ? 1 : '0') }})">
                                    <i class="fa fa-long-arrow-{{ empty($search_data->sort['fullname']) ? 'down' : 'up' }}"
                                        aria-hidden="true"></i>
                                </a>
                            </th>
                            <th>
                                Email
                                <a href="javascript:void(0)"
                                    onclick="return addQueryParams('sort[email]', {{ !(!empty($search_data->sort['email']) ? 1 : '0') }})">
                                    <i class="fa fa-long-arrow-{{ empty($search_data->sort['email']) ? 'down' : 'up' }}"
                                        aria-hidden="true"></i>
                                </a>
                            </th>
                            <th>
                                SĐT
                                <a href="javascript:void(0)"
                                    onclick="return addQueryParams('sort[phone]', {{ !(!empty($search_data->sort['phone']) ? 1 : '0') }})">
                                    <i class="fa fa-long-arrow-{{ empty($search_data->sort['phone']) ? 'down' : 'up' }}"
                                        aria-hidden="true"></i>
                                </a>
                            </th>
                            {{-- <th>Vai trò</th> --}}
                            {{-- <th>Nhóm KH</th> --}}
                            <th>Trạng thái</th>
                            <th>
                                Ngày tạo
                                <a href="javascript:void(0)"
                                    onclick="return addQueryParams('sort[created_at]', {{ !(!empty($search_data->sort['created_at']) ? 1 : '0') }})">
                                    <i class="fa fa-long-arrow-{{ empty($search_data->sort['created_at']) ? 'down' : 'up' }}"
                                        aria-hidden="true"></i>
                                </a>
                            </th>
                            <th>Thao tác</th>
                        </tr>

                        @if (isset($search_data['is_filter']))
                            <tr class="table-info">
                                <td colspan="8">
                                    <center class="font-weight-bold text-info">
                                        <i class="fa fa-search"></i> Tìm thấy
                                        @if ($data->total() > 0)
                                            {{ $data->firstItem() }} - {{ $data->lastItem() }} trong số
                                            {{ $data->total() }} kết quả.
                                        @else
                                            0 kết quả.
                                        @endif
                                    </center>
                                </td>
                            </tr>
                        @endif
                    </thead>

                    <tbody>
                        @forelse ($data as $customer)
                            @include('customer::inc.item', ['item' => $customer])
                        @empty
                            <tr class="table-warning">
                                <td colspan="8">
                                    Không có dữ liệu.
                                    @if (!empty($search_data))
                                        <a href="{{ route('admin.customers.index') }}">Hủy bộ lọc</a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="m-3">
                    <div class="pull-right">Tổng cộng: {{ $data->total() }} bản ghi /
                        {{ $data->lastPage() }}
                        trang
                    </div>

                    {!! $data->appends($search_data->toArray())->links('basecontainer::admin.inc.paginator') !!}
                </div>
            </div>
        </div>
    </div>

@endsection
