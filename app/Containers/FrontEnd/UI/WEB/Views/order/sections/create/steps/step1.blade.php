<div class="admin-card">
    <div class="admin-card-body p-0">

        <div class="admin-card-head py-3 position-relative">
            <button
                class="btn-themes nocolor-btn w-100 border-0 p-0 title d-flex align-items-center justify-content-between color-748399"
                data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false"
                aria-controls="multiCollapseExample1">
                Địa chỉ người gửi
                <div class="d-flex align-items-center">

                    <span role="img" aria-label="right" class="icon-svg smm color-748399">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em"
                            fill="currentColor" aria-hidden="true" style="">
                            <path
                                d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z">
                            </path>
                        </svg>
                    </span>
                </div>
            </button>
            <a href="javascript:;" class="btn-themes btn-themes-small nocolor-btn mr-2 text-12 absolute-link"
                data-toggle="modal" data-target="#modalSavedAddrs">
                Sử dụng danh sách địa chỉ
            </a>
            <!-- Modal Nguoi Nhan-->
            <div class="modal fade" id="modalSavedAddrs" tabindex="-1" role="dialog" aria-labelledby=""
                aria-hidden="true">
                <div class="modal-dialog modal-lg " role="document">
                    <div class="modal-content">
                        <div class="modal-custom-header">
                            <div class="title">
                                Chọn địa chỉ từ Sổ địa chỉ
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-custom-form">
                            <span class="admin-input-search">
                                <span class="icon-svg">
                                    <svg class="color-748399" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                                        <path
                                            d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                                        </path>
                                    </svg>
                                </span>
                                <input placeholder="Vui lòng nhập từ khóa để tìm kiếm" class="admin-form-input"
                                    type="text" value="" />
                            </span>

                            <div class="search-addrs-result my-3">
                                <div class="custom-radio-input mb-3">
                                    <input type="radio" id="type1" value="1" name="form_check">
                                    <label for="type1">
                                        <span class="icon-radio mr-2"></span>
                                        <span>
                                            <div>
                                                <span class="name">duong</span>
                                                <span class="phone">0346407405</span>
                                                <span class="countryCode">(VN)</span>
                                            </div>
                                            <div class="addressContent">
                                                <span class="address">62 phan văn trị đống đa Thu Do Ha
                                                    Noi</span>
                                            </div>
                                        </span>

                                    </label>
                                </div>
                                <div class="custom-radio-input mb-3">
                                    <input type="radio" id="type12" value="12" name="form_check">
                                    <label for="type12">
                                        <span class="icon-radio mr-2"></span>
                                        <span>
                                            <div>
                                                <span class="name">duong 2</span>
                                                <span class="phone">0346407405</span>
                                                <span class="countryCode">(VN)</span>
                                            </div>
                                            <div class="addressContent">
                                                <span class="address">62 phan văn trị đống đa Thu Do Ha
                                                    Noi</span>
                                            </div>
                                        </span>

                                    </label>
                                </div>
                            </div>

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
            </div>
        </div>
        <div class="admin-card-body collapse multi-collapse show" id="multiCollapseExample1">
            <div class="admin-card-row">
                <div class="col-3 mb-3">
                    <div class="admin-form-item-label">
                        <label for="name" class="admin-form-item-required" title="name">
                            Họ tên
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <input placeholder="Vui lòng nhập " name="sender[fullname]" v-model="sender.fullname" id="fullname" class="admin-form-input"
                                    type="text" :class="error.sender.fullname ? 'unvalid' : '' "/>
                            </div>
                        </div>
                        <p class="error" v-if="error.sender.fullname" v-text="error.sender.fullname"></p>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="admin-form-item-label">
                        <label for="mobile" class="admin-form-item-required" title="mobile">
                            Số điện thoại
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <input placeholder="Vui lòng nhập" v-model="sender.phone" id="phone" name="sender[phone]" class="admin-form-input"
                                    type="text" value="" :class="error.sender.phone ? 'unvalid' : ''" />
                            </div>
                            <p class="error" v-if="error.sender.phone" v-text="error.sender.phone"></p>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="admin-form-item-label">
                        <label for="email" title="email">
                            Email
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <input placeholder="Vui lòng nhập " v-model="sender.email" name="sender[email]" id="sender_email" class="admin-form-input"
                                    type="text" value="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3"></div>
                <div class="col-3 mb-3">
                    <dropdown :name="'sender_city'" :object="sender" :lable="'Tỉnh/ Thành phố'"
                        :first_text="'-- Chọn --'" :lists="provinces" :change="choseProvince">
                    </dropdown>
                    <p class="error" v-if="error.sender.province" v-text="error.sender.province"></p>
                </div>
                <div class="col-3 mb-3">
                    <dropdown :name="'sender_district'" :object="sender" :lable="'Quận/ Huyện'"
                        :first_text="'-- Chọn --'" :lists="sender.districts" :change="choseDistrict">
                    </dropdown>
                    <p class="error" v-if="error.sender.district" v-text="error.sender.district"></p>
                </div>
                <div class="col-3 mb-3">
                    <dropdown :name="'sender_ward'" :object="sender" :lable="'Thôn/ Xóm'"
                        :first_text="'-- Chọn --'" :lists="sender.wards" :change="choseWard">
                    </dropdown>
                    <p class="error" v-if="error.sender.ward" v-text="error.sender.ward"></p>
                </div>
                <div class="col-3 mb-3">
                    <div class="admin-form-item-label">
                        <label for="zipcode" class="" title="zipcode">
                            Mã zip code
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <input placeholder="Vui lòng nhập mã zip code" id="zipcode"
                                    class="admin-form-input" type="text" value="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="admin-form-item-label">
                        <label for="addr1" class="admin-form-item-required" title="addr1">
                            Địa chỉ 1
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <input placeholder="Vui lòng nhập " id="addr1" class="admin-form-input"
                                    type="text" v-model="sender.address1" :class="error.sender.address1 ? 'unvalid' : ''"/>
                            </div>
                        </div>
                        <p class="error" v-if="error.sender.address1" v-text="error.sender.address1"></p>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="admin-form-item-label">
                        <label for="addr2" title="addr2">
                            Địa chỉ 2
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <input placeholder="Vui lòng nhập " id="addr2" class="admin-form-input"
                                    type="text" value="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="admin-card">
    <div class="admin-card-body p-0">
        <div class="admin-card-head py-3 position-relative">
            <button
                class="btn-themes nocolor-btn w-100 border-0 p-0 title d-flex align-items-center justify-content-between color-748399"
                data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false"
                aria-controls="multiCollapseExample1">
                Địa chỉ người nhận
                <div class="d-flex align-items-center">
                    <span role="img" aria-label="right" class="icon-svg smm color-748399">
                        <svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em"
                            height="1em" fill="currentColor" aria-hidden="true" style="">
                            <path
                                d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z">
                            </path>
                        </svg>
                    </span>
                </div>
            </button>
            <a href="javascript:;" class="btn-themes btn-themes-small nocolor-btn mr-2 text-12 absolute-link"
                data-toggle="modal" data-target="#modalSavedAddrs">
                Sử dụng danh sách địa chỉ
            </a>
        </div>
        <div class="admin-card-body collapse multi-collapse show" id="multiCollapseExample2">
            <div class="admin-card-row">
                <div class="col-3 mb-3">
                    <div class="admin-form-item-label">
                        <label for="receiver_fullname" class="admin-form-item-required" title="name">
                            Họ tên
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <input placeholder="Vui lòng nhập " v-model="receiver.fullname" name="receiver[fullname]" id="receiver_fullname" class="admin-form-input"
                                    type="text" :class="error.receiver.fullname ? 'unvalid' : ''"/>
                            </div>
                            <p class="error" v-if="error.receiver.fullname" v-text="error.receiver.fullname"></p>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="admin-form-item-label">
                        <label for="receiver_phone" class="admin-form-item-required" title="receiver_phone">
                            Số điện thoại
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <input placeholder="Vui lòng nhập " v-model="receiver.phone" name="receiver[phone]" id="receiver_phone" class="admin-form-input"
                                    type="text" :class="error.receiver.phone ? 'unvalid' : ''"/>
                            </div>
                            <p class="error" v-if="error.receiver.phone" v-text="error.receiver.phone"></p>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="admin-form-item-label">
                        <label for="receiver_email" title="email">
                            Email
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <input placeholder="Vui lòng nhập " v-model="receiver.email" id="receiver_email" class="admin-form-input"
                                    type="text" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3"></div>
                <div class="col-3 mb-3">
                    <dropdown :name="'receiver_city'" :object="receiver" :lable="'Tỉnh/ Thành phố'"
                        :first_text="'-- Chọn --'" :lists="provinces" :change="choseProvince">
                    </dropdown>
                    <p class="error" v-if="error.receiver.province" v-text="error.receiver.province"></p>
                </div>
                <div class="col-3 mb-3">
                    <dropdown :name="'receiver_district'" :object="receiver" :lable="'Quận/ Huyện'"
                        :first_text="'-- Chọn --'" :lists="receiver.districts" :change="choseDistrict">
                    </dropdown>
                    <p class="error" v-if="error.receiver.district" v-text="error.receiver.district"></p>
                </div>
                <div class="col-3 mb-3">
                    <dropdown :name="'receiver_ward'" :object="receiver" :lable="'Thôn/ Xóm'"
                        :first_text="'-- Chọn --'" :lists="receiver.wards" :change="choseWard">
                    </dropdown>
                    <p class="error" v-if="error.receiver.ward" v-text="error.receiver.ward"></p>
                </div>
                <div class="col-3 mb-3">
                    <div class="admin-form-item-label">
                        <label for="receiver_zipcode" class="admin-form-item-required" title="receiver_zipcode">
                            Mã zip code
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <input placeholder="Vui lòng nhập mã zip code" v-model="receiver.zipcode" name="receiver[zipcode]" id="receiver_zipcode"
                                    class="admin-form-input" type="text" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="admin-form-item-label">
                        <label for="addr1" class="admin-form-item-required" title="addr1">
                            Địa chỉ 1
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <input placeholder="Vui lòng nhập " id="addr1" v-model="receiver.address1" class="admin-form-input"
                                    type="text" :class="error.receiver.ward ? 'unvalid' : ''"/>
                            </div>
                            <p class="error" v-if="error.receiver.ward" v-text="error.receiver.ward"></p>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="admin-form-item-label">
                        <label for="addr2" title="addr2">
                            Địa chỉ 2
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <input placeholder="Vui lòng nhập " id="addr2" v-model="receiver.address2" class="admin-form-input"
                                    type="text" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
