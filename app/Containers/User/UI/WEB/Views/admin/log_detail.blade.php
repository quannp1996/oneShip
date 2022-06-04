@extends('basecontainer::admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <h1>Chi tiết hoạt động</h1>
            </div>
            <div class=row>
                <div class="col-12 mb-4">
                    <a class="btn btn-sm btn-danger" href="{{ redirect()->back()->getTargetUrl() }}">
                        <i class="fa fa-arrow-circle-left"></i> Quay lại</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-accent-primary">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fa fa-info-circle"></i> Thông tin chung</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col-sm-4 font-weight-bold">Thời gian:</div>
                                <div class="col-sm-8 text-danger">{{ $data->created_at->format('H:i:s d/m/Y') }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4 font-weight-bold">Địa chỉ IP:</div>
                                <div class="col-sm-8">{{ $data->ip }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4 font-weight-bold">Mô tả:</div>
                                <div class="col-sm-8 text-primary">{{ $data->note }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4 font-weight-bold">Url thực hiện:</div>
                                <div class="col-sm-8">{{ $data->url }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4 font-weight-bold">Tên Route:</div>
                                <div class="col-sm-8">{{ $data->action }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4 font-weight-bold">Môi trường:</div>
                                <div class="col-sm-8">{{ $data->env }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 font-weight-bold">Thiết bị:</div>
                                <div class="col-sm-8">{{ $deviceOptions[$data->device] }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card card-accent-primary">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fa fa-user"></i> Người thực hiện</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col-sm-4 font-weight-bold">ID:</div>
                                <div class="col-sm-8">{{ $data->user->id }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4 font-weight-bold">Họ tên:</div>
                                <div class="col-sm-8">{{ $data->user->name }}</div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-4 font-weight-bold">Email:</div>
                                <div class="col-sm-8">{{ $data->user->email }}</div>
                            </div>
                            @if(!empty($data->user->phone))
                            <div class="row">
                                <div class="col-sm-4 font-weight-bold">Điện thoại:</div>
                                <div class="col-sm-8">{{ $data->user->phone }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-accent-primary">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fa fa-info-circle"></i> Dữ liệu trước hành động</h5>
                        </div>
                        <div class="card-body">
                            @if($data->before)
                                <div class="embed-responsive embed-responsive-1by1">
                                    <iframe src="{{ route('admin_user_log_detail_dump', ['id' => $data->id, 'show' => 'before']) }}" class="embed-responsive-item"></iframe>
                                </div>
                            @else
                                Không có thông tin dữ liệu
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card card-accent-primary">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fa fa-info-circle"></i> Dữ liệu sau hành động</h5>
                        </div>
                        <div class="card-body">
                            @if($data->after)
                                <div class="embed-responsive embed-responsive-1by1">
                                    <iframe src="{{ route('admin_user_log_detail_dump', ['id' => $data->id, 'show' => 'after']) }}"></iframe>
                                </div>
                            @else
                                Không có thông tin dữ liệu
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class=row>
        <div class="col-12 mb-5">
            <a class="btn btn-sm btn-danger" href="{{ redirect()->back()->getTargetUrl() }}">
                <i class="fa fa-arrow-circle-left"></i> Quay lại</a>
        </div>
    </div>
@endsection