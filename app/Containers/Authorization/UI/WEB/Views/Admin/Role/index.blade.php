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

            {!! Form::open(['url' => route('admin_authorization_get_all_roles'), 'method' => 'get', 'id' => 'searchForm']) !!}
            <div class="card card-accent-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><i
                                            class="fa fa-bookmark-o"></i></span></div>
                                <input type="text" name="name" class="form-control" placeholder="Định danh"
                                    value="{{ $search_data->name }}">
                            </div>
                        </div>

                        <div class="form-group col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><i
                                            class="fa fa-bookmark-o"></i></span></div>
                                <input type="text" name="display_name" class="form-control" placeholder="Tên hiển thị"
                                    value="{{ $search_data->display_name }}">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                    <a href="{{ route('admin_authorization_get_all_roles') }}" class="btn btn-sm btn-primary"><i
                            class="fa fa-refresh"></i> Reset</a>
                    <a href="{{ route('admin_authorization_add_role') }}" class="btn btn-sm btn-primary"><i
                            class="fa fa-plus"></i> Thêm mới</a>

                </div>
            </div>
            {!! Form::close() !!}

            <div class="card card-accent-primary">
                <div class="card-body p-0">
                    @if (empty($data) || $data->isEmpty())
                        <h4 align="center">Không tìm thấy dữ liệu phù hợp</h4>
                    @else
                        <table class="table table-bordered table-striped ">
                            <thead>
                            <tr>
                                <th width="55" class="text-center">ID</th>
                                <th width="300">Định danh</th>
                                <th>Tên hiển thị</th>
                                <th width="90" class="text-center">Level</th>
                                <th>Mô tả</th>
                                {{-- <th>Quyền hạn</th> --}}
                                <th width="100" class="text-center">Ngày tạo</th>
                                {{-- @if (\FunctionLib::can($permission, 'edit')) --}}
                                <th width="55" class="text-center">Sửa</th>
                                {{-- @endif --}}
                                {{-- @if (\FunctionLib::can($permission, 'delete')) --}}
                                <th width="55" class="text-center">Xóa</th>
                                {{-- @endif --}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td align="center">{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->display_name }}</td>
                                    <td align="center">{{ $item->level }}</td>
                                    <td>{{ $item->description }}</td>
                                    {{-- <td>
                            @if ($item->id == 1)
                                <b class="text-danger">--- ALL ---</b>
                            @elseif(!empty($item->permit))
                                <a data-toggle="collapse" href="#role{{ $item->id }}" role="button" aria-expanded="false" aria-controls="role{{ $item->id }}">
                                    Chi tiết quyền</a>
                                <div class="collapse" id="role{{ $item->id }}">
                                    <div class="card card-body">
                                    @php($item->permit = json_decode($item->permit, 1))
                                    @foreach ($item->permit as $k => $val)
                                        @php($val = implode(' - ', $val))
                                        <p><b>{{ $k }}:</b> <span class="text-success">{{ $val }}</span></p>
                                    @endforeach
                                    </div>
                                </div>
                            @endif
                        </td> --}}
                                    <td align="center">{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td align="center">
                                        {{-- @if ($item->id != 1 && \Auth::user()->checkMyRank($item->rank)) --}}
                                        <a href="{{ route('admin_authorization_edit_role', $item->getHashedKey()) }}"
                                           class="text-primary"><i class="fa fa-pencil"></i></a>
                                        {{-- @endif --}}
                                    </td>
                                    <td align="center">
                                        {{-- @if ($item->id != 1 && \Auth::user()->checkMyRank($item->rank)) --}}
                                        <a href="javascript:void(0)"
                                           data-href="{{ route('admin_authorization_delete_role', $item->getHashedKey()) }}"
                                           class="text-danger" onclick="admin.delete_this(this)"><i
                                                    class="fa fa-trash-o"></i></a>
                                        {{-- @endif --}}
                                    </td>
                                    {{-- @if (\Lib::can($permission, 'edit'))
                            <td align="center">
                                @if ($item->id != 1 && \Auth::user()->checkMyRank($item->rank))
                                    <a href="{{ route('admin.'.$key.'.edit', $item->id) }}" class="text-primary"><i class="icon-pencil icons"></i></a>
                                @endif
                            </td>
                        @endif
                        @if (\Lib::can($permission, 'delete'))
                            <td align="center">
                                @if ($item->id != 1 && \Auth::user()->checkMyRank($item->rank))
                                    <a href="{{ route('admin.'.$key.'.delete', $item->id) }}"  class="text-danger" onclick="return confirm('Bạn muốn xóa ?')"><i class="icon-trash icons"></i></a>
                                @endif
                            </td>
                        @endif --}}
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

@section('js_bot')
    {!! \FunctionLib::addMedia('admin/containers/authorization/role.js') !!}
@endsection
