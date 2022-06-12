@extends('basecontainer::admin.layouts.default')

@section('right-breads')
    {!! $wards->appends($search_data->toArray())->links('basecontainer::admin.inc.paginator') !!}
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="header">
            <div class="float-left">
                <h2> {{ __('location::admin.ward.breadcrumb') }} </h2>
            </div>
        </div>
        <div class="clearfix mb-2"></div>
        <form action="{{ route('location.import.ward') }}" enctype="multipart/form-data" method="POST">
            <div class="card">
                <div class="card-content">
                    @csrf
                    <input type="file" name="file" id="file">
                    <button class="btn btn-success">Nhập Liệu</button>
                </div>
            </div>
        </form> 
        <form action="{{ route('location.ward_list') }}" method="GET">
            <div class="card card-accent-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-bookmark-o"></i></span></div>
                                <input type="text" name="name" class="form-control" placeholder="Tiêu đề" value="{{ @$search_data->name }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
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
                            <th>
                                {{ __('location::admin.ward.name') }}
                            </th>
                            <th>
                                {{ __('location::admin.district.name') }}
                            </th>
                            <th>
                                Tỉnh / Thành
                            </th>
                            <th>
                                {{ __('location::admin.action') }}
                            </th>
                        </tr>
                    </thead>
                    @forelse (@$wards ?? [] as $ward)
                        <tr>
                            <td>
                                {{ @$ward->name }}
                            </td>
                            <td>
                                {{ @$ward->district->name }}
                            </td>
                            <td>
                                {{ @$ward->province->name }}
                            </td>
                            <td>
                                <div class="d-inline">
                                    <form action="{{ route('location.ward_delete', [
                                        'id' => $ward->id
                                    ]) }}" method="POST">
                                        @csrf
                                            <button type="submit" onclick="return confirm('{{ __('location::admin.ward.confirm') }}')" class="btn rounded-0">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                    </form>
                                    <a href="{{ route('location.ward_edit', [
                                        'id' => $ward->id
                                    ]) }}" class="btn rounded-0">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
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
            @if (@$wards->hasPages())
                <div class="card-footer">
                    {!! $wards->appends($search_data->toArray())->links('basecontainer::admin.inc.paginator')  !!}
                </div>
            @endif    
        </div>
    </div>
</div>
@endsection