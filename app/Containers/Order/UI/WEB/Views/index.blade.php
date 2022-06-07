@extends('basecontainer::admin.layouts.default')

@section('right-breads')
    {!! $orders->appends($search_data->toArray())->links('basecontainer::admin.inc.paginator') !!}
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="mb-5">
                <h1>{{ $site_title }}</h1>
            </div>
            @include('basecontainer::admin.inc.alert-errors-top-index')
            @include('order::inc.forms.filter-form',['search_data' => $search_data])
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 position-relative">
            <div class="card card-accent-primary">
                <div class="card-header d-flex py-0">
                    <ul class="nav nav-tabs nav-underline nav-underline-primary card-header-tabs"
                        style="border-bottom: unset;border-color:unset;">
                        <li class="nav-item">
                            <a class="nav-link {{ empty($search_data->status) && empty($search_data->payment_status) ? 'active' : '' }}"
                                href="{{ route('admin.orders.index') }}">
                                Tất cả đơn
                            </a>
                        </li>
                        @foreach ($ordersType as $k => $v)
                            <i class="fa fa-angle-right mt-2 pt-1" aria-hidden="true"></i>

                            <li class="nav-item">
                                <a class="nav-link {{ $k == @$search_data->status ? 'active' : '' }}"
                                    href="{{ route('admin.orders.index', ['status' => $k, 'text' => $v]) }}">
                                    {{ $v }}
                                </a>
                            </li>
                        @endforeach
                        @foreach ($orderPaymmentStatus as $key => $payment_status)
                            <i class="fa fa-angle-right mt-2 pt-1" aria-hidden="true"></i>
                            <li>
                                <a class="nav-link {{ @$search_data->payment_status == $key ? 'active' : '' }}"
                                    href="{{ route('admin.orders.index', ['payment_status' => $key, 'text' => $payment_status]) }}">
                                    {{ $payment_status }}
                                </a>
                            </li>
                        @endforeach
                        {{-- @include('order::inc.filter') --}}
                    </ul>
                </div>
                <table class="table table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Chi phí</th>
                            <th>Thành tiền</th>
                            <th class="text-center">Ngày đặt</th>
                            <th class="text-center">Thanh toán</th>
                            <th class="text-center">Tiến trình xử lý đơn</th>
                            <th class="text-center p-0">Thao tác</th>
                        </tr>

                        @if (isset($search_data['is_filter']))
                            <tr class="table-info">
                                <td colspan="8">
                                    <center class="font-weight-bold text-info">
                                        <i class="fa fa-search"></i> Tìm thấy
                                        @if ($orders->total() > 0)
                                            {{ $orders->firstItem() }} - {{ $orders->lastItem() }} trong số
                                            {{ $orders->total() }} kết quả.
                                        @else
                                            0 kết quả.
                                        @endif
                                    </center>
                                </td>
                            </tr>
                        @endif
                    </thead>

                    <tbody>
                        @if ($orders->count())
                            @foreach ($orders as $order)
                                @include('order::inc.item', ['order' => $order])
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">Không có thông tin đơn hàng.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <div class="m-3">
                    <div class="pull-right">Tổng cộng: {{ $orders->total() }} bản ghi /
                        {{ $orders->lastPage() }}
                        trang
                    </div>

                    {!! $orders->appends($search_data->toArray())->links('basecontainer::admin.inc.paginator') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
