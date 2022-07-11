@extends('basecontainer::frontend.pc.layouts.home')
@section('content')
    <div class="admin-main-layout" id="addressVUE">
        <div class="admin-main-container xl">
            @include('frontend::address.sections.header')
            <div class="admin-card">
                <div class="admin-card-body">
                    <ul class="nav admin-nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="sender-tab" data-toggle="tab" href="#sender" role="tab"
                                aria-controls="sender" aria-selected="true">
                                Người gửi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="receiver-tab" data-toggle="tab" href="#receiver" role="tab"
                                aria-controls="receiver" aria-selected="false">
                                Người nhận
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @include('frontend::address.sections.senders')
                        @include('frontend::address.sections.receivers')
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Delete-->
        <div class="modal fade" id="delete-item-1" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-sm-custom " role="document">
                <div class="modal-content">
                    <div class="modal-custom-form mh-auto p-4">
                        <div class="form-group mb-0">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="admin-modal-confirm-body d-flex align-items-center">
                                        <span role="img" aria-label="exclamation-circle" class="icon-svg mr-2 ">
                                            <svg viewBox="64 64 896 896" focusable="false" width="1em" height="1em"
                                                fill="currentColor" aria-hidden="true" class="color-fe9e0f">
                                                <path
                                                    d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z">
                                                </path>
                                                <path
                                                    d="M464 688a48 48 0 1096 0 48 48 0 10-96 0zm24-112h48c4.4 0 8-3.6 8-8V296c0-4.4-3.6-8-8-8h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="admin-modal-confirm-title text-16 color-00112f">
                                            Bạn có chắc muốn xoá địa chỉ
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="modal-custom-actions d-flex align-items-center justify-content-end">
                                        <button class="btn-themes nocolor-btn mr-2" data-dismiss="modal" type="button">
                                            Hủy
                                        </button>
                                        <button class="btn-themes color-btn" type="button" @click="deleteAddress()">
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
        <div class="modal fade" id="edit-item-1" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-custom-header">
                        <div class="title">
                            Chỉnh sửa địa chỉ
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-custom-form">
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
                                                    class="admin-form-input" type="text" v-model="editForm.fullname" />
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
                                                    class="admin-form-input" type="text" v-model="editForm.phone" />
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
                                                    class="admin-form-input" type="text" v-model="editForm.email" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-6 mb-3">
                                    <citiesdropdown :lable="'Tỉnh/ Thành phố'" :name="'edit_city'"
                                        :selected="editForm.province_id"
                                        :object="editForm">
                                    </citiesdropdown>
                                </div>
                                <div class="col-6 mb-3">
                                    <districtdropdown :lable="'Quận/ Huyện'" :name="'edit_district'"
                                        :selected="editForm.district_id"
                                        :city_code="editForm.province_id" :object="editForm"></districtdropdown>
                                </div>
                                <div class="col-6 mb-3">
                                    <warddropdown :lable="'Xã/ Phường'" :name="'edit_ward'"
                                        :selected="editForm.ward_id"
                                        :district_code="editForm.district_id" :object="editForm"></warddropdown>
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
                                                    class="admin-form-input" type="text" v-model="editForm.zipcode"/>
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
                                                <input placeholder="Vui lòng nhập " id="addr1"
                                                    class="admin-form-input" type="text" v-model="editForm.address1" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="admin-form-item-label">
                                        <label for="addr1" class="admin-form-item-required" title="addr1">
                                            Địa chỉ 2
                                        </label>
                                    </div>
                                    <div class="admin-form-item-control">
                                        <div class="admin-form-item-control-input">
                                            <div class="admin-form-item-control-input-content">
                                                <input placeholder="Vui lòng nhập" id="addr1"
                                                    class="admin-form-input" type="text" v-model="editForm.address2" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-12 mb-3">
                                    <div class="custom-radio-input">
                                        <input type="radio" id="type1" value="1" name="form_check"
                                            checked="">
                                        <label for="type1">
                                            <span class="icon-radio mr-2"></span>
                                            Đặt làm địa chỉ giao hàng mặc định
                                        </label>
                                    </div>
                                </div> --}}
                                <div class="col-12 mb-2">
                                    <div class="modal-custom-actions d-flex align-items-center justify-content-end">
                                        <button class="btn-themes nocolor-btn mr-2" data-dismiss="modal" type="button">
                                            Hủy
                                        </button>
                                        <button class="btn-themes color-btn" type="button" @click="updateAddress()">
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
@endsection
@push('js_bot_all')
    <script>
        const apiURL = {
            fetch: '{{ route('web_customer_address_list') }}',
            push: '{{ route('web_customer_address_store') }}',
        }
    </script>
    <script src="{{ asset('js/pages/address.js') }}"></script>
    <script src="{{ asset('js/locations/provinces.js') }}"></script>
    <script src="{{ asset('js/locations/districts.js') }}"></script>
    <script src="{{ asset('js/locations/wards.js') }}"></script>
@endpush
