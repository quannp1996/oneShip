@extends('basecontainer::admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if (isset($editMode) && $editMode)
                {!! Form::open(['url' => route('admin_deliverytype_edit_page', $data->id), 'files' => true]) !!}
            @else
                {!! Form::open(['url' => route('admin_deliverytype_add_page'), 'files' => true]) !!}
            @endif

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

            <div class="card card-accent-primary">
                <div class="card-header">
                    <i class="fa fa-pencil"></i> THÔNG TIN
                </div>
                <div class="card-body">
                    <div class="tabbable boxed parentTabs">
                        <ul class="nav nav-tabs nav-underline nav-underline-primary mb-3">
                            <li class="nav-item">
                                <a class="nav-link active" href="#general"><i class="fa fa-empire"></i> Chung</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#data"><i class="fa fa-deviantart"></i> Thông tin chi tiết</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#image"><i class="fa fa-image"></i> Hình ảnh</a>
                            </li> --}}
                        </ul>

                        <div class="tab-content p-0">
                            @include('settings::admin.deliverytype.edit_tabs.general')

                            @include('settings::admin.deliverytype.edit_tabs.data')
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Cập nhật</button>

                <a class="btn btn-sm btn-danger ml-4" href="{{ route('admin_banner_home_page') }}"><i class="fa fa-ban"></i> Hủy bỏ</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js_bot')
    {!! \FunctionLib::addMedia('admin/js/library/tinymce/tinymce.min.js') !!}
    <script type="text/javascript">
        admin.system.tinyMCE('.__editor', plugins = '', menubar = '', toolbar = '', height = 300);
    </script>
@endsection

@push('js_bot_all')
    <script type="text/javascript">
        $("ul.nav-tabs a").click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
    </script>
@endpush
