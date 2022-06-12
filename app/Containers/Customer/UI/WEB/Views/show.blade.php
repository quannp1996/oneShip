@extends('basecontainer::admin.layouts.default')

@section('content')
    <div class="row" id="showCustomerAPP">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tabbable boxed parentTabs">
                        <ul class="nav nav-tabs nav-underline nav-underline-primary mb-3">
                            <li class="nav-item">
                                <a class="nav-link active" href="#general"><i class="fa fa-empire"></i> Chung</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#order"><i class="fa fa-shopping-cart"></i> Đơn hàng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#const"><i class="fa fa-empire"></i> Bảng giá</a>
                            </li>
                        </ul>
                        <div class="tab-content p-0">
                            @include('customer::show.base')
                            @include('customer::show.const')
                            @include('customer::show.order')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js_bot_all')
    <script>
        var user = {
            id: '{{ $customer->id }}',
            prices: JSON.parse('{!! $customer->prices ?? '{}' !!}')
        }
        var apiURL = {
            shippings: '{{ route('api_shippingunit_get_all_shipping_units') }}',
            setup: '{!! route('admin.customers.setup_price') !!}',
        }
        $(document).ready(function(){
            $("ul.nav-tabs a").click(function(e) {
                e.preventDefault();
                $(this).tab('show');
            });
        })
    </script>
    {!! FunctionLib::addMedia('/admin/page/customer.js') !!}
@endpush
