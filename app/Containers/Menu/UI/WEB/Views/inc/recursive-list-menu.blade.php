<li class='dd-item' data-id='{{ $menuId }}'>
  <div class='dd3-content' style='min-width: 270px'>
      <span class="menu-title">
          <span class='text' style='float: left;'>{{ $menuId }}. {{ $name }}</span>
          <span class="pull-right">
            <a href="{{ route('admin_'.$key.'_edit', $menuId) }}" title="Sửa"><i class="fa fa-pencil"></i></a>
            <a href="javascript:void(0)"
                class="ml-2" title="Xóa"
                onclick="return removeMenu(this, '{{ $menuId }}')">
                <i class="fa fa-trash"></i>
            </a>
        </span>
    </span>
  </div>

  <div class="dd-handle dd3-handle"></div>
</li>