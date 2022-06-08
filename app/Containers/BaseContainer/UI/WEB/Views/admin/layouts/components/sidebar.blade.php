<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <h3><a class="text-white text-decoration-none" href="{{env('APP_URL')}}" target="_blank">{{env('APP_NAME')}}</a>
        </h3>
    </div>
    <div class="pt-2 px-4 row">
        <input type="text"
               class="form-control"
               placeholder="{{ __('menu::menu.filter') }}"
               onkeyup="return filterMenuSidebar(this.value)"
               style="font-family: Helvetica, FontAwesome;"
        />
    </div>
    <ul class="c-sidebar-nav">
        {!! $sidebarMenus !!}
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
</div>
