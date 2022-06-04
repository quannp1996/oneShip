@extends('basecontainer::admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-sm-12 position-relative">
            <div class="card card-accent-primary">
                <form action="{{ route('admin_menu_store') }}" method="POST" id="formCreateMenu">
                    @csrf
                    <div class="card-header d-flex">
                        <button class="btn btn-link">{{ __('menu::menu.create_new_title') }}</button>
                        <button type="submit" class="btn btn-primary ml-auto">{{ __('menu::menu.btn_create') }}</button>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-7">
                                @include('menu::pages.edit_tabs.general', ['data' => []])
                            </div>

                            <div class="col-5">
                                @include('menu::pages.edit_tabs.data', ['data' => []])

                                {{-- @include('menu::pages.edit_tabs.image') --}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('js_bot_all')
    {!! \FunctionLib::addMedia('admin/js/menu.js') !!}
@endpush
