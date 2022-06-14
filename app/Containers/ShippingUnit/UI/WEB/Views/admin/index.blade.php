@extends('basecontainer::admin.layouts.default')

@section('right-breads')
    {{-- {!! $customers->appends($input)->links('order::inc.paginator') !!} --}}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="" method="get">
                <div class="card card-accent-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                                class="fa fa-bookmark-o"></i></span></div>
                                    <input type="text" name="title" class="form-control" placeholder="Tiêu đề" value="{{ $searchData->title }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fa fa-search"></i>
                            Tìm kiếm
                        </button>
                        @can('manage-shippingunit')
                            <a href="{{ route('admin_shipping_unit_create') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus"></i>
                                Thêm mới
                            </a>
                        @endcan
                        <a href="{{ route('admin_shipping_unit_index') }}" class="btn btn-sm btn-primary btn-danger">
                            <i class="fa fa-refresh"></i>
                            Hủy
                        </a>
                    </div>
                </div>
            </form>
            <div class="card card-accent-primary">
                <table class="table table-hover table-bordered mb-0" id="tableCustomer">
                    <thead>
                        <tr>
                            <th>
                                Tên
                            </th>
                            <th>
                                Đối tác vận chuyển
                            </th>
                            <th>
                                Trạng thái
                            </th>
                            <th>
                                Hành động
                            </th>
                        </tr>
                        @if (isset($input['is_filter']))
                            <tr class="table-info">
                                <td colspan="8">
                                    <center class="font-weight-bold text-info">
                                        <i class="fa fa-search"></i> Tìm thấy
                                        @if ($customers->total() > 0)
                                            {{ $customers->firstItem() }} - {{ $customers->lastItem() }} trong số
                                            {{ $customers->total() }} kết quả.
                                        @else
                                            0 kết quả.
                                        @endif
                                    </center>
                                </td>
                            </tr>
                        @endif
                    </thead>
                    <tbody>
                        @forelse ($shippingUnits as $shipping)
                            <tr>
                                <td>
                                    {{ $shipping->title }}
                                </td>
                                <td>
                                    {{ $shipping->getTypeName() }}
                                </td>
                                <td>
                                    @if ($shipping->status == 1)
                                        <i class="fa fa-eye" class="text-success"></i>
                                    @else
                                        <i class="fa fa-eye-slash" class="text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin_shipping_unit_edit', ['id' => $shipping->id]) }}" class="btn btn-link">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    &nbsp;
                                    <a href="javascript:;" onclick="admin.delete_this(this);" data-href="{{ route('admin_shipping_unit_delete', ['id' => $shipping->id]) }}" class="btn btn-link">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="table-warning">
                                <td colspan="8">
                                    Không có dữ liệu.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
