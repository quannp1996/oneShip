@extends('basecontainer::admin.layouts.default')
@section('content')
    <div id="orderApp">
        <form action="{{ 
            !empty($data)
            ? route('admin.order.store')
            : route('admin.order.store')
        }}" method="post">
            @csrf
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
                                        <label for="userID">Thông tin Người dùng</label>
                                        <select class="form-control select2" name="user_id" id="userID"></select>
                                    </div>
                                    <div id="accordion" :class="userId ? '' : 'divDisable'">
                                        @include('order::add.sender')
                                        @include('order::add.receiver')
                                        @include('order::add.package')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            @include('order::add.status')
                        </div>
                    </div>
                </div>
                <div :class="userId ? 'card-footer' : 'card-footer divDisable'">
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
        </form>
    </div>
@endsection
@push('js_bot_all')
    {!! FunctionLib::addMedia('/admin/page/order.js') !!}
    <script>
        $(".select2customer").select2({ width: '100%' });   
    </script>
@endpush
