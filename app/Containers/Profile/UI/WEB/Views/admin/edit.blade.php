@extends('basecontainer::admin.layouts.default')
@section('content')
<div class="row">
    <div class="col-sm-12">
        {!! Form::open(['url' => route('admin_profile_page'), 'files' => true, 'id' => 'updateProfileForm']) !!}
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
                    <i class="fa fa-pencil"></i>THÔNG TIN CÁ NHÂN
                </div>
                <div class="card-body">
                    <div class="tabbable boxed parentTabs">
                        {{-- <ul class="nav nav-tabs nav-underline nav-underline-primary mb-3">
                            <li class="nav-item">
                                <a class="nav-link active" href="#general"><i class="fa fa-empire"></i> Chung</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#details"><i class="fa fa-deviantart"></i> Thông tin chi tiết</a>
                            </li>
                        </ul> --}}
                        <div class="tab-content p-0">
                            <div class="tab-content p-0">
                                @include('profile::admin.tabs.general')

                                {{-- @include('profile::admin.tabs.details') --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" onclick="return confirmPassword()" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Cập nhật</button>
                    &nbsp;&nbsp;
                    <a class="btn btn-sm btn-danger" href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-ban"></i>
                        Hủy bỏ</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
@push('js_bot_all')
    <script type="text/javascript">
        $("ul.nav-tabs a").click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
        $('.datepicker').datetimepicker({
            format: 'd/m/Y',
            timepicker: false
        });
        function confirmPassword(){
            const password = $('#password').val();
            const password1 = $('#password1').val();
            if(password !== password1){
                $('#errors_confirm__password').show();
                return false;
            }else{
                $('#errors_confirm__password').hide();
                return true;
            }
        }
    </script>
    @push('js_bot_all')
@endpush
@endpush
