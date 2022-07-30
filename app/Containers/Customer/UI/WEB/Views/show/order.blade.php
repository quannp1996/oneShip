<div class="tab-pane" id="order">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Mã Đơn</th>
                <th scope="col">COD</th>
                <th scope="col">Thông tin người nhận</th>
                <th scope="col">Thông tin người gửi</th>
                <th scope="col">Trạng thái đơn hàng</th>
                <th scope="col">Ngày đặt đơn</th>
                {{-- <th scope="col">Trạng thái Vận chuyển</th>
                <th scope="col">Ngày bắt đầu vận chuyển</th> --}}
            </tr>
        </thead>
        <tbody>
            @forelse ($customer->orders as $item)
                <tr>
                    <td scope="col"><b>{{ $item->code }}</b></td>
                    <td scope="col">{{ \FunctionLib::priceFormat($item->cod) }}</td>
                    <td scope="col">
                        <p class="mb-1"><i class="fa fa-user"></i> &nbsp;{{ ucwords($item->receiver_fullname) }}</p>
                        @if (!empty($item->receiver_email))
                            <p class="mb-1"><b>@</b> <a href="mailto:{{ $item->email }}">{{ $item->receiver_email }}</a></p>
                        @endif

                        @if (!empty($item->receiver_phone))
                            <p class="mb-1"><i class="fa fa-mobile"></i> &nbsp;&nbsp;{{ $item->receiver_phone }}</p>
                        @endif
                    </td>
                    <td scope="col">
                        <p class="mb-1"><i class="fa fa-user"></i> &nbsp;{{ ucwords($item->sender_fullname) }}</p>
                        @if (!empty($item->sender_email))
                            <p class="mb-1"><b>@</b> <a href="mailto:{{ $item->email }}">{{ $item->sender_email }}</a></p>
                        @endif

                        @if (!empty($item->sender_phone))
                            <p class="mb-1"><i class="fa fa-mobile"></i> &nbsp;&nbsp;{{ $item->sender_phone }}</p>
                        @endif
                    </td>
                    <td scope="col">{{  $item->getOrderStatusText()  }}</td>
                    <td scope="col">{{ $item->created_at->format('H:i:s d/m/Y') }}</td>
                    {{-- <td scope="col">Trạng thái Vận chuyển</td>
                    <td scope="col">Ngày bắt đầu vận chuyển</td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="6"> Chưa có thông tin đặt hàng </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
