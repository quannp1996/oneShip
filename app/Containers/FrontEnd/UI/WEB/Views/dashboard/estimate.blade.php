@extends('basecontainer::frontend.pc.layouts.home')

@section('content')
    <div class="admin-page" id="estimateVUE">
        @include('frontend::dashboard.components.sidebar')
        <div class="admin-page-layout">
            <!-- admin -header -->
            @include('frontend::dashboard.components.headbar')
            <!-- end admin header-->
            <div class="admin-main-layout">
                <div class="admin-main-container xl">
                    <div class="d-flex justify-content-between mt-20">
                        <div class="title text-30 font-weight-bold lh-32">
                            Ước tính phí vận chuyển
                        </div>
                    </div>
                    <div class="admin-card">
                        <div class="admin-card-body p-0">
                            <div class="admin-card-head py-3">
                                <div class="title">
                                    Địa chỉ người gửi
                                </div>
                            </div>
                            <div class="admin-card-body">
                                <div class="admin-card-row">
                                    <div class="col-3 mb-3">
                                        <dropdown :name="'sender_city'" :object="sender" :lable="'Tỉnh/ Thành phố'" :first_text="'-- Chọn --'" :lists="provinces" :change="choseProvince"></dropdown>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <dropdown :name="'sender_district'" :object="sender" :lable="'Quận/ Huyện'" :first_text="'-- Chọn --'" :lists="sender.districts" :change="choseDistrict"></dropdown>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <dropdown :name="'sender_ward'" :object="sender" :lable="'Thôn/ Xóm'" :first_text="'-- Chọn --'" :lists="sender.wards" :change="choseWard"></dropdown>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <div class="admin-form-item-label">
                                            <label for="zipcode" class="admin-form-item-required" title="zipcode">
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
                                </div>
                            </div>
                            <div class="admin-card-head py-3">
                                <div class="title">
                                    Địa chỉ người nhận
                                </div>
                            </div>
                            <div class="admin-card-body">
                                <div class="admin-card-row">
                                    <div class="col-3 mb-3">
                                        <dropdown :name="'receiver_city'" :object="receiver" :lable="'Tỉnh/ Thành phố'" :first_text="'-- Chọn --'" :lists="provinces" :change="choseProvince"></dropdown>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <dropdown :name="'receiver_district'" :object="receiver" :lable="'Quận/ Huyện'" :first_text="'-- Chọn --'" :lists="receiver.districts" :change="choseDistrict"></dropdown>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <dropdown :name="'receiver_ward'" :object="receiver" :lable="'Thôn/ Xóm'" :first_text="'-- Chọn --'" :lists="receiver.wards" :change="choseWard"></dropdown>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <div class="admin-form-item-label">
                                            <label for="zipcode" class="admin-form-item-required" title="zipcode">
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
                                </div>
                            </div>
                            <div class="admin-card-head py-3">
                                <div class="title">
                                    Trọng lượng
                                </div>
                            </div>
                            <div class="admin-card-body">
                                <div class="admin-card-row">
                                    <div class="col-3 mb-3">
                                        <div class="admin-form-item-label">
                                            <label for="kg" class="admin-form-item-required" title="kg">
                                                Trọng lượng kiện hàng
                                            </label>
                                        </div>
                                        <div class="admin-form-item-control">
                                            <div class="admin-form-item-control-input">
                                                <div class="admin-form-item-control-input-content">
                                                    <span class="admin-input-adon ">
                                                        <input placeholder="Vui lòng nhập" id="weight" v-model='package_weight'
                                                            class="admin-form-input admin-adon-input" type="number"/>
                                                        <span class="admin-input-group-addon">Kg</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="admin-card bg-transparent">
                        <div class=" d-flex align-items-center justify-content-end">
                            <button class="btn-themes nocolor-btn mr-2" data-dismiss="modal" type="button">
                                Hủy
                            </button>
                            <button class="btn-themes color-btn" type="submit">
                                Ước tính phí vận chuyển
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js_bot_all')
<script>
    var api = {
        provinces: '{{ route('api_fr_location_get_provinces') }}',
        districts: '{{ route('api_fr_location_get_districts') }}',
        wards: '{{ route('api_fr_location_get_wards') }}',
    }
</script>
{!! FunctionLib::addMedia('/js/pages/estimate.js') !!}
@endpush