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
    </div>
@endsection
@push('js_bot_all')
    <script>
        const apiURL = {
            fetch: '{{ route('web_customer_address_list') }}',
            push: '{{ route('web_customer_address_store') }}',
            delete: '{{ route('web_customer_address_store') }}',
        }
    </script>
    <script src="{{ asset('js/pages/address.js') }}"></script>
    <script src="{{ asset('js/locations/provinces.js') }}"></script>
    <script src="{{ asset('js/locations/districts.js') }}"></script>
    <script src="{{ asset('js/locations/wards.js') }}"></script>
@endpush