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

            {{-- {!! \Form::open(['url' => route('get_user_home_page'), 'method' => 'get', 'id' => '']) !!} --}}
            <form action="{{ route('get_user_home_page') }}" method="get" id="searchForm">
                <div class="card card-accent-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                                class="fa fa-user"></i></span></div>
                                    <input type="text" name="name" class="form-control" placeholder="Họ và Tên"
                                        value="{{ $search_data['name'] }}">
                                </div>
                            </div>

                            <div class="form-group col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                                class="fa fa-envelope-o"></i></span></div>
                                    <input type="text" name="email" class="form-control" placeholder="Email"
                                        value="{{ $search_data['email'] }}">
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                                class="fa fa-phone"></i></span></div>
                                    <input type="text" name="phone" class="form-control" placeholder="Số điện thoại"
                                        value="{{ $search_data['phone'] }}">
                                </div>
                            </div>

                            {{-- <div class="form-group col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-gears"></i></span></div>
                            <select id="status" name="status" class="form-control">
                                <option value="">-- Trạng thái --</option>
                                @foreach ($statusOpt as $k => $v)
                                    <option value="{{ $k }}"{{$search_data->status != '' && $search_data->status == $k ? ' selected="selected"' : ''}}>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                        </div>
                        <div class="row">
                            {{-- <div class="form-group col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-gears"></i></span>
                            <select id="role" name="role" class="form-control">
                                <option value="">-- Quyền hạn --</option>
                                @foreach ($roles as $r)
                                    <option value="{{ $r->id }}" {{$search_data->role != '' && $search_data->role == $r->id ? ' selected="selected"' : ''}}>{{ $r->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                            <div class="form-group col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                                class="fa fa-calendar"></i></span></div>
                                    <input type="text" name="time_from" class="datepicker form-control"
                                        placeholder="Từ ngày" autocomplete="off" value="{{ $search_data->time_from }}">
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><i
                                                class="fa fa-calendar"></i></span></div>
                                    <input type="text" name="time_to" class="datepicker form-control"
                                        placeholder="Đến ngày" autocomplete="off" value="{{ $search_data->time_to }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                        <a href="{{ route('get_user_home_page') }}" class="btn btn-sm btn-primary"><i
                                class="fa fa-refresh"></i> Reset</a>
                        @if($user->can('update-users'))
                        <a href="{{ route('admin_user_add_page') }}" class="btn btn-sm btn-primary"><i
                                class="fa fa-plus"></i> Thêm mới</a>
                        @endif
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
                                <th width="55">ID</th>
                                <th width="150">Tài khoản đăng nhập</th>
                                <th width="200">Thông tin cá nhân</th>
                                <th>Vai trò</th>
                                <th width="200">Đăng nhập</th>
                                <th width="120">Trạng thái</th>
                                <th width="100">Ngày ĐK</th>
                                @if($user->can('update-users'))
                                    <th width="55">KH</th>
                                @endif
                                @if($user->can('update-users') || $user->can('delete-users') || $user->can('list-user-logs'))
                                    <th width="55">Lệnh</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $u)
                                <tr>
                                    <td align="center">{{ $u->id }}</td>
                                    <td><b>{{ $u->email }}</b></td>
                                    <td>
                                        <div><b>N:</b> {{ $u->name }}</div>
                                        <div><b>E:</b> {{ $u->email }}</div>
                                        <div><b>T:</b> {{ $u->phone }}</div>
                                    </td>
                                    <td>
                                        @if($u->isRoot())
                                            <div class="badge badge-danger mb-1 mr-2">ROOT</div>
                                        @endif
                                        @foreach ($u->roles as $role)
                                            <div class="badge badge-danger mb-1 mr-2">{{ $role->display_name }}</div>
                                        @endforeach
                                    </td>
                                     <td>
                                        <div><b>IP:</b> {{ $u->last_login_ip }}</div>
                                        <div><b>Lúc:</b> {{ \FunctionLib::dateFormat($u->last_login, 'd/m/Y H:i:s') }}</div>
                                    </td>
                                     <td>
                                         <span class="badge badge-{{ $u->getStatusClass() }}">{{ $u->getStatusText() }}</span>
                                         @if (!empty($u->last_logout))
                                             <span title="{{ $u->last_logout->format('d/m/Y') }}">{{ $u->last_logout->format('H:i:s') }}</span>
                                         @elseif(!empty($u->last_active))
                                             <span title="{{ $u->last_active->format('d/m/Y') }}">{{ $u->last_active->format('H:i:s') }}</span>
                                         @endif
                                     </td>
                                    <td align="center">{{ $u->created_at->format('d/m/Y H:i:s') }}</td>
                                    @if($user->can('update-users'))

                                        <td align="center">
                                            @if (!$u->isRoot() && !$u->isMySelf() && $user->biggerThanYou($u->id, $u))
                                                <a href="javascript:void(0)" data-route="{{route('admin_user_active', $u->getHashedKey())}}" onclick="admin.updateStatus(this,'{{$u->getHashedKey()}}',1)"
                                                @if($u->active == 1)
                                                    class="text-success" title="Bấm để khóa tài khoản">
                                                @else
                                                    class="text-secondary" title="Bấm để kích hoạt tài khoản">
                                                @endif
                                                    <i class="fa fa-check-circle"></i></a>
                                            @endif
                                        </td>
                                    @endif
                                    @if($user->can('update-users') || $user->can('delete-users'))
                                        <td align="center">
                                            @if($user->can('list-user-logs'))
                                                <div class="mb-2">
                                                    <a href="{{ route('admin_user_log', ['user_name' => $u->email]) }}" class="text-dark" title="Xem lịch sử hoạt động">
                                                        <i class="fa fa-search"></i></a></div>
                                            @endif
                                            @if($user->can('update-users'))
                                                @if ($user->isRoot() || $u->isMySelf() || $user->biggerThanYou($u->id, $u))
                                                    <div class="mb-2">
                                                        <a href="{{ route('admin_user_edit_page', $u->getHashedKey()) }}" title="Sửa"
                                                           class="text-primary"><i class="fa fa-pencil"></i></a></div>
                                                @endif
                                            @endif

                                            @if($user->can('delete-users'))
                                                @if (!$u->isRoot() && !$u->isMySelf() && !$u->isRemoved() && $user->biggerThanYou($u->id, $u))
                                                    <div>
                                                        <a data-href="{{ route('admin_user_delete', $u->getHashedKey()) }}"  class="text-danger" onclick="admin.delete_this(this);" title="Xóa"
                                                           class="text-danger"><i class="fa fa-trash"></i></a></div>
                                                @endif
                                            @endif
                                        </td>
                                    @endif
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
