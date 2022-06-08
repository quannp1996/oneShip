<tr class="font-sm {{ $order->isCancelOrder() ? 'table-danger' : '' }}"
    ondblclick="return loadIframe(this, '{{ route('admin.orders.show', ['id' => $order->id]) }}')">
    <td class="py-0">
        <p class="mb-1">
            ID:
            <a href="javascript:void(0)" class="font-italic"
                onclick="return loadIframe(this, '{{ route('admin.orders.show', ['id' => $order->id]) }}')">
                #{{ $order->id }}
            </a>
        </p>
        <p class="mb-1">
            EID:
            <a href="javascript:void(0)" class="font-italic"
                onclick="return loadIframe(this, '{{ route('admin.orders.show', ['id' => $order->id]) }}')">
                #{{ $order->eshop_order_id }}
            </a>
        </p>
        <p class="mb-1">Mã đơn: <em><b>{{ $order->code }}</b></em></p>
        <p class="mb-1">
            @if ($order->logs->isNotEmpty())
                <img src="{{ asset('admin/img/discount/email.png') }}" title="Đã gửi mail cho khách">
            @endif

            @if (!empty($order->coupon_code))
                <img src="{{ asset('admin/img/discount/discount-money.png') }}" data-toggle="tooltip"
                    data-placement="bottom" title="Sử dụng mã giảm giá: {{ $order->coupon_code }}">
            @endif
        </p>
    </td>
    <td class="py-1">
        <p class="mb-1"><i class="fa fa-user"></i> &nbsp;{{ ucwords($order->fullname) }}</p>

        @if (!empty($order->email))
            <p class="mb-1"><b>@</b> <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
        @endif

        @if (!empty($order->phone))
            <p class="mb-1"><i class="fa fa-mobile"></i> &nbsp;&nbsp;{{ $order['phone'] }}</p>
        @endif
    </td>
    <td class="py-0">
        <p class="mb-1"><i class="fa fa-truck" aria-hidden="true"></i> Phí ship:
            {{ $order->fee_ship_currency }}</p>
        <p class="mb-1"><i class="fa fa-money" aria-hidden="true"></i> Giảm giá: -
            {{ \FunctionLib::priceFormat($order->coupon_value) }}
            @if (isset($order->point_value) && $order->point_value > 0)
                <p class="mb-1"><i class="fa fa-exchange" aria-hidden="true"></i> Point: -
                    {{ \FunctionLib::priceFormat($order->point_value * $order->point_rate) }}
            @endif
            {{-- <p class="mb-1"><i class="fa fa-money" aria-hidden="true"></i> Tổng tiền: {{ $order->total_price_currency }} --}}
        </p>
    </td>
    <td>
        @if (isset($order->point_value) && $order->point_value > 0)
            <b class="mb-1 text-warning"><i class="fa fa-money" aria-hidden="true"></i>
                {{ \FunctionLib::priceFormat($order->fee_shipping + $order->total_price - $order->point_value * $order->point_rate) }}</b>
        @else
            <b class="mb-1 text-warning"><i class="fa fa-money" aria-hidden="true"></i>
                {{ \FunctionLib::priceFormat($order->fee_shipping + $order->total_price) }}</b>
        @endif
    </td>
    <td class="text-center py-0">{{ $order->created_at }}</td>
    <td class="py-0 mb-1">
        <p class="mb-1 text-primary"><i class="fa fa-credit-card" title="Hình thức thanh toán" aria-hidden="true"></i>
            {{ $order->getPaymentText() }}</p>
        <p class="mb-1">
            @if ($order->isPaymentStatusSuccess())
                <strong class="text-success">
                    <i class="fa fa-opencart" aria-hidden="true"></i>
                    {{ $order->getPaymentStatusText() }}
                </strong>
            @else
                <strong class="text-danger">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ $order->getPaymentStatusText() }}
                </strong>
            @endif

        </p>
    </td>
    <td class="py-0 mb-1">
        <p class="mb-1"><i class="fa fa-truck" aria-hidden="true"></i> {{ $order->getDeliveryText() }}
        </p>

        <p class="mb-1">
            {{ $order->getOrderStatusText() }}
        </p>
        @if ($order->user)
            <p class="mb-1">Người xử lý: <b
                    class="text-danger">{{ $order->user->name ?? $order->user->email }}</b></p>
        @endif
    </td>
    <td class="py-0 text-center">

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-expanded="false">
                Chọn
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <div class="dropdown-item">
                    <a class="text-primary" href="javascript:void(0)"
                        onclick="return loadIframe(this, '{{ route('admin.orders.show', ['id' => $order->id]) }}')">
                        Xử lý đơn hàng
                    </a>
                </div>

                <div class="dropdown-item">
                    <a class="text-primary" href="javascript:void(0)"
                        onclick="return loadIframe(this, '{{ route('admin.orders.logs', ['id' => $order->id]) }}')">
                        Lịch sử xử lý đơn hàng
                    </a>
                </div>
                <div class="dropdown-item">
                    <a class="text-primary" href="javascript:void(0)"
                        onclick="return loadIframe(this, '{{ route('admin.orders.note.index', ['orderId' => $order->id]) }}')">
                        Ghi chú
                    </a>
                </div>
            </div>
        </div>
    </td>
</tr>
