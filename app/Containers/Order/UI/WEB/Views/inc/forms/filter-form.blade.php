{!! Form::open(['url' => route('admin.orders.index'), 'method' => 'get', 'id' => 'searchForm']) !!}
<div class="card card-accent-primary">
    <div class="card-body">
        <input type="hidden" name="is_filter" value="1">
        <div class="row">
            <div class="form-group col-sm-3">
                <div class="input-group">
                    <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-hashtag"></i></span>
                    </div>
                    <input type="text" name="order_id" placeholder="Mã đơn/ID đơn" class="form-control"
                        value="{{ $search_data->order_id }}">
                </div>
            </div>
            <div class="form-group col-sm-3">
                <div class="input-group">
                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                class="fa fa-hashtag"></i></span></div>
                    <input type="text" name="eshop_order_id" placeholder="SYNC ID" class="form-control"
                        value="{{ @$search_data->eshop_order_id }}">
                </div>
            </div>
            <div class="form-group col-sm-3">
                <div class="input-group">
                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                class="fa fa-list"></i></span></div>
                    <select name="payment_status" class="select2  form-control" style="width: 100%;">
                        <option value="" selected>---Trạng thái thanh toán---</option>
                        @foreach ($orderPaymmentStatus as $paymentStatus => $paymentStatusText)
                            <option value="{{ $paymentStatus }}"
                                {{ $paymentStatus == @$search_data->payment_status ? 'selected' : '' }}>
                                {{ $paymentStatusText }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group col-sm-3">
                <div class="input-group">
                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                class="fa fa-list"></i></span></div>
                    <select name="eid_status" class="form-control">
                        <option value="" {{ $eidStatus == '' ? 'selected' : '' }}>---Có EID hay không---</option>
                        <option value="1" {{ $eidStatus == 1 ? 'selected' : '' }}>Có</option>
                        <option value="0" {{ $eidStatus == '0' ? 'selected' : '' }}>Không</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-sm-3">
                <div class="input-group">
                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                class="fa fa-list"></i></span></div>
                    <select name="status" class="select2 form-control" style="width: 100%;">
                        <option value="">---Tình trạng xử lý---</option>
                        @foreach ($ordersType as $k => $v)
                            <option value="{{ $k }}" @if ($k == ($search_data->status ?? null)) selected @endif>
                                {{ $v }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group col-sm-3">
                <div class="input-group">
                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                class="fa fa-list"></i></span></div>
                    <select name="user_id" id="user-handle" class="form-control select2" style="width: 100%;">
                        <option value="">---Nhân sự xử lý---</option>
                    </select>

                    @if ($users->isNotEmpty())
                        <input type="hidden" id="user-hanleName"
                            value="{{ $users->first()->email }} ({{ $users->first()->name }})">
                    @endif
                </div>
            </div>
        </div>

        <div class="row">

            <div class="form-group col-sm-3">
                <div class="input-group">
                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                class="fa fa-calendar"></i></span></div>
                    <input type="text" name="from_date" placeholder="Dặt từ ngày" class="datepicker form-control"
                        value="{{ @$search_data->from_date }}">
                </div>
            </div>
            <div class="form-group col-sm-3">
                <div class="input-group">
                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                class="fa fa-calendar"></i></span></div>
                    <input type="text" name="to_date" placeholder="Đến ngày" class="datepicker form-control"
                        value="{{ @$search_data->to_date }}">
                </div>
            </div>
            <div class="form-group col-sm-3">
                <div class="input-group">
                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                class="fa fa-bookmark-o"></i></span></div>
                    <input type="text" name="keyword" class="form-control"
                        placeholder="Thông tin khách: Họ tên, Email hoặc SĐT" value="{{ $input['keyword'] ?? '' }}">
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary"><i
                class="fa fa-refresh"></i> Reset</a>
        {{-- <a class="btn btn-sm btn-primary" style='color:white' href="{{ route('admin_product_add') }}"><i
                class="fa fa-plus"></i>Thêm mới</a> --}}
    </div>
</div>
{!! Form::close() !!}
