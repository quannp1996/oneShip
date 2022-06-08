@extends('basecontainer::admin.layouts.default')

@section('right-breads')
    {!! $data->appends($search_data->toArray())->links('basecontainer::admin.inc.paginator') !!}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="mb-5"><h1>{{ $site_title }}</h1></div>

        @if( count($errors) > 0)
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

        {!! Form::open(['url' => route('admin_authorization_get_all_perms'), 'method' => 'get', 'id' => 'searchForm']) !!}
        <div class="card card-accent-primary">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-bookmark-o"></i></span></div>
                            <input type="text" name="name" class="form-control" placeholder="Định danh" value="{{ $search_data->name }}">
                        </div>
                    </div>

                    <div class="form-group col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-bookmark-o"></i></span></div>
                            <input type="text" name="display_name" class="form-control" placeholder="Tên hiển thị" value="{{ $search_data->display_name }}">
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                <a href="{{route('admin_authorization_add_perm')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
            </div>
        </div>
        {!! Form::close() !!}
        <div class="card card-accent-primary">
            <div class="card-body p-0">
                @if(empty($data) || $data->isEmpty())
                    <h4 align="center">Không tìm thấy dữ liệu phù hợp</h4>
                @else
                    <table class="table table-bordered table-striped ">
                        <thead>
                        <tr>
                            <th width="55" class="text-center">ID</th>
                            <th width="300">Định danh</th>
                            <th>Tên hiển thị</th>
                            <th>Mô tả</th>
                            <th>Container</th>
                            <th width="100" class="text-center">Ngày tạo</th>
                            <th width="55" class="text-center">Sửa</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td align="center">{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{$item->display_name}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->containers}}</td>
                                <td align="center">{{ $item->created_at->format('d/m/Y') }}</td>
                                <td align="center">
                                    {{-- @if($item->id != 1 && \Auth::user()->checkMyRank($item->rank)) --}}
                                    <a href="{{ route('admin_authorization_edit_perm', $item->getHashedKey()) }}" class="text-primary"><i class="fa fa-pencil"></i></a>
                                    {{-- @endif --}}
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

@section('js_bot')

@endsection