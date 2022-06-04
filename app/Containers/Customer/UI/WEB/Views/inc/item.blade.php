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
  @if(1 == 0)
  <td>
    @if (isset($item['groups']))
      @php($countGroup = count($item['groups']))
      @if ($countGroup == 1)
        @foreach ($item['groups'] as $group)
          {{ $group['title'] }}
        @endforeach
      @elseif ($countGroup > 1)
        <div class="dropdown">
          <a  class="dropdown-toggle"
              href="#"
              role="button"
              id="dropdownMenuButtonGroup"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false">
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
  <td>{{ $item['created_at'] }}</td>
  <td>
    <!-- Example split danger button -->
    <div class="btn-group">
      <a  href="#"
          role="button"
          id="dropdownMenuLink"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false">
        Chọn <i class="fa fa-angle-down"></i>
      </a>
      <div class="dropdown-menu">
        <input type="hidden" class="customer-hidden" value='@bladeJson($item)'>
        <a  class="dropdown-item"
            href="javascript:void(0)"
            onclick="return loadIframe(this, '{{ route('admin.customers.edit', ['id' => $item['id']]) }}')">
            Sửa thông tin khách hàng
        </a>
        {{-- <a class="dropdown-item" href="#">Xem thông tin khách hàng</a> --}}
        <a  class="dropdown-item"
            href="javascript:void(0)"
            onclick="return deleteCustomer(this)">
            Xóa khách hàng
        </a>
      </div>
    </div>
  </td>
</tr>
