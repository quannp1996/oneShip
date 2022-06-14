@extends('basecontainer::admin.layouts.default')
@section('content')
    <div id="orderApp">
        <form action="{{ !empty($data) ? route('admin.order.store') : route('admin.order.store') }}" @submit.prevent="submitForm($event)" method="post">
            @csrf
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="card border-secondary">
                                    <div class="card-header text-primary">
                                        <i class="fa fa-pencil-square-o"></i>
                                        Thông tin cơ bản
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="userID">Thông tin Người dùng:</label>
                                            <span v-if="user" v-text="user.fullname"></span>
                                            <i class="fa fa-user" @click="openModalUser()"></i>
                                        </div>
                                        <div id="accordion" :class="user ? '' : 'divDisable'">
                                            @include('order::add.sender')
                                            @include('order::add.receiver')
                                            @include('order::add.package')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div :class="user ? 'col-5' : 'col-5 divDisable'">
                                @include('order::add.status')
                            </div>
                        </div>
                    </div>
                    <div :class="user ? 'card-footer' : 'card-footer divDisable'">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus">
                            </i>
                            Tạo đơn hàng
                        </button>
                        <a href="" class="btn btn-danger">
                            <i class="fa fa-times"></i>
                            Hủy đơn hàng
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <!-- Modal -->
        <div class="modal fade" id="userModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <i class="fa fa-user-md"></i>
                            Chọn người dùng
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nhập tên hoặc Email"
                                v-model="filter.user" aria-label="Nhập tên hoặc Email" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2" style="cursor: pointer"
                                    @click="loadUser()">
                                    <i class="fa fa-search"></i>
                                    Tìm kiếm
                                </span>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                </tr>
                            </thead>
                            <tbody v-if="users.length > 0">
                                <tr v-for="(item, index) in users" style="cursor: pointer" @click="selectUser(item)">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ item.fullname }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js_bot_all')
    <script>
        var apiURL = {
            users: '{{ route('api_customers_list') }}',
            shipping: '{{ route('api_shippingunit_get_all_shipping_units') }}',
            caculate: '{{ route('api_shippingunit_caculate_fee') }}'
        };
    </script>
    {!! FunctionLib::addMedia('/js/provinces.js') !!}
    {!! FunctionLib::addMedia('/js/districts.js') !!}
    {!! FunctionLib::addMedia('/js/wards.js') !!}
    {!! FunctionLib::addMedia('/admin/page/order.js') !!}
@endpush
