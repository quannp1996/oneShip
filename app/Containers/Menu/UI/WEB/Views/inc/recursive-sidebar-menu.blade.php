<li class='c-sidebar-nav-item' data-id='{{ $menu['id'] }}'>
    <a  class="c-sidebar-nav-link"
      @if (!empty($menu['menu_link']))
        href="{{ $menu['menu_link'] }}"
      @else
        href="javascript:void(0);"
      @endif
    >
      {{--<span class="c-sidebar-nav-icon"></span>--}}
      <i class="c-sidebar-nav-icon {{ !empty($menu['icon']) ? $menu['icon'] : 'fa fa-circle-o' }} "></i>
      {{ $menu['desc_lang']['name'] ?? 'N/A' }}
    </a>
</li>
