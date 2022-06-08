@extends('basecontainer::admin.layouts.default_for_iframe')
@section('content')
    <div class="row" id="sectionContent">
        <div class="col-12">
            <div class="card mb-0">
                <div class="card-header d-flex">
                    <button class="btn btn-link">Lịch sử xử lý đơn hàng: <strong>{{ $order->code }}</strong></button>
                    <button type="button" class="btn btn-secondary ml-auto mr-2" onclick='return closeFrame()'>Đóng
                        lại</button>

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="card mt-3">
                                <div class="card-header bg-info text-white">
                                    <span class="card-title">Lọc lịch sử</span>
                                </div>

                                <div class="card-body">
                                    <form action="{{ route('admin.orders.logs', ['id' => $order->id]) }}" method="GET">
                                        <div class="form-group">
                                            <label for="">Thao tác</label>
                                            <select name="action_key" class="form-control select2">
                                                <option value="">--Chọn---</option>
                                                @foreach ($orderActions as $actionKey => $actionText)
                                                    <option value="{{ $actionKey }}" @if ($actionKey == ($input['action_key'] ?? '')) selected @endif>
                                                        {{ $actionText }} [ {{ $actionKey }} ]
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Ngày thao tác</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="">Từ ngày</span>
                                                </div>
                                                <input type="text" name="from_date" class="form-control"
                                                    value="{{ $input['from_date'] ?? '' }}" id="date_timepicker_start">

                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="">đến</span>
                                                </div>

                                                <input type="text" name="to_date" class="form-control"
                                                    value="{{ $input['to_date'] ?? '' }}" id="date_timepicker_end">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Nhân sự thao tác</label>
                                            <select name="user_id" id="user-handle" class="form-control select2"
                                                style="width: 100%;">
                                            </select>

                                            @if ($users->isNotEmpty())
                                                <input type="hidden" id="user-hanleName"
                                                    value="{{ $users->first()->email }} ({{ $users->first()->name }})">
                                            @endif
                                        </div>

                                        <div class="d-flex">
                                            <div class="ml-auto">
                                                <button type="reset"
                                                    onclick="location.href = '{{ route('admin.orders.logs', ['id' => $order->id]) }}'"
                                                    class="btn btn-secondary">Hủy thông tin</button>
                                                <button type="search" class="btn btn-primary">
                                                    <i class="fa fa-filter"></i> Lọc thông tin
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-8">
                            @if ($logs->count())
                                <div class="container py-2">
                                    @foreach ($logs as $log)
                                        @include('order::inc.log-item', [
                                        'log' => $log,
                                        'orderActions' => $orderActions
                                        ])
                                    @endforeach

                                    <div class="d-flex justify-content-center">
                                        {!! $logs->appends($input)->links('basecontainer::admin.inc.paginator') !!}
                                    </div>
                                </div>
                                <!--container-->
                            @else
                                <div class="d-flex justify-content-center mt-4">Chưa có lịch sử xử lý cho đơn hàng này.
                                </div>
                            @endif
                        </div><!-- /.col-7 -->
                    </div>
                </div><!-- /.Card-body -->
            </div><!-- /.End card -->
        </div>
    </div>
@endsection
