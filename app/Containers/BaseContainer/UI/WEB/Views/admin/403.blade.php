@extends('basecontainer::admin.layouts.errors')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="clearfix">
                <h1 class="float-left display-3 mr-4">403</h1>
                <h4 class="pt-3">Oops! You don't have permission for this action.</h4>
                <p class="text-muted">{{ $exception->getMessage() }}</p>
            </div>
            {{--<div class="input-prepend input-group">--}}
                {{--<div class="input-group-prepend"><span class="input-group-text">--}}
                        {{--<svg class="c-icon">--}}
                            {{--<use xlink:href="{{ asset('admin/vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass') }}"></use>--}}
                        {{--</svg></span></div>--}}
                {{--<input class="form-control" id="prependedInput" size="16" type="text"--}}
                    {{--placeholder="What are you looking for?"><span class="input-group-append">--}}
                    {{--<button class="btn btn-info" type="button">Search</button></span>--}}
            {{--</div>--}}
        </div>
        <div class="col-md-12 mt-5" align="center">
            <a href="{{ route('get_admin_dashboard_page') }}" type="button" class="btn btn-outline-primary">
                <i class="fa fa-home"></i>&nbsp; Trang chủ</a>
        </div>
    </div>
</div>
@endsection
