<tr data-id="{{ $item['id'] }}">
    <td>{{ $item['id'] }}</td>
    <td>{{ $item['fullname'] }}</td>
    <td>{{ $item['email'] }}</td>
    <td>{{ $item['phone'] }}</td>
    <td>{{ $item['created_at'] }}</td>
    <td>
        <div class="btn-group">
            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Chọn <i class="fa fa-angle-down"></i>
            </a>
            <div class="dropdown-menu">
                <input type="hidden" class="customer-hidden" value='@bladeJson($item)'>
                <a class="dropdown-item" href="{{ route('admin.customers.show', ['id' => $item['id']]) }}">
                    <i class="fa fa-eye"></i>
                    &nbsp;
                    Xem thông tin khách hàng
                </a>
                @if ($item['status'] == 2)
                    <a class="dropdown-item" href="javascript:void(0)" onclick="return deleteCustomer(this)">
                        <i class="fa fa-ban"></i>
                        &nbsp;
                        Khóa khách hàng
                    </a>
                @else
                @endif
            </div>
        </div>
    </td>
</tr>
