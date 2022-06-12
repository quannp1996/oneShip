@extends('basecontainer::admin.layouts.default')

@section('right-breads')
    {!! $districts->appends($search_data->toArray())->links('basecontainer::admin.inc.paginator') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="header">
                <div class="float-left">
                    <h2> {{ __('location::admin.district.breadcrumb') }} </h2>
                </div>
            </div>
            <div class="clearfix mb-2"></div>
            <form action="{{ route('location.district_list') }}" method="GET">
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
                        {{-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                            data-target="#addDistrictForm">
                            <i class="fa fa-plus"></i>
                            Thêm Quận / Huyện
                        </button> --}}
                    </div>
                </div>
            </form>
            <div class="card rounded-0">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Danh sách
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="tableService">
                        <thead>
                            <tr>
                                <th style="width: 40px" class="text-center">
                                </th>
                                <th>
                                    {{ __('location::admin.district.name') }}
                                </th>
                                <th>
                                    {{ __('location::admin.city.city_name') }}
                                </th>
                                <th>
                                    {{ __('location::admin.action') }}
                                </th>
                            </tr>
                        </thead>
                        @forelse (@$districts ?? [] as $district)
                            <tr>
                                <td>
                                    {{ $district->id }}
                                </td>
                                <td>
                                    {{ $district->name }}
                                </td>
                                <td>
                                    {{ @$district->city->name }}
                                </td>
                                <td>
                                    <div class="d-inline">
                                        <form
                                            action="{{ route('location.district_delete', [
                                                'id' => $district->id,
                                            ]) }}"
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
                                            data-target="#modelEdit_{{ $district->id }}">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                        <div class="modal fade" id="modelEdit_{{ $district->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editDistrictFormTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                                            {{ __('location::admin.district.edit_label', [
                                                                'string' => $district->Name_VI,
                                                            ]) }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form
                                                        action="{{ route('location.district_update', [
                                                            'id' => $district->id,
                                                        ]) }}"
                                                        method="POST" id="editDistrictForm{{ $district->id }}">
                                                        <div class="modal-body">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label
                                                                    for="name">{{ __('location::admin.district.name') }}</label>
                                                                <input type="text" class="form-control rounded-0" id="name"
                                                                    autocomplete="false" value="{{ $district->name }}"
                                                                    name="name"
                                                                    placeholder="{{ __('location::admin.district.name_placeholder') }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label
                                                                    for="code">{{ __('location::admin.district.city_label') }}</label>
                                                                <select class="form-control rounded-0" name="province_id">
                                                                    <option value="">
                                                                        {{ __('location::admin.district.first_option') }}
                                                                    </option>
                                                                    @foreach ($cities as $city)
                                                                        <option value="{{ $city->code }}"
                                                                            {{ $city->code == $district->province_id ? 'selected' : '' }}>
                                                                            {{ $city->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="code">Nội thành</label>
                                                                <label
                                                                    class="c-switch c-switch-label c-switch-primary m-0 align-middle"><input
                                                                        type="hidden" name="noithanh" value="0"> <input
                                                                        type="checkbox" id="switchViewType" name="noithanh"
                                                                        value="1" {{ (int) $district->noithanh == 1 ? 'checked' : '' }} class="c-switch-input">
                                                                    <span data-checked="On" data-unchecked="Off"
                                                                        class="c-switch-slider"></span></label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary rounded-0"
                                                                data-dismiss="modal">{{ __('Đóng') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success rounded-0">{{ __('Lưu') }}</button>
                                                        </div>
                                                        <input type="hidden" name="id" value="{{ $district->id }}" />
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
                @if (@$districts->hasPages())
                    <div class="card-footer">
                        {!! $districts->appends($search_data->toArray())->links('basecontainer::admin.inc.paginator') !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="addDistrictForm" tabindex="-1" role="dialog" aria-labelledby="addDistrictTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('location::admin.district.add_lable') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('location.district_add') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('location::admin.district.name') }}</label>
                            <input type="text" class="form-control rounded-0" id="name" autocomplete="false" name="name"
                                placeholder="{{ __('location::admin.district.name_placeholder') }}">
                        </div>
                        <div class="form-group">
                            <label for="code">{{ __('location::admin.district.city_label') }}</label>
                            <select class="form-control rounded-0" name="province_id">
                                <option value="">{{ __('location::admin.district.first_option') }}</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
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
    </div> --}}
@endsection
