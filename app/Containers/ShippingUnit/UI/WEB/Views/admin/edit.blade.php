@extends('basecontainer::admin.layouts.default')
@section('content')
    <div id="shippingVUE">
        <form
            action="{{ !empty($data)
                ? route('admin_shipping_unit_update', ['id' => $data->id])
                : route('admin_shipping_unit_store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-5">
                    @include('shippingunit::admin.components.base')
                    @include('shippingunit::admin.components.vung')
                </div>
                <div class="col-7">
                    @include('shippingunit::admin.components.security')
                    @include('shippingunit::admin.components.services')
                </div>
            </div>
            @if (!empty($data))
                <div class="row">
                    <div class="col-12">
                        @include('shippingunit::admin.components.const')
                    </div>
                </div>
            @endif
            <div class="mb-3">
                <button type="submit" class="btn btn-sm btn-primary" id="subMitForm"><i class="fa fa-dot-circle-o"></i>
                    Cập nhật
                </button>
                <a class="btn btn-sm btn-danger" href="{{ route('admin_shipping_unit_index') }}">
                    <i class="fa fa-ban"></i>
                    Hủy bỏ
                </a>
            </div>
        </form>
    </div>
    @include('shippingunit::admin.components.template.security')
    @include('shippingunit::admin.components.template.service')
@endsection
@push('js_bot_all')
    <script>
        var shippingAPI = {
            shipping_const: '{!! route('admin_shipping_const_store') !!}'
        }
        var shippingUnit = {
            id: '{{ @$data->id }}',
            consts: JSON.parse('{!! @$data->jsonConst() ?? '{}' !!}')
        }
        const item = {
            html: $('#extra_item').html(),
            count: '{{ !empty($data) ? count($data->toSecurityJson()) : '0' }}',
            remove: function(key) {
                $(`#item_${key}`).remove();
            },
            add: function() {
                this.count = +this.count + 1;
                $('tbody#items').append(this.html.replaceAll('{COUNT}', this.count))
            }
        }
    </script>
    {!! FunctionLib::addMedia('/admin/page/shipping.js') !!}
@endpush
