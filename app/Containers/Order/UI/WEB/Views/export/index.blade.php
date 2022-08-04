<table>
    <thead>
        <tr style="background: grey">
            <th>Mã đơn</th>
            <th>Đơn vị vận chuyển</th>
            <th>Người gửi</th>
            <th>Người nhận</th>
            <th>Trạng thái</th>
            <th>Ghi chú</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->code }}</td>
                <td>{{ $order->shipping->title }}</td>
                <td>{{ $order->sender_fullname }}</td>
                <td>{{ $order->receiver_fullname }}</td>
                <td>{{ $order->getOrderStatusText() }}</td>
                <td>{{ $order->note }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
