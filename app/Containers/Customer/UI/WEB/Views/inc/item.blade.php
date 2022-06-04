<tr data-id="{{ $item['id'] }}">
    <td>{{ $item['id'] }}</td>
    <td>{{ $item['fullname'] }}</td>
    <td>{{ $item['email'] }}</td>
    <td>{{ $item['phone'] }}</td>
    {{-- <td>
    @if (isset($item['roles']))
      @foreach ($item['roles'] as $role)
        <span>{{ $role['display_name'] }}</span>
        @if (!$loop->last)
          ,
        @endif
      @endforeach
    @endif
  </td> --}}
    @if (1 == 0)
        <td>
            @if (isset($item['groups']))
                @php($countGroup = count($item['groups']))
                @if ($countGroup == 1)
                    @foreach ($item['groups'] as $group)
                        {{ $group['title'] }}
                    @endforeach
                @elseif ($countGroup > 1)
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuButtonGroup"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $item['groups'][0]['title'] }}, +{{ $countGroup - 1 }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonGroup">
                            @foreach ($item['groups'] as $group)
                                @if (!$loop->first)
                                    <a class="dropdown-item" href="#">{{ $group['title'] }}</a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else

                @endif
            @endif
        </td>
    @endif
    <td>
      <span class="badge badge-{{!empty($item['status']) ? \App\Containers\Customer\Enums\CustomerStatus::CLASS_CSS[$item['status']] : 'secondary'}}">{{!empty($item['status']) ? \App\Containers\Customer\Enums\CustomerStatus::TEXT[$item['status']] : 'Không xác định'}}</span>
    </td>
    <td>{{ $item['created_at'] }}</td>
    <td>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button"
                id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                Chọn
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <input type="hidden" class="customer-hidden" value='@bladeJson($item)'>

                <div class="dropdown-item">
                    <a class="text-primary" href="javascript:void(0)"
                        onclick="return loadIframe(this, '{{ route('admin.customers.edit', ['id' => $item['id']]) }}')">
                        <i class="fa fa-pencil"></i> Sửa thông tin khách hàng
                    </a>
                </div>

                <div class="dropdown-item">
                    <a class="text-primary" href="javascript:void(0)"
                        onclick="return loadIframe(this, '{{ route('admin.customers.log_referral', ['id' => $item['id']]) }}')">
                        <i class="fa fa-history"></i> Quản trị log giới thiệu
                    </a>
                </div>

                <div class="dropdown-item">
                    <a class="text-primary" href="javascript:void(0)" onclick="return deleteCustomer(this)">
                        <i class="fa fa-trash"></i> Xóa khách hàng
                    </a>
                </div>
            </div>
        </div>
    </td>
</tr>
