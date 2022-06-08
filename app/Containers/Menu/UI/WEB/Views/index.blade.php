@extends('basecontainer::admin.layouts.default')

@section('content')
    <div class="fade-in">
        <div class="mb-3">
            <a href="{{ route('admin_menu_add') }}" class="btn btn-sm btn-primary"><i
                        class="fa fa-plus"></i> Thêm mới</a>
        </div>
        <div class="row" id="menu-container">
            @foreach ($menusData as $typeId => $menus)
                <div class="col-lg-6 col-sm-12 col-md-6 col-xxl-4">
                    <div class="card card-accent-primary">
                        <div class="bg-info card-header">
                            {{ @$menusType[$typeId] }}
                        </div>

                        <div class="card-body">
                            <div class="cf nestable-lists p-0 no-border">
                                <div class="dd w-100 nestable-menu" id="nestable-{{ $loop->index }}">
                                    <ol class="dd-list">
                                        {!! $controller->buildNestableTree($menus) !!}
                                    </ol>
                                </div>
                            </div>

                            <textarea class="d-none" id="{{ sprintf('nestable-output-%s', $loop->index) }}"></textarea>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('css_bot_all')
    {!! \FunctionLib::addMedia('admin/css/jquery.nestable.css') !!}
@endpush

@push('js_bot_all')
    {!! \FunctionLib::addMedia('admin/js/jquery.nestable.js') !!}
    {!! \FunctionLib::addMedia('admin/js/menu.js') !!}
@endpush
