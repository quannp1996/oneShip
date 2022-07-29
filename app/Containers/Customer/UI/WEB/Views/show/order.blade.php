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
                <th scope="col">Trạng thái Vận chuyển</th>
                <th scope="col">Ngày bắt đầu vận chuyển</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customer->orders as $item)
                <tr>
                    <td scope="col">{{ $item->code }}</td>
                    <td scope="col">{{ $item->cod }}</td>
                    <td scope="col">{{ $item->cod }}</td>
                    <td scope="col">{{ $item->cod }}</td>
                    <td scope="col">Trạng thái đơn hàng</td>
                    <td scope="col">{{ $item->created_at->format('H:i:s d/m/Y') }}</td>
                    <td scope="col">Trạng thái Vận chuyển</td>
                    <td scope="col">Ngày bắt đầu vận chuyển</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6"> Chưa có thông tin đặt hàng </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
