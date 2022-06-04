@extends('basecontainer::admin.layouts.default')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['url' => route('admin_contact_home_page'), 'method' => 'get', 'id' => 'searchForm']) !!}
            <div class="card card-accent-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><i
                                            class="fa fa-bookmark-o"></i></span></div>
                                <input type="text" name="shop_name" class="form-control" placeholder="Tên Shop"
                                    value="{{ $search_data->shop_name }}">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><i
                                            class="fa fa-bookmark-o"></i></span></div>
                                <input type="text" name="phone" class="form-control" placeholder="Số điện thoại"
                                    value="{{ $search_data->phone }}">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><i
                                            class="fa fa-bookmark-o"></i></span></div>
                                <input type="text" name="email" class="form-control" placeholder="Email"
                                    value="{{ $search_data->email }}">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><i
                                            class="fa fa-calendar"></i></span></div>
                                <input type="text" name="time_from" class="datepicker form-control"
                                    placeholder="Ngày tạo từ" autocomplete="off" value="{{ $search_data->time_from }}">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><i
                                            class="fa fa-calendar"></i></span></div>
                                <input type="text" name="time_to" class="datepicker form-control" placeholder="Ngày tạo đến"
                                    autocomplete="off" value="{{ $search_data->time_to }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                    <a href="{{ route('admin_contact_home_page') }}" class="btn btn-sm btn-primary"><i
                            class="fa fa-refresh"></i> Reset</a>
                    <a href="{{ route('admin_contact_export') }}" class="btn btn-sm btn-primary"><i
                                class="fa fa-refresh"></i> Xuất Excel</a>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="card card-accent-primary">
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th width="55">ID</th>
                                <th>Tên Shop</th>
                                <th width="100">Email</th>
                                <th width="125">Số điện thoại</th>
                                <th width="100">Ngày tạo</th>
                                <th width="55">Lệnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td width="55">{{ $key + 1 }}</td>
                                    <td>{{ $item->shop_name }}</td>
                                    <td width="100">{{ $item->email }}</td>
                                    <td width="125">{{ $item->phone }}</td>
                                    <td width="100">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                    <td width="55">
                                        <a href="javascript:;" data-toggle="modal" data-target="#modal{{ $item->id }}"
                                            class="btn text-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a data-href="{{ route('admin_contacts_delete', ['id' => $item->id]) }}"
                                            class="btn text-danger" onclick="admin.delete_this(this);">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Thông tin cụ thể</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-3 col-form-label">Tên shop</label>
                                                    <div class="col-sm-9">
                                                        {{ $item->shop_name }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        {{ $item->email }}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-3 col-form-label">Số điện thoại</label>
                                                    <div class="col-sm-9">
                                                        {{ $item->phone }}
                                                    </div>
                                                </div>
                                                @foreach ($fields as $field)
                                                    <div class="form-group row">
                                                        <label for="staticEmail" class="col-sm-3 col-form-label">{{ $field->lable }}</label>
                                                        <div class="col-sm-9">
                                                            @if ($item->fields->filter( function($f) use($field) {
                                                                return $f->field_id == $field->id;
                                                            })->isNotEmpty())
                                                                {{ $item->fields->filter( function($f) use($field) {
                                                                    return $f->field_id == $field->id;
                                                                })->first()->value }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    @include('basecontainer::admin.inc.bottom-pager-infor')
                </div>
            </div>
        </div>
    </div>
@stop
@push('js_bot_all')
    <script>
        $('.datepicker').datetimepicker({
            format: 'd/m/Y',
            timepicker: false
        });
    </script>
@endpush
