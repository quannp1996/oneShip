@extends('basecontainer::frontend.pc.layouts.home')
@section('content')
    <div class="admin-main-layout" id="createOrderVue">
        <div class="admin-main-container xl">
            @include('frontend::order.sections.create.header')
            <div v-if="currentStep === 0">
                @include('frontend::order.sections.create.steps.step1')
            </div>
            <div v-if="currentStep === 1">
                @include('frontend::order.sections.create.steps.step2')
            </div>
            <div v-if="currentStep === 2">
                @include('frontend::order.sections.create.steps.step3')
            </div>
            @include('frontend::order.sections.create.footer')
        </div>
    </div>
@endsection
@push('js_bot_all')
    <script>
        var api = {
            wards: '{{ route('api_fr_location_get_wards') }}',
            provinces: '{{ route('api_fr_location_get_provinces') }}',
            districts: '{{ route('api_fr_location_get_districts') }}',
            estimate: '{{ route('web_caculate_fees') }}',
            cancel: '{{ route('web_orders_index') }}',
            estimate: '{{ route('web_caculate_fees') }}',
            storeOrder: '{{ route('ajax.orders.store') }}',
        }
    </script>
    <script src="{{ asset('js/pages/create_order.js') }}"></script>
@endpush
