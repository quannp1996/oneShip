<div class="tab-pane fade show active" id="sender" role="tabpanel" aria-labelledby="sender-tab">
    <div class="admin-table mt-20" v-if="listSender && listSender.length">
        <div class="admin-table-container">
            <div class="admin-table-header">
                <table>
                    <colgroup>
                        <col style="width: 200px;" />
                        <col style="width: 172px;" />
                        <col style="width: 458px;" />
                        <col style="width: 220px;" />
                        <col style="width: 100px;" />
                    </colgroup>
                    <thead class="admin-table-thead">
                        <tr>
                            <th class="admin-table-cell">Tên đầy đủ</th>
                            <th class="admin-table-cell">Số điện thoại</th>
                            <th class="admin-table-cell">Địa chỉ</th>
                            <th class="admin-table-cell">Email</th>
                            <th class="admin-table-cell">Thao tác</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="admin-table-body">
                <div>
                    <div class="d-flex custom-row" v-for="item in listSender">
                        <div class="variable-cell" style="width: 200px;" v-if="item.is_default">
                            {{-- <span class="admin-tag admin-tag-success">Địa
                                chỉ mặc
                                định</span> --}}
                            <span v-text="item.fullname">duong</span>
                        </div>
                        <div class="variable-cell" style="width: 172px;">
                            <span v-text="item.phone"></span>
                        </div>
                        <div class="variable-cell" style="width: 458px;">
                            <span v-text="item.addressText"></span>
                        </div>
                        <div class="variable-cell" style="width: 220px;">
                            <span v-text="item.email"></span>
                        </div>
                        <div class="variable-cell" style="width: 100px;">
                            <div class="btnWrapper-table">
                                <a class="mr-12" href="javascript:;" data-toggle="modal" data-target="#edit-item-1">
                                    <svg class="" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M14.7915 2.79192C15.143 2.44045 15.7128 2.44045 16.0643 2.79192L19.4929 6.2205C19.6617 6.38928 19.7565 6.6182 19.7565 6.85689C19.7565 7.09559 19.6617 7.3245 19.4929 7.49329L10.0643 16.9219C9.89552 17.0906 9.6666 17.1855 9.4279 17.1855H5.99933C5.50227 17.1855 5.09933 16.7825 5.09933 16.2855V12.8569C5.09933 12.6182 5.19415 12.3893 5.36293 12.2205L14.7915 2.79192ZM6.89933 13.2297V15.3855H9.05511L17.5837 6.85689L15.4279 4.70111L6.89933 13.2297ZM4.24219 20.5712C4.24219 20.0741 4.64513 19.6712 5.14219 19.6712H19.7136C20.2107 19.6712 20.6136 20.0741 20.6136 20.5712C20.6136 21.0682 20.2107 21.4712 19.7136 21.4712H5.14219C4.64513 21.4712 4.24219 21.0682 4.24219 20.5712Z">
                                        </path>
                                    </svg>
                                </a>
                                <a class="" href="javascript:;" @click="openDeletePopup(item.id)">
                                    <svg class="color-f86140" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10.2831 4.39961C10.0635 4.39961 9.85468 4.48607 9.70211 4.63711C9.54985 4.78786 9.46598 4.99037 9.46598 5.19961V5.99961H14.5347V5.19961C14.5347 4.99037 14.4508 4.78786 14.2985 4.63711C14.146 4.48607 13.9371 4.39961 13.7175 4.39961H10.2831ZM16.3347 5.99961V5.19961C16.3347 4.50711 16.0567 3.84482 15.5649 3.35794C15.0734 2.87136 14.4087 2.59961 13.7175 2.59961H10.2831C9.59193 2.59961 8.92723 2.87136 8.43573 3.35794C7.94393 3.84482 7.66598 4.50711 7.66598 5.19961V5.99961H4.27305C3.77599 5.99961 3.37305 6.40255 3.37305 6.89961C3.37305 7.39667 3.77599 7.79961 4.27305 7.79961H5.09022V18.7996C5.09022 19.4921 5.36818 20.1544 5.85998 20.6413C6.35147 21.1279 7.01617 21.3996 7.70739 21.3996H16.2932C16.9845 21.3996 17.6492 21.1279 18.1407 20.6413C18.6325 20.1544 18.9104 19.4921 18.9104 18.7996V7.79961H19.7276C20.2246 7.79961 20.6276 7.39667 20.6276 6.89961C20.6276 6.40255 20.2246 5.99961 19.7276 5.99961H16.3347ZM6.89022 7.79961V18.7996C6.89022 19.0088 6.97409 19.2114 7.12636 19.3621C7.27893 19.5131 7.48776 19.5996 7.70739 19.5996H16.2932C16.5129 19.5996 16.7217 19.5131 16.8743 19.3621C17.0265 19.2114 17.1104 19.0088 17.1104 18.7996V7.79961H6.89022ZM10.2831 10.2496C10.7802 10.2496 11.1831 10.6526 11.1831 11.1496V16.2496C11.1831 16.7467 10.7802 17.1496 10.2831 17.1496C9.78609 17.1496 9.38315 16.7467 9.38315 16.2496V11.1496C9.38315 10.6526 9.78609 10.2496 10.2831 10.2496ZM13.7175 10.2496C14.2145 10.2496 14.6175 10.6526 14.6175 11.1496V16.2496C14.6175 16.7467 14.2145 17.1496 13.7175 17.1496C13.2204 17.1496 12.8175 16.7467 12.8175 16.2496V11.1496C12.8175 10.6526 13.2204 10.2496 13.7175 10.2496Z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                            <!-- Modal Delete-->
                            <div class="modal fade" id="delete-item-1" tabindex="-1" role="dialog" aria-labelledby=""
                                aria-hidden="true">
                                <div class="modal-dialog modal-sm-custom " role="document">
                                    <div class="modal-content">
                                        <div class="modal-custom-form mh-auto p-4">
                                            <div class="form-group mb-0">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="admin-modal-confirm-body d-flex align-items-center">
                                                            <span role="img" aria-label="exclamation-circle"
                                                                class="icon-svg mr-2 ">
                                                                <svg viewBox="64 64 896 896" focusable="false"
                                                                    width="1em" height="1em" fill="currentColor"
                                                                    aria-hidden="true" class="color-fe9e0f">
                                                                    <path
                                                                        d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z">
                                                                    </path>
                                                                    <path
                                                                        d="M464 688a48 48 0 1096 0 48 48 0 10-96 0zm24-112h48c4.4 0 8-3.6 8-8V296c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8z">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                            <span
                                                                class="admin-modal-confirm-title text-16 color-00112f">Bạn
                                                                có chắc muốn xoá địa chỉ người
                                                                gửi?</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div
                                                            class="modal-custom-actions d-flex align-items-center justify-content-end">
                                                            <button class="btn-themes nocolor-btn mr-2"
                                                                data-dismiss="modal" type="button">
                                                                Hủy
                                                            </button>
                                                            <button class="btn-themes color-btn" type="submit">
                                                                Xác nhận
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Edit-->
                            <div class="modal fade" id="edit-item-1" tabindex="-1" role="dialog" aria-labelledby=""
                                aria-hidden="true">
                                <div class="modal-dialog modal-md " role="document">
                                    <div class="modal-content">
                                        <div class="modal-custom-header">
                                            <div class="title">
                                                Chỉnh sửa địa chỉ người gửi
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-custom-form">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <div class="admin-form-item-label">
                                                            <label for="name" class="admin-form-item-required"
                                                                title="Họ tên">
                                                                Họ tên
                                                            </label>
                                                        </div>
                                                        <div class="admin-form-item-control">
                                                            <div class="admin-form-item-control-input">
                                                                <div class="admin-form-item-control-input-content">
                                                                    <input placeholder="Vui lòng nhập họ tên"
                                                                        id="name"
                                                                        class="admin-form-input unvalid"
                                                                        type="text" value="duong" />
                                                                    <small class="error">
                                                                        Bắt buộc
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <div class="admin-form-item-label">
                                                            <label for="mobile" class="admin-form-item-required"
                                                                title="Số điện thoại">
                                                                Số điện thoại
                                                            </label>
                                                        </div>
                                                        <div class="admin-form-item-control">
                                                            <div class="admin-form-item-control-input">
                                                                <div class="admin-form-item-control-input-content">
                                                                    <input placeholder="Vui lòng nhập số điện thoại"
                                                                        id="mobile" class="admin-form-input"
                                                                        type="text" value="039487773" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <div class="admin-form-item-label">
                                                            <label for="email" class="admin-form-item-required"
                                                                title="Email">
                                                                Email
                                                            </label>
                                                        </div>
                                                        <div class="admin-form-item-control">
                                                            <div class="admin-form-item-control-input">
                                                                <div class="admin-form-item-control-input-content">
                                                                    <input placeholder="Vui lòng nhập email"
                                                                        id="email" class="admin-form-input"
                                                                        type="text" value="duongta@gmail.com" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <div class="admin-form-item-label">
                                                            <label for="city" class="admin-form-item-required"
                                                                title="city">
                                                                Tỉnh/ Thành phố
                                                            </label>
                                                        </div>
                                                        <div class="admin-form-item-control">
                                                            <div class="dropdown dropdown-custom">
                                                                <button class=" dropdown-toggle" type="button"
                                                                    id="dropdownMenuButton" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <div class="dropdown-custom-input">
                                                                        <input type="hidden" class=""
                                                                            placeholder="" value=""
                                                                            id="">
                                                                        <span class="current-custom">
                                                                            Ha Noi </span>
                                                                    </div>
                                                                </button>
                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item" href="#">Ho Chi
                                                                        Minh</a>
                                                                    <a class="dropdown-item" href="#">Da
                                                                        Nang</a>
                                                                    <a class="dropdown-item" href="#">Ha
                                                                        Tinh</a>
                                                                    <a class="dropdown-item" href="#">Ho Chi
                                                                        Minh</a>
                                                                    <a class="dropdown-item" href="#">Da
                                                                        Nang</a>
                                                                    <a class="dropdown-item" href="#">Ha
                                                                        Tinh</a>
                                                                    <a class="dropdown-item" href="#">Ho Chi
                                                                        Minh</a>
                                                                    <a class="dropdown-item" href="#">Da
                                                                        Nang</a>
                                                                    <a class="dropdown-item" href="#">Ha
                                                                        Tinh</a>
                                                                    <a class="dropdown-item" href="#">Ho Chi
                                                                        Minh</a>
                                                                    <a class="dropdown-item" href="#">Da
                                                                        Nang</a>
                                                                    <a class="dropdown-item" href="#">Ha
                                                                        Tinh</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <div class="admin-form-item-label">
                                                            <label for="district" class="admin-form-item-required"
                                                                title="district">
                                                                Quận/ Huyện
                                                            </label>
                                                        </div>
                                                        <div class="admin-form-item-control">
                                                            <div class="admin-form-item-control-input">
                                                                <div class="admin-form-item-control-input-content">
                                                                    <input placeholder="Vui lòng nhập quận/ Huyện"
                                                                        id="district" class="admin-form-input"
                                                                        type="text" value="" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <div class="admin-form-item-label">
                                                            <label for="warp" class="admin-form-item-required"
                                                                title="warp">
                                                                Thôn/ Xóm
                                                            </label>
                                                        </div>
                                                        <div class="admin-form-item-control">
                                                            <div class="admin-form-item-control-input">
                                                                <div class="admin-form-item-control-input-content">
                                                                    <input placeholder="Vui lòng nhập thôn/ Xóm"
                                                                        id="warp" class="admin-form-input"
                                                                        type="text" value="" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <div class="admin-form-item-label">
                                                            <label for="zipcode" class="admin-form-item-required"
                                                                title="zipcode">
                                                                Mã zip code
                                                            </label>
                                                        </div>
                                                        <div class="admin-form-item-control">
                                                            <div class="admin-form-item-control-input">
                                                                <div class="admin-form-item-control-input-content">
                                                                    <input placeholder="Vui lòng nhập mã zip code"
                                                                        id="zipcode" class="admin-form-input"
                                                                        type="text" value="" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <div class="admin-form-item-label">
                                                            <label for="addr1" class="admin-form-item-required"
                                                                title="addr1">
                                                                Địa chỉ 1
                                                            </label>
                                                        </div>
                                                        <div class="admin-form-item-control">
                                                            <div class="admin-form-item-control-input">
                                                                <div class="admin-form-item-control-input-content">
                                                                    <input placeholder="Vui lòng nhập " id="addr1"
                                                                        class="admin-form-input" type="text"
                                                                        value="" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <div class="admin-form-item-label">
                                                            <label for="addr1" class="admin-form-item-required"
                                                                title="addr1">
                                                                Địa chỉ 2
                                                            </label>
                                                        </div>
                                                        <div class="admin-form-item-control">
                                                            <div class="admin-form-item-control-input">
                                                                <div class="admin-form-item-control-input-content">
                                                                    <input placeholder="Vui lòng nhập" id="addr1"
                                                                        class="admin-form-input" type="text"
                                                                        value="" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-12 mb-3">
                                                        <div class="custom-radio-input">
                                                            <input type="radio" id="type1" value="1"
                                                                name="form_check" checked="">
                                                            <label for="type1">
                                                                <span class="icon-radio mr-2"></span>
                                                                Đặt làm địa chỉ giao hàng mặc định
                                                            </label>
                                                        </div>

                                                    </div>

                                                    <div class="col-12 mb-2">
                                                        <div
                                                            class="modal-custom-actions d-flex align-items-center justify-content-end">
                                                            <button class="btn-themes nocolor-btn mr-2"
                                                                data-dismiss="modal" type="button">
                                                                Hủy
                                                            </button>
                                                            <button class="btn-themes color-btn" type="submit">
                                                                Xác nhận
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-20 mt-30 mb-50 text-center font-weight-bold text-dark" v-else>
        <img class="img-fluid" src="{{ asset('template/images/empty-img.png') }}" alt="" />
        <p>Bạn có thể cài đặt địa chỉ thường dùng của người nhận và người gửi tại đây để nâng cao
            hiệu quả quản lý vận chuyển</p>
        <a class="btn-themes color-btn" href="javascript:;" data-toggle="modal" data-target="#modalNguoiGui">
            <div class="d-flex align-items-center">
                <span class="icon-svg">
                    <svg class="" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M11.9993 4.24219C12.4964 4.24219 12.8993 4.64513 12.8993 5.14219V11.0993H18.8565C19.3535 11.0993 19.7565 11.5023 19.7565 11.9993C19.7565 12.4964 19.3535 12.8993 18.8565 12.8993H12.8993V18.8565C12.8993 19.3535 12.4964 19.7565 11.9993 19.7565C11.5023 19.7565 11.0993 19.3535 11.0993 18.8565V12.8993H5.14219C4.64513 12.8993 4.24219 12.4964 4.24219 11.9993C4.24219 11.5023 4.64513 11.0993 5.14219 11.0993H11.0993V5.14219C11.0993 4.64513 11.5023 4.24219 11.9993 4.24219Z">
                        </path>
                    </svg>
                </span>
                Tạo địa chỉ người gửi
            </div>
        </a>
    </div>
</div>
