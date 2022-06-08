<div class="dropdown">
  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Xử lý đơn
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    @if ($order->canReceiveOrder())
      <button type="button"
              class="dropdown-item"
              onclick="alertChangeOrderState('{!! route('admin.orders.process.accept', ['id' => $order->id]) !!}', 'Tiếp nhận đơn hàng');">
              Tiếp nhận đơn
      </button>
      {{-- <a class="dropdown-item" href="#">Gán tiếp nhận đơn</a> --}}
    @elseif(!$order->canProcessOrder())
        <button type="button"
                class="dropdown-item"
                onclick="alertChangeOrderState('{!! route('admin.orders.process.accept-again', ['id' => $order->id]) !!}', 'Tiếp lại nhận đơn hàng');">
                Tiếp nhận lại đơn
        </button>
    @elseif($order->isReceiveOrder())
      <button type="button"
                class="dropdown-item"
                onclick="alertChangeOrderState('{!! route('admin.orders.process.export', ['id' => $order->id]) !!}', 'Xác nhận đơn hàng đã xuất khỏi kho');">
                Đánh dấu là đơn hàng &nbsp; <strong> Xuất khỏi kho </strong>
      </button>
    @elseif($order->isExportOrder())
      <button type="button"
                class="dropdown-item"
                onclick="alertChangeOrderState('{!! route('admin.orders.process.delivering', ['id' => $order->id]) !!}', 'Xác nhận đơn hàng đang được giao');">
                Đánh dấu là đơn hàng &nbsp; <strong> Đang giao </strong>
      </button>
    @elseif($order->isDeliveryOrder())
      <button type="button"
                class="dropdown-item"
                onclick="alertChangeOrderState('{!! route('admin.orders.process.deliveried', ['id' => $order->id]) !!}', 'Xác nhận đơn hàng đã giao thành công');">
                Đánh dấu là đơn hàng &nbsp; <strong> Giao thành công </strong>
      </button>
    @elseif($order->isDeliveriedOrder())
      <button type="button"
                class="dropdown-item"
                onclick="alertChangeOrderState('{!! route('admin.orders.process.finish', ['id' => $order->id]) !!}', 'Xác nhận đơn hàng đã hoàn thành');">
                Đánh dấu là đơn hàng &nbsp; <strong> Hoàn thành </strong>
      </button>
    @endif
    @if ($order->isReceiveOrder() && $order->canProcessOrder())
      <button type="button"
              class="dropdown-item"
              onclick="alertChangeOrderState('{!! route('admin.orders.process.un-accept', ['id' => $order->id]) !!}', 'Bỏ tiếp nhận đơn');">
              Bỏ tiếp nhận đơn
      </button>
      {{-- @if (!$order->isPaymentStatusSuccess())
        <button type="button"
                class="dropdown-item"
                onclick="alertChangeOrderState('{!! route('admin.orders.process.waiting-paid', ['id' => $order->id]) !!}', 'Đánh dấu là đơn hàng chờ thanh toán');">
                Đánh dấu là đơn hàng chờ thanh toán
        </button>
      @else
        <button type="button"
                class="dropdown-item"
                onclick="alertChangeOrderState('{!! route('admin.orders.process.confirm-paid', ['id' => $order->id]) !!}', 'Đánh dấu là đơn hàng đã thanh toán');">
                Đánh dấu là đơn hàng đã thanh toán
        </button>
      @endif --}}
    @endif
    @if ($order->isWaitForPaidOrder())
      <button type="button"
              class="dropdown-item"
              onclick="alertChangeOrderState('{!! route('admin.orders.process.confirm-paid', ['id' => $order->id]) !!}', 'Đánh dấu là đơn hàng đã thanh toán');">
              Đánh dấu là đơn hàng đã thanh toán
      </button>
    @else
      <button type="button"
          class="dropdown-item"
          onclick="alertChangeOrderState('{!! route('admin.orders.process.waiting-paid', ['id' => $order->id]) !!}', 'Đánh dấu là đơn hàng chờ thanh toán');">
          Đánh dấu là đơn hàng chờ thanh toán
      </button>
    @endif
    @if ($order->isPaidOrder() && $order->isDeliveriedOrder())
      <button type="button"
          class="dropdown-item"
          onclick="alertChangeOrderState('{!! route('admin.orders.process.finish', ['id' => $order->id]) !!}', 'Đánh dấu là đơn hàng hoàn thành');">
          Đánh dấu là đơn hàng hoàn thành
      </button>
    @endif
    <!-- Hoàn tiền đơn hàng -->
    @if ($order->canRefundOrder())
      <button type="button"
          class="dropdown-item"
          onclick="alertChangeOrderState('{!! route('admin.orders.process.refund', ['id' => $order->id]) !!}', 'Đánh dấu là đơn hoàn tiền');">
          Đánh dấu là đơn hoàn tiền
      </button>
    @endif
    <!-- Hủy đơn hàng -->
    @if ($order->canCancelOrder())
      <button type="button"
          class="dropdown-item"
          onclick="alertChangeOrderState('{!! route('admin.orders.process.cancel', ['id' => $order->id]) !!}', 'Hủy đơn');">
          Hủy đơn
      </button>
    @endif
    {{-- <a class="dropdown-item" href="#">Sửa thông tin đơn</a> --}}

    <div class="dropdown-divider"></div>
    <a  class="dropdown-item"
        href="javascript:void(0)"
        onclick="return loadIframe(this, '{{ route('admin.orders.logs', ['id' => $order->id]) }}')">
        <i class="fa fa-clock-o mr-2" aria-hidden="true"></i> Lịch sử xử lý đơn hàng
    </a>

    <a  class="dropdown-item"
        href="javascript:void(0)"
        onclick="return loadIframe(this, '{{ route('admin.orders.note.create', ['orderId' => $order->id]) }}')">
        <i class="fa fa-sticky-note-o mr-2" aria-hidden="true"></i> Tạo ghi chú
    </a>

    <div class="dropdown-divider"></div>
    <a  class="dropdown-item"
        href="javascript:void(0)"
        onclick="return alertChangeOrderState('{!! route('admin.orders.process.resend-mail', ['id' => $order->id]) !!}', 'Gửi thông tin đơn hàng cho khách');">
        <i class="fa fa-envelope-o mr-2" aria-hidden="true"></i> Gửi mail thông tin đơn hàng cho khách
    </a>

    {{-- <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Kiểm tra thông tin thanh toán</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Giao vận: Đánh dấu là đang giao hàng</a>
    <a class="dropdown-item" href="#">Giao vận: Đánh dấu là đã giao hàng thành công</a> --}}
  </div>
</div>
