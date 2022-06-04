<div class="mt-2 mb-4">
    <button type="submit" class="btn btn-sm btn-primary">
        <i class="fa fa-dot-circle-o"></i>@if (isset($editMode) && $editMode) {{__('Cập nhật')}} @else {{__('Thêm mới')}} @endif
    </button>
    &nbsp;&nbsp;
    <a class="btn btn-sm btn-danger"
       href="{{ isset($routes['list']) ? route($routes['list']) : redirect()->back()->getTargetUrl() }}">
        <i class="fa fa-ban"></i> {{__('Hủy bỏ')}}
    </a>
</div>