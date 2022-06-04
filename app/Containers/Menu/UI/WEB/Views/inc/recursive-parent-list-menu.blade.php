<li class='dd-item' data-id='{{ $menuId }}'>
  <div class='dd3-content' style='min-width: 250px'>
      <span>{{ $menuId }}. {{ $name }}</span>

      <span class="pull-right">
          <a href="{{ route('admin_'.$key.'_edit', $menuId) }}" title="Sửa"><i class="fa fa-pencil"></i></a>

          @if (!$hasChild)
              <a href="{{ route('admin_'.$key.'_delete', $menuId) }}" class="ml-2" title="Xóa"><i class="fa fa-trash"></i></a>
          @endif
      </span>
  </div>

  <div class="dd-handle dd3-handle"></div>
  <ol class='dd-list'>
