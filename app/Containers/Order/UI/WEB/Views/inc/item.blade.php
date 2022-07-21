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
                #{{ $order->reference_code }}
            </a>
        </p>
        <p class="mb-1">Mã đơn: <em><b>{{ $order->code }}</b></em></p>
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

    </td>
    <td>
        <b class="mb-1 text-warning"><i class="fa fa-money" aria-hidden="true"></i>
            {{ \FunctionLib::priceFormat($order->cod) }}</b>
    </td>
    <td class="text-center py-0">{{ $order->created_at }}</td>
    <td class="py-0 mb-1">
        <p class="mb-1 text-primary">
            {{ $order->shipping->title }}
        </p>
    </td>
    <td class="py-0 mb-1">
        <p class="mb-1">
            {{ $order->getOrderStatusText() }}
        </p>
        {{-- @if ($order->user)
            <p class="mb-1">Người xử lý: <b class="text-danger">{{ $order->user->name ?? $order->user->email }}</b>
            </p>
        @endif --}}
    </td>
    <td class="py-0 text-center">
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-expanded="false">
                Chọn
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @if (empty($order->send_to_shipping) && $order->isNewOrder())
                    <div class="dropdown-item">
                        <a class="text-primary" href="javascript:void(0)"
                            data-href="{{ route('admin.orders.shipping.push', [
                                'id' => $order->id,
                            ]) }}"
                            onclick="return admin.sendRequest(this)">
                            Gửi Đơn
                        </a>
                    </div>
                @endif
                <div class="dropdown-item">
                    <a class="text-primary" href="javascript:void(0)"
                        onclick="return loadIframe(this, '{{ route('admin.orders.logs', ['id' => $order->id]) }}')">
                        Lịch sử xử lý đơn hàng
                    </a>
                </div>
                {{-- <div class="dropdown-item">
                    <a class="text-primary" href="javascript:void(0)"
                        onclick="return loadIframe(this, '{{ route('admin.orders.note.index', ['orderId' => $order->id]) }}')">
                        Ghi chú
                    </a>
                </div> --}}
            </div>
        </div>
    </td>
</tr>
