<div class="d-flex justify-content-between mt-20">
    <div class="title text-24 lh-32">
        Danh sách địa chỉ
    </div>
    <div class="position-relative">
        <div class="btn-themes color-btn dropdown-hover">
            <div class="d-flex align-items-center">
                <span class="icon-svg">
                    <svg class="" focusable="false" viewBox="0 0 24 24" aria-hidden="true"
                        style="color: rgb(255, 255, 255);stroke: transparent;fill: currentColor;">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M11.9993 4.24219C12.4964 4.24219 12.8993 4.64513 12.8993 5.14219V11.0993H18.8565C19.3535 11.0993 19.7565 11.5023 19.7565 11.9993C19.7565 12.4964 19.3535 12.8993 18.8565 12.8993H12.8993V18.8565C12.8993 19.3535 12.4964 19.7565 11.9993 19.7565C11.5023 19.7565 11.0993 19.3535 11.0993 18.8565V12.8993H5.14219C4.64513 12.8993 4.24219 12.4964 4.24219 11.9993C4.24219 11.5023 4.64513 11.0993 5.14219 11.0993H11.0993V5.14219C11.0993 4.64513 11.5023 4.24219 11.9993 4.24219Z">
                        </path>
                    </svg>
                </span>
                Tạo địa chỉ
            </div>
            <div class="dropdown-trigger-content">
                <ul class="list-unstyled p-0 m-0">
                    <li class="item">
                        <a href="javascript:;" data-toggle="modal" data-target="#modalNguoiNhan">
                            Người nhận
                        </a>
                    </li>
                    <li class="item">
                        <a href="javascript:;" data-toggle="modal" data-target="#modalNguoiGui">
                            Người gửi
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Modal Nguoi Gui-->
    @include('frontend::address.sections.modal.sender')
    <!-- Modal Nguoi Nhan-->
    @include('frontend::address.sections.modal.receiver')
</div>
