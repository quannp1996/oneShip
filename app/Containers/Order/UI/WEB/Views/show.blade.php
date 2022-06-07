@extends('basecontainer::admin.layouts.default_for_iframe')
@section('content')
    <div class="row" id="sectionContent">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-header d-flex">
                    <button class="btn btn-link">Thông tin đơn hàng: <strong>{{ $order->code }}</strong></button>
                    <button type="button" class="btn btn-secondary ml-auto mr-2" onclick='return closeFrame()'>Đóng
                        lại</button>
                    @include('order::inc.order-handle-btn')
                </div>

                <div class="card-body">
                    <ul class="nav nav-tabs nav-underline nav-underline-primary">
                        <li class="nav-item">
                            <a class="nav-link active" href="#don_hang" data-toggle="tab" role="tab"
                                aria-controls="don_hang">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Thông tin đơn hàng
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="#khach_hang" data-toggle="tab" role="tab"
                                aria-controls="khach_hang">
                                <i class="fa fa-user" aria-hidden="true"></i> Thông tin khách mua
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="#note" data-toggle="tab" role="tab" aria-controls="note">
                                <i class="fa fa-sticky-note-o" aria-hidden="true"></i> Ghi chú
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane" id="khach_hang" role="tabpanel" aria-labelledby="khach_hang">

                            <div class="mt-2">
                                <p>
                                    <i class="fa fa-user"></i> Họ tên: {{ ucwords($order->fullname) }}
                                </p>

                                <p>
                                    <i class="fa fa-envelope-o"></i> Email:
                                    @if (!empty($order->email))
                                        <a href="mailto:{{ $order->email }}">{{ $order->email }}</a>
                                    @else
                                        Đang cập nhật
                                    @endif
                                </p>

                                <p>
                                    <i class="fa fa-mobile"></i> SĐT:
                                    @if (!empty($order->phone))
                                        {{ $order->phone }}
                                    @else
                                        Đang cập nhật
                                    @endif
                                </p>

                                <p>
                                    <i class="fa fa-home"></i> Địa chỉ nhận hàng:
                                    {{ $order->stringAddress() }}
                                </p>

                                <p>
                                    <i class="fa fa-clock"></i> Đặt hàng lúc:
                                    {{ $order->created_at }}
                                </p>

                                <p>
                                    Ghi chú KH: <b>{{$order->note}}</b>
                                </p>
                            </div>
                        </div>

                        <div class="tab-pane fade show active" id="don_hang" role="tabpanel" aria-labelledby="don_hang">

                            <div class="mt-2">
                                <p class="font-weight-bold">ID: <span class="text-primary">{{ $order->id }}</span></p>
                                <p class="font-weight-bold">Mã đơn: <span class="text-primary">{{ $order->code }}</span>
                                </p>
                                <p class="font-weight-bold">Hình thức thanh toán: <span
                                        class="text-info">{{ $order->getPaymentText() }}</span></p>

                                <p class="font-weight-bold">
                                    Trạng thái thanh toán:
                                    <span class="text-{{ $order->isPaymentStatusSuccess() ? 'success' : 'dark' }}">
                                        {{ $order->getPaymentStatusText() }}
                                    </span>
                                </p>

                                <p class="font-weight-bold">
                                    Trạng thái xử lý đơn:
                                    <span
                                        class="{{ $order->getOrderStatusCssClass() }}">{{ $order->getOrderStatusText() }}</span>
                                </p>

                                <p>
                                    <strong>Người xử lý đơn hàng:</strong>
                                    @if ($order->user)
                                        {{ $order->user->name }} <{{ $order->user->email }}>
                                        @else
                                            Chưa có thông tin người xử lý
                                    @endif
                                </p>

                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="table-info">
                                            <th>#</th>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th class="text-right">Giá/Sản phẩm</th>
                                            <th class="text-right">Thành tiền</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($order->orderItems->isNotEmpty())
                                            @foreach ($order->orderItems as $orderItem)
                                                <tr class="{{$orderItem->variant_parent_id > 0 ? 'small text-primary' : ''}}">
                                                    <td>
                                                        <span class="d-block">OrderItem ID: {{ $orderItem->id }}</span>
                                                        <span class="d-block">Variant ID: {{ $orderItem->variant_id }}</span>
                                                        <span class="d-block">Product ID: {{ $orderItem->product_id }}</span>
                                                    </td>
                                                    <td>
                                                        @if($orderItem->variant_parent_id > 0)
                                                        <b class="badge badge-danger">Sản phẩm tặng kèm</b>
                                                        @endif
                                                        <div>{{ $orderItem->name }}</div>
                                                        @php($opts = json_decode($orderItem->opts))
                                                        @if ($opts)
                                                            @foreach ($opts as $opt)
                                                                <small
                                                                    class="text-danger d-block">{{ $opt->option_name . ': ' . $opt->option_value }}</small>
                                                            @endforeach
                                                        @endif

                                                        @php($specialOffers = json_decode($orderItem->special_offers))
                                                        @if ($specialOffers)
                                                            @foreach ($specialOffers as $offer)
                                                                <span
                                                                    class="c-callout c-callout-danger d-block">{{ $offer->name }}
                                                                </span>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>{{ $orderItem->quantity }}</td>
                                                    <td class="text-right">{{ $orderItem->price_currency }}</td>
                                                    <td class="text-right">
                                                        {{ $orderItem->total_price_product_currency }}</td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <td colspan="4" class="text-right"><strong>Phí ship</strong></td>
                                                <td class="text-right">{{ $order->fee_ship_currency }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-right"><strong>Giảm giá {{$order->coupon_code ? '('.$order->coupon_code.')' : ''}}</strong></td>
                                                <td class="text-right">- {{ \FunctionLib::priceFormat($order->coupon_value) }}</td>
                                            </tr>
                                            @if(isset($order->point_value) && $order->point_value > 0)
                                            <tr>
                                              <td colspan="4" class="text-right"><strong>Điểm sử dụng: {{$order->point_value}}</strong></td>
                                              <td class="text-right">- {{ \FunctionLib::priceFormat($order->point_value*$order->point_rate) }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td colspan="4" class="text-right"><strong>Thành tiền</strong></td>
                                                <td class="text-right text-info font-weight-bold">
                                                    {{ \FunctionLib::priceFormat($order->total_price+$order->fee_shipping-$order->point_value*$order->point_rate) }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="note" role="tabpanel" aria-labelledby="note">

                            <div class="mt-2" id="list-order-note">
                                @if ($order->notes->isNotEmpty())
                                    @foreach ($order->notes->sortDesc() as $note)
                                        @include('order::note.note-item', ['item' => $note])
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div><!-- /.Card-body -->
            </div><!-- /.End card -->
        </div>
    </div>
@endsection
