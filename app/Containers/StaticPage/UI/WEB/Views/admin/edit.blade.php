@extends('basecontainer::admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if (isset($editMode) && $editMode)
                {!! Form::open(['url' => route('admin_staticpage_edit_page', $data->id) , 'files' => true]) !!}
            @else
                {!! Form::open(['url' => route('admin_staticpage_add_page') , 'files' => true]) !!}
            @endif

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

            <div class="card card-accent-primary">
                <div class="card-header">
                    <i class="fa fa-pencil"></i>THÔNG TIN
                </div>
                <div class="card-body">
                    <div class="tabbable boxed parentTabs">
                        <ul class="nav nav-tabs nav-underline nav-underline-primary mb-3">
                            <li class="nav-item">
                                <a class="nav-link active" href="#general"><i class="fa fa-empire"></i> Chung</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#data"><i class="fa fa-info-circle"></i> Thông tin bổ sung</a>
                            </li>
                        </ul>
                        <div class="tab-content p-0">
                            @include('staticpage::admin.edit_tabs.general')
                            @include('staticpage::admin.edit_tabs.data')
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-sm btn-primary" id="subMitForm"><i class="fa fa-dot-circle-o"></i> Cập nhật
                </button>
                <a class="btn btn-sm btn-danger" href="{{ route('admin_staticpage_home_page') }}"><i class="fa fa-ban"></i>
                    Hủy bỏ</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    {!! FunctionLib::addMedia('admin/js/library/tag/jquery.tag-editor.css') !!}
    {!! FunctionLib::addMedia('admin/js/library/uploadifive/uploadifive.css') !!}
@stop

@push('js_bot_all')
    {!! FunctionLib::addMedia('admin/js/library/tinymce/tinymce.min.js') !!}
    {!! FunctionLib::addMedia('admin/js/library/tag/jquery.caret.min.js') !!}
    {!! FunctionLib::addMedia('admin/js/library/tag/jquery.tag-editor.min.js') !!}
    {!! FunctionLib::addMedia('admin/js/library/jquery.form.js') !!}
    {!! FunctionLib::addMedia('admin/js/library/jquery.sortable.js') !!}

    <script type="text/javascript">
        $("ul.nav-tabs a").click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
        admin.system.tinyMCE('.__editor', plugins = '', menubar = '', toolbar = '', height = 500, '95%');
        var pageContent = tinymce.init({
            selector: '.cms-edit',
            height: 1000,
            width: 1500,
            // inline: true,
            plugins: [
                'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
            content_css: [
                '{{ config('app.url').'/template/css/style.css' }}'        
            ],
        });
    </script>
@endpush
