<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
            data-class="c-sidebar-show">
        <svg class="c-icon c-icon-lg">
            <use xlink:href="/admin/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
        </svg>
    </button>
    <a class="c-header-brand d-lg-none" href="#">
        <svg width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="/admin/assets/brand/coreui.svg#full"></use>
        </svg>
    </a>
    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
            data-class="c-sidebar-lg-show" responsive="true">
        <svg class="c-icon c-icon-lg">
            <use xlink:href="/admin/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
        </svg>
    </button>
    <ul class="c-header-nav d-md-down-none">
    </ul>
    <ul class="c-header-nav ml-auto mr-4">

        <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#"
                                                  role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar"><img class="c-avatar-img" src="{{auth()->user()->getImageUrl('small2')}}"
                                           alt="user@email.com" style="height:100%;">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">

                <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>
                <a class="dropdown-item"
                   href="{{ route('admin_profile_page') }}">
                    <svg class="c-icon mr-2">
                        <use xlink:href="/admin/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg>
                    Profile</a>

                <a class="dropdown-item" href="{{ route('post_admin_logout_form') }}">
                    <svg class="c-icon mr-2">
                        <use xlink:href="/admin/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                    </svg>
                    Logout</a>
            </div>
        </li>
    </ul>
    <div class="c-subheader px-3 d-flex">
        {!! FunctionLib::renderBreadcrumb() !!}

        <ol class="breadcrumb border-0 m-0 ml-auto">
            <li class="breadcrumb-item">@yield('right-breads')</li>
        </ol>
    </div>
</header>
