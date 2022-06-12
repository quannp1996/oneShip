@extends('basecontainer::admin.layouts.default')

@section('right-breads')
    {!! $cities->appends($search_data->toArray())->links('basecontainer::admin.inc.paginator') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="header">
                <div class="float-left">
                    <h2> {{ __('location::admin.city.breadcrumb') }} </h2>
                </div>
            </div>
            <div class="clearfix mb-2"></div>
            <form action="{{ route('location.city_list') }}" method="GET">
                <div class="card card-accent-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                                class="fa fa-bookmark-o"></i></span></div>
                                    <input type="text" name="name" class="form-control" placeholder="Tiêu đề"
                                        value="{{ @$search_data->name }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Tìm
                            kiếm</button>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addCityForm">
                            <i class="fa fa-plus"></i>
                            {{ __('location::admin.city.city_addButton_lable') }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="card rounded-0 card-accent-info">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Danh sách
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="tableService">
                        <thead>
                            <tr>
                                <th style="width: 40px" class="text-center">
                                    {{-- <input type="checkbox" id="checkAll" value="" name="checkAll"/> --}}
                                </th>
                                <th>
                                    {{ __('location::admin.city.city_name') }}
                                </th>
                                <th>
                                    {{ __('location::admin.city.code') }}
                                </th>
                                <th>
                                    {{ __('location::admin.action') }}
                                </th>
                            </tr>
                        </thead>
                        @forelse (@$cities ?? [] as $city)
                            <tr>
                                <td>
                                    {{-- <input type="checkbox" id="item_check_{{ $item->id }}" value="{{ $item->id }}" name="itemCheck[]"/> --}}
                                    {{ $city->id }}
                                </td>
                                <td>
                                    {{ $city->name }}
                                </td>
                                <td>
                                    {{ $city->code }}
                                </td>
                                <td>
                                    <div class="d-inline">
                                        <form action="{{ route('location.city_delete', ['id' => $city->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                onclick="return confirm('{{ __('location::admin.city.confirm') }}')"
                                                class="btn rounded-0" data-toggle="modal"
                                                data-target="#exampleModalCenter">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn rounded-0" data-toggle="modal"
                                            data-target="#modelEdit_{{ $city->id }}">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                        <div class="modal fade" id="modelEdit_{{ $city->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="addServiceFormTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                                            {{ __('location::admin.city.edit_label', ['string' => $city->name]) }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form
                                                        action="{{ route('location.city_update', ['id' => $city->id]) }}"
                                                        method="POST">
                                                        <div class="modal-body">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label
                                                                    for="name">{{ __('location::admin.city.city_name') }}</label>
                                                                <input type="text" class="form-control rounded-0" id="name"
                                                                    autocomplete="false" value="{{ $city->name }}"
                                                                    name="name"
                                                                    placeholder="{{ __('location::admin.city.city_placeholder') }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label
                                                                    for="code">{{ __('location::admin.city.code') }}</label>
                                                                <input type="text" class="form-control rounded-0" id="code"
                                                                    autocomplete="false" value="{{ $city->code }}"
                                                                    name="code"
                                                                    placeholder="{{ __('location::admin.city.code_placeholder') }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary rounded-0"
                                                                data-dismiss="modal">{{ __('Đóng') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success rounded-0">{{ __('Lưu') }}</button>
                                                        </div>
                                                        <input type="hidden" name="id" value="{{ $city->id }}" />
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    {{ __('Không tìm thấy dữ liệu phù hợp') }}
                                </td>
                            </tr>
                        @endforelse
                    </table>
                </div>
                @if (@$cities->hasPages())
                    <div class="card-footer">
                        {!! $cities->appends($search_data->toArray())->links('basecontainer::admin.inc.paginator') !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="addCityForm" tabindex="-1" role="dialog" aria-labelledby="addCityFormTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('location::admin.city.add_lable') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('location.city_add') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('location::admin.city.city_name') }}</label>
                            <input type="text" class="form-control rounded-0" id="name" autocomplete="false" name="name"
                                placeholder="{{ __('location::admin.city.city_placeholder') }}">
                        </div>
                        <div class="form-group">
                            <label for="code">{{ __('location::admin.city.code') }}</label>
                            <input type="text" class="form-control rounded-0" id="code" autocomplete="false" name="code"
                                placeholder="{{ __('location::admin.city.code_placeholder') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-0"
                            data-dismiss="modal">{{ __('Đóng') }}</button>
                        <button type="submit" class="btn btn-success rounded-0">{{ __('Lưu') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
