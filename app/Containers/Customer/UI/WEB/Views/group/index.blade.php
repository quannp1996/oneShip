@extends('basecontainer::admin.layouts.default')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card card-accent-primary">
      <div class="card-header d-flex">
        <a href="javascript:void(0)" onclick="return window.history.back();"><i class="fa fa-reply" aria-hidden="true"></i> Quay lại</a>
        <input  type="text"
                placeholder="&#xF002; Lọc nhóm khách hàng"
                class="form-control ml-auto col-4"
                onkeyup="return filterTable(this, '#tableCustomer>tbody>tr')"
                style="font-family: Helvetica, FontAwesome;" />

        <a href="javascript:void(0)" class="ml-auto" onclick="return loadIframe(this, '{{ route('admin.customers-groups.create') }}')">
          <i class="fa fa-plus" aria-hidden="true"></i>
          Tạo nhóm KH
        </a>
      </div>


      <table class="table table-hover table-bordered mb-0" id="tableCustomer">
        <thead>
          <tr>
            <th>
              ID
              <a href="javascript:void(0)" onclick="return addQueryParams('sort[id]', {{ !(!empty($input['sort']['id']) ? 1 : '0') }})">
                <i class="fa fa-long-arrow-{{ empty($input['sort']['id']) ? 'down' : 'up' }}" aria-hidden="true"></i>
              </a>
            </th>
            <th>
              Tên nhóm
              <a href="javascript:void(0)" onclick="return addQueryParams('sort[fullname]', {{ !(!empty($input['sort']['fullname']) ? 1 : '0') }})">
                <i class="fa fa-long-arrow-{{ empty($input['sort']['fullname']) ? 'down' : 'up' }}" aria-hidden="true"></i>
              </a>
            </th>
            {{-- <th>
              Email
              <a href="javascript:void(0)" onclick="return addQueryParams('sort[email]', {{ !(!empty($input['sort']['email']) ? 1 : '0') }})">
                <i class="fa fa-long-arrow-{{ empty($input['sort']['email']) ? 'down' : 'up' }}" aria-hidden="true"></i>
              </a>
            </th> --}}
            <th>
              Ngày tạo
              <a href="javascript:void(0)" onclick="return addQueryParams('sort[created_at]', {{ !(!empty($input['sort']['created_at']) ? 1 : '0') }})">
                <i class="fa fa-long-arrow-{{ empty($input['sort']['created_at']) ? 'down' : 'up' }}" aria-hidden="true"></i>
              </a>
            </th>
            <th>Chi tiết</th>
          </tr>
        </thead>

        <tbody>
            @forelse ($customerGroups as $customerGroup)
              @include('customer::group.inc.item', ['item' => $customerGroup])
            @empty
              <tr class="table-warning">
                <td colspan="8">
                  Không có dữ liệu.
                  @if (!empty($input))
                    <a href="{{ route('admin.customers-groups.index') }}">Hủy bộ lọc</a>
                  @endif
                </td>
              </tr>
            @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

@include('customer::inc.modal-iframe-edit')
@endsection
