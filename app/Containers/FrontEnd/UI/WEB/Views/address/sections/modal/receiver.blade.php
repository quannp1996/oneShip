<div class="modal fade" id="modalNguoiNhan" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-md " role="document">
        <div class="modal-content">
            <div class="modal-custom-header">
                <div class="title">
                    Lưu địa chỉ người nhận để giao hàng dễ dàng hơn
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-custom-form">
                <form action="#" @submit.prevent="store(1)">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="admin-form-item-label">
                                    <label for="name" class="admin-form-item-required" title="Họ tên">
                                        Họ tên
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Vui lòng nhập họ tên" id="name"
                                                class="admin-form-input" v-model="receiverForm.fullname" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="admin-form-item-label">
                                    <label for="mobile" class="admin-form-item-required" title="Số điện thoại">
                                        Số điện thoại
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Vui lòng nhập số điện thoại" id="mobile"
                                                class="admin-form-input" type="text" v-model="receiverForm.phone" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="admin-form-item-label">
                                    <label for="email" class="admin-form-item-required" title="Email">
                                        Email
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Vui lòng nhập email" id="email"
                                                class="admin-form-input" type="text" v-model="receiverForm.email" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <citiesdropdown :lable="'Tỉnh/ Thành phố'" :name="'sender_city'"
                                    :object="receiverForm"></citiesdropdown>
                            </div>
                            <div class="col-6 mb-3">
                                <districtdropdown :lable="'Quận/ Huyện'" :name="'sender_district'"
                                    :city_code="receiverForm.province_id" :object="receiverForm"></districtdropdown>
                            </div>
                            <div class="col-6 mb-3">
                                <warddropdown :lable="'Xã/ Phường'" :name="'sender_ward'"
                                    :district_code="receiverForm.district_id" :object="receiverForm"></warddropdown>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="admin-form-item-label">
                                    <label for="village" class="admin-form-item-required" title="village">
                                        Thôn/ Xóm
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Thôn/ Xóm" id="village" class="admin-form-input"
                                                type="text" v-model="receiverForm.village" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="admin-form-item-label">
                                    <label for="zipcode" class="admin-form-item-required" title="zipcode">
                                        Mã zip code
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Vui lòng nhập mã zip code" id="zipcode"
                                                class="admin-form-input" type="text" v-model="receiverForm.zipcode" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="admin-form-item-label">
                                    <label for="addr1" class="admin-form-item-required" title="addr1">
                                        Địa chỉ 1
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Vui lòng nhập " id="addr1" class="admin-form-input"
                                                type="text" v-model="receiverForm.address1" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="admin-form-item-label">
                                    <label for="addr2" class="admin-form-item-required" title="addr2">
                                        Địa chỉ 2
                                    </label>
                                </div>
                                <div class="admin-form-item-control">
                                    <div class="admin-form-item-control-input">
                                        <div class="admin-form-item-control-input-content">
                                            <input placeholder="Vui lòng nhập" id="addr2"
                                                class="admin-form-input" type="text"
                                                v-model="receiverForm.address2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="custom-radio-input">
                                    <input type="radio" id="type1" value="1" name="form_check">
                                    <label for="type1">
                                        <span class="icon-radio mr-2"></span>
                                        Đặt làm địa chỉ giao hàng mặc định
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="modal-custom-actions d-flex align-items-center justify-content-end">
                                    <button class="btn-themes nocolor-btn mr-2" data-dismiss="modal" type="button">
                                        Hủy
                                    </button>
                                    <button class="btn-themes color-btn" type="submit">
                                        Xác nhận
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
