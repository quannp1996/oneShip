@extends('basecontainer::admin.layouts.default')

@section('right-breads')
    {!! $data->appends($search_data->toArray())->links('basecontainer::admin.inc.paginator') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-5">
                <h1>{{ $site_title }}</h1>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{!! $error !!}</div>
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    {!! session('status') !!}
                </div>
            @endif

            <form action="{{ route('admin_user_log') }}" method="get" id="searchForm">
                <div class="card card-accent-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-user"></i></span></div>
                                    <input type="text" name="user_name" class="form-control" placeholder="Tài khoản đăng nhập"
                                           value="{{ $search_data['user_name'] }}">
                                </div>
                            </div>

                            <div class="form-group col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                                    class="fa fa-tag"></i></span></div>
                                    <input type="text" name="action_name" class="form-control" placeholder="Tên hành động"
                                           value="{{ $search_data['action_name'] }}">
                                </div>
                            </div>

                            <div class="form-group col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                                    class="fa fa-hashtag"></i></span></div>
                                    <input type="text" name="object_id" class="form-control" placeholder="ID hành động"
                                           value="{{ $search_data['object_id'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                                    class="fa fa-hashtag"></i></span></div>
                                    <input type="text" name="ip" class="form-control" placeholder="Địa chỉ IP"
                                           value="{{ $search_data['ip'] }}">
                                </div>
                            </div>

                            <div class="form-group col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-calendar"></i></span></div>
                                    <input type="text" name="time_from" class="datepicker form-control"
                                        placeholder="Từ ngày" autocomplete="off" value="{{ $search_data->time_from }}">
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-calendar"></i></span></div>
                                    <input type="text" name="time_to" class="datepicker form-control"
                                        placeholder="Đến ngày" autocomplete="off" value="{{ $search_data->time_to }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                    </div>
                </div>
            </form>

            <div class="card card-accent-primary">
                <div class="card-body p-0">
                    @if (empty($data) || $data->isEmpty())
                        <h4 align="center">Không tìm thấy dữ liệu phù hợp</h4>
                    @else
                        <table class="table table-bordered table-striped table-responsive-sm">
                            <thead>
                                <tr>
                                    <th width="160">Thời gian</th>
                                    <th width="300">Tài khoản</th>
                                    <th>Hành động</th>
                                    <th width="120">Địa chỉ IP</th>
                                    <th width="55">Xem</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $log)
                                <tr>
                                    <td align="center">
                                        {{ @$log->created_at->format('H:i:s d/m/Y') }}
                                    </td>
                                    <td>
                                        {{ @$log->user->email }}
                                    </td>
                                    <td>
                                        {{ $log->note }}
                                        @if($log->object_id > 0)
                                            <b>#{{ $log->object_id }}</b>
                                        @endif
                                    </td>
                                    <td>{{ $log->ip }}</td>
                                    <td align="center">
                                        <a href="{{ route('admin_user_log_detail', $log->id) }}" class="text-primary">
                                            <i class="fa fa-search"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @include('basecontainer::admin.inc.bottom-pager-infor')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js_bot_all')
    <script>
        $('.datepicker').datetimepicker({
            format: 'd/m/Y',
            timepicker: false
        });
    </script>
@endpush