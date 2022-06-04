<li class="nav-item">
  <a href="javascript:void(0)" class="ml-auto nav-link" data-toggle="modal" data-target="#boLocKhachHang">
    <i class="fa fa-filter" aria-hidden="true"></i> Bộ lọc
  </a>
</li>

<li class="nav-item">
  <a  href="javascript:void(0)"
      class="ml-auto nav-link"
      onclick="return loadIframe(this, '{{ route('admin.customers.create') }}')">
    <i class="fa fa-plus" aria-hidden="true"></i> Tạo khách hàng
  </a>
</li>

<!-- Modal -->
<div class="modal fade" id="boLocKhachHang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <form action="{{ route('admin.customers.index') }}" class="form-horizontal" method="GET">
        <input type="hidden" name="is_filter" value="1">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Bộ lọc khách hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          @include('customer::inc.filter_inputs',['search_data' => $search_data])

          {{-- <div class="row mt-2">
            <div class="col-4">
              <label for="">Vai trò</label>
              <select name="roles_ids[]" id="roles_ids" class="form-control select2" multiple style="width: 100%;">
                @if ($roles->isNotEmpty())
                  @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @if (in_array($role->id, $input['roles_ids'] ?? [])) selected @endif>{{ $role->display_name }}</option>
                  @endforeach
                @endif
              </select>
            </div>
          </div> --}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary">Duyệt</button>
      </div>
    </form>
    </div>
  </div>
</div>
