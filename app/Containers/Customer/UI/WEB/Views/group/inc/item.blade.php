<tr data-id="{{ $item['id'] }}">
    <td>{{ $item['id'] }}</td>
    <td>{{ $item['title'] }}</td>
    {{-- <td>{{ $item['sort'] }}</td> --}}
    <td>{{ \FunctionLib::dateFromObj($item['created_at']) }}</td>
    <td>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Thao tác
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <input type="hidden" class="customerGroupHidden" value='@bladeJson($item)'>
                <a class="dropdown-item" href="javascript:void(0)"
                    onclick="return loadIframe(this, '{{ route('admin.customers-groups.edit', ['id' => $item['id']]) }}')">Sửa
                    thông tin nhóm</a>
                <a class="dropdown-item" href="javascript:void(0)" onclick="return deleteCustomerGroup(this)">Xóa thông
                    tin nhóm</a>
            </div>
        </div>
    </td>
</tr>
