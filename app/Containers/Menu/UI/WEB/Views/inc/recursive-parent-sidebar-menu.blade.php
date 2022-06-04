<li class='c-sidebar-nav-item c-sidebar-nav-dropdown' data-id='{{ $menu['id'] }}'>
<a  class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle"
    @if (!empty($menu['link']))
      href="{{ $menu['link'] }}"
    @else
      href="javascript:void(0);"
    @endif
>
<i class="c-sidebar-nav-icon {{ !empty($menu['icon']) ? $menu['icon'] : 'fa fa-circle-o' }} "></i>
  {{ $menu['desc_lang']['name'] ?? 'N/A' }}
    </a>


    <ul class='c-sidebar-nav-dropdown-items'>
