@extends('basecontainer::admin.layouts.default')
@section('content')
    <div class="container-fluid mb-5">
        <div class="header">
            <h2> {{ __('customer::admin.detail.header', [
                'string' => $owner->fullname
            ]) }} </h2>
        </div>
        <div class="clearfix mb-2"></div>
        <div class="row">
            <div class="col-6" id="base_information">
                <div class="card card-accent-primary">
                    <div class="card-body">
                        <div class="lable text-uppercase mb-4"><p>{{ __('customer::admin.detail.base_information') }}</p></div>
                        <div class="form-group row">
                            <div class="col-3">
                                <label for="username">{{ __('customer::admin.detail.avatar') }}</label>
                            </div>
                            @if ($owner->avatar)
                                <img class="rounded-circle" src="{{ ImageURL::getImageUrl($owner->avatar, 'customer', 'avatar') }}">
                            @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-3">
                                <label for="fullname">{{ __('customer::admin.add.fullname') }}</label>
                            </div>
                            <span id="fullname">{{ $owner->fullname }}</span>
                        </div>
                        <div class="form-group row">
                            <div class="col-3">
                                <label for="phone">{{ __('customer::admin.add.phone') }}</label>
                            </div>
                            <span id="phone">{{ $owner->phone }}</span>
                        </div>
                        <div class="form-group row">
                            <div class="col-3">
                                <label for="email">{{ __('customer::admin.add.email') }}</label>
                            </div>
                            <span id="email">{{ $owner->email }}</span>
                        </div>
                        <div class="form-group row">
                            <div class="col-3">
                                <label for="address">{{ __('customer::admin.add.address') }}</label>
                            </div>
                            <span id="address">{{ @$owner->mainAddress->address }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6" id="active_information">
                <div class="card card-accent-primary">
                    <div class="card-body">
                        <div class="lable text-uppercase mb-4"><p>{{ __('customer::admin.detail.active_infomation') }}</p></div>
                        <div class="form-group row">
                            <div class="col-3">
                                <label for="number_follow">{{ __('customer::admin.detail.number_follow') }}</label>
                            </div>
                            <span id="number_follow">{{ @$owner->follow_count ?? 0 }}</span>
                        </div>
                        <div class="form-group row">
                            <div class="col-3">
                                <label for="number_comment">{{ __('customer::admin.detail.number_comment') }}</label>
                            </div>
                            <span id="number_comment">{{ @$owner->comments_count ?? 0 }}</span>
                        </div>
                        <div class="form-group row">
                            <div class="col-3">
                                <label for="number_comment">{{ __('customer::admin.detail.partner_cooperation') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Some of Building-->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-accent-primary">
                    <div class="card-header">
                        <div class="float-left" class="align-middle">
                            <p class="text-uppercase"> {{ __('contractor::admin.detail.number_of_building', [
                                'number' => @$owner->buildings_count ?? 0
                            ]) }} </p>
                        </div>
                        <div class="float-right">
                            <a href="#" class="btn btn-success rounded-0">
                                {{ __('contractor::admin.detail.see_all_buildins') }}
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="card-body">
                        <table class="table borderless">
                            <thead>
                                <tr>
                                    <th>
                                        {{ __('contractor::admin.detail.building_name_lable') }}
                                    </th>
                                    <th>
                                        {{ __('contractor::admin.detail.whom_post') }}
                                    </th>
                                    <th>
                                        {{ __('contractor::admin.services.list.status') }}
                                    </th>
                                    <th>
                                        {{ __('contractor::admin.list.action') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($owner->someBuildings as $building)
                                    
                                @empty
                                <tr>
                                    <td colspan="4">
                                        {{ __('customer::admin.detail.building_notfound') }}
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-accent-primary">
                    <div class="card-header">
                        <div class="float-left" class="align-middle">
                            <p class="text-uppercase"> {{ __('customer::admin.detail.latest_comment_lable') }} </p>
                        </div>
                        <div class="float-right">
                            <a href="{{ route('admin.comments.index', [
                                'customer_id' => $owner->id,
                                'status' => 2
                            ]) }}" class="btn btn-success rounded-0">
                                {{ __('contractor::admin.detail.see_all_comments') }}
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="card-body">
                        <table class="table borderless">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th>
                                        {{ __('customer::admin.detail.comment') }}
                                    </th>
                                    <th>
                                        {{ __('customer::admin.detail.building') }}
                                    </th>
                                    <th>
                                        {{ __('customer::admin.detail.action') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (@$owner->someComments ?? [] as $comment)
                                    <tr>
                                        <td>
                                            {{ $comment->id }}
                                         </td>
                                         <td style="width: 700px;">
                                            <span class="number_of__media">
                                                {{ $comment->video_medias_count }}&nbsp;
                                                <i class="fa fa-camera" aria-hidden="true"></i>
                                                &nbsp;&nbsp;
                                                {{ $comment->image_medias_count }}&nbsp;
                                                <i class="fa fa-picture-o" aria-hidden="true"></i>
                                            </span>
                                            <br>
                                            <p>{{ $comment->content }}</p>
                                            <small>
                                                @if ($owner->avatar)
                                                    <img class="rounded-circle" src="{{ ImageURL::getImageUrl($owner->avatar, 'customer', 'mini') }}">
                                                @endif
                                                <strong>{{ $owner->fullname }}</strong>&nbsp;
                                                 <i>{{ date('d/m/Y', strtotime($comment->created_at)) }}</i>
                                            </small>
                                         </td>
                                         <td>
                                         </td>
                                         <td>
                                            @if ($comment->status == 1)
                                                <form action="{{ route('admin.comments.approve') }}" method="POST">
                                                    @csrf
                                                    <button class="btn">
                                                        <span><i class="fa fa-check" aria-hidden="true"></i>Duyệt</span>
                                                    </button>
                                                    <input type="hidden" value="{{ $comment->id }}" name="id">
                                                </form>
                                            @endif
                                            <a href="{{ route('admin.comments.edit', [
                                                'id' => $comment->id
                                            ]) }}" class="ml-3">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                Sửa
                                            </a>
                                            {{ Form::open(array('url' => route('admin.comments.delete-display', [
                                                'id' => $comment->id
                                            ]), 'method' => 'PUT', 'class'=>'col-md-12')) }}
                                                <button class="btn pl-0" onclick="return confirm('Bạn có chắc chắc muốn xóa')">
                                                    <span><i class="fa fa-trash" aria-hidden="true"></i>Xóa</span>
                                                </button>
                                            {{ Form::close() }}
                                         </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            {{ __('customer::admin.detail.comment_notfound') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="footer">
            <div class="float-left" class="align-middle">
                <a href="{{ route('owner.list') }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    <span> {{ __('customer::admin.detail.back') }} </span>
                </a>
            </div>
            <div class="float-right">
                @if ($owner->status == 2)
                    <a href="{{ route('owner.block', [
                        'id' => $owner->id
                    ]) }}" class="btn btn-danger rounded-0">
                        {{ __('contractor::admin.detail.block_account') }}
                    </a>
                @elseif($owner->status == 3)
                    <a href="{{ route('owner.unblock', [
                        'id' => $owner->id
                    ]) }}" class="btn btn-danger rounded-0">
                        {{ __('contractor::admin.detail.unblock_account') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js_bot')
<script src="{{ asset('admin/js/location.js') }}"></script>
<script>
    $("#checkAllComment").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
@endsection