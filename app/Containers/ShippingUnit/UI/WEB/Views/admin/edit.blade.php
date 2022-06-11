@extends('basecontainer::admin.layouts.default')
@section('content')
    <form action="{{ 
        !empty($data)
        ? route('admin_shipping_unit_update', ['id' => $data->id])
        : route('admin_shipping_unit_store')
    }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-5">
                @include('shippingunit::admin.components.base')
            </div>
            <div class="col-7">
                @include('shippingunit::admin.components.security')
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @include('shippingunit::admin.components.const')
            </div>
        </div>
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
    @include('shippingunit::admin.components.template')
@endsection
@push('js_bot_all')
    <script>
        const item = {
            html: $('#extra_item').html(),
            count: '{{ !empty($data) ? count($data->toSecurityJson()) : '0' }}',
            remove: function(key){
                $(`#item_${key}`).remove();
            },
            add: function(){
                this.count = +this.count + 1;
                $('tbody#items').append(this.html.replaceAll('{COUNT}', this.count))
            }
        }
    </script>
@endpush