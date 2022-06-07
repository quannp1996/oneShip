@extends('basecontainer::admin.layouts.default')
@section('content')
    <div class="container-fluid">
        <div class="header mb-5">
            <h2> {{ __('customer::admin.list.header') }} </h2>
        </div>
        <form action="{{ route('owner.list') }}" method="GET">
            <div class="card card-accent-primary">
                <div class="card-body">
                    <div class="filter__form mt-2 mb-2">
                        <div class="row">
                            <div class="col-3">
                                <span class="icon__calendar">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </span>
                                <input type="text" name="keyword" value="{{ @$searchData['keyword'] }}" class="form-control rounded-0" placeholder="{{ __('customer::admin.list.filter_form.owner_placeholder') }}">
                            </div>
                            <div class="col-3">
                                <input type="text" name="address" value="{{ @$searchData['address'] }}" class="form-control rounded-0" placeholder="{{ __('customer::admin.list.filter_form.address_placeholder') }}">
                            </div>
                            <div class="col-3">
                                <span class="icon__calendar">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                                <input type="text" autocomplete="fax" placeholder="{{ __('contractor::admin.list.calendar_placeholder') }}" class="form-control rounded-0 datetimepicker" value="{{ @$searchData['started_at'] }}" name="started_at"/>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="status" value="{{ @$searchData['status'] }}"/>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
                    <a href="{{ route('owner.add') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i>
                        {{ __('customer::admin.add.header') }}
                    </a>
                </div>
            </div>
        </form>
        <div class="card card-accent-primary">
            <div class="card-header">
                <ul class="nav nav-tabs nav-underline nav-underline-primary card-header-tabs" style="border-bottom: unset;border-color:unset;">
                    <li class="nav-item">
                        <a class="nav-link {{ @$searchData['status'] == 2 ? 'active' : '' }}" href="{{ route('owner.list').'?status=2' }}">
                            {{__('contractor::admin.list.active', [
                                'number' => @$countOwners[2]->count ?? 0
                            ])}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ @$searchData['status'] == 1 ? 'active' : '' }}" href="{{ route('owner.list').'?status=1' }}">
                            {{__('contractor::admin.list.notactive', [
                                'number' => @$countOwners[1]->count ?? 0
                            ])}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ @$searchData['status'] == 3 ? 'active' : '' }}" href="{{ route('owner.list').'?status=3' }}">
                            {{__('contractor::admin.list.block', [
                                'number' => @$countOwners[3]->count ?? 0
                            ])}}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped " id="tableOwner">
                    <thead>
                        <tr>
                            <th class="text-center">
                            </th>
                            <th>
                                {{ __('customer::admin.list.thead_owner')}}
                            </th>
                            <th>
                                {{ __('customer::admin.list.thead_address')}}
                            </th>
                            <th>
                                {{ __('customer::admin.list.thead_latest_building')}}
                            </th>
                            <th>
                                {{ __('customer::admin.list.registration_date')}}
                            </th>
                            <th>
                                {{ __('contractor::admin.list.action')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($owners as $owner)
                            <tr>
                                <td class="text-center">
                                    {{ $owner->id }}
                                </td>
                                <td>
                                    <a href="{{ route('owner.edit', [
                                        'id' => $owner->id
                                    ]) }}">
                                        {{ $owner->fullname }}
                                    </a>
                                </td>
                                <td>
                                    {{ @$owner->mainAddress->address }}
                                </td>
                                <td>
                                    @if ($owner->latestBuilding)
                                        {{ $owner->latestBuilding->name }}
                                    @endif
                                </td>
                                <td>
                                    {{ $owner->created_at }}
                                </td>
                                <td>
                                    <a href="{{ route('owner.detail', [
                                        'id' => $owner->id
                                    ]) }}">
                                        <span class=""><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Xem</span>&nbsp;&nbsp;
                                    </a>
                                    @can('owner-add')
                                        <form action="{{ route('owner.delete', [
                                            'id' => $owner->id
                                        ]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn p-0" onclick="return confirm('Bạn có chắc chắn muốn xóa Chủ nhà')">
                                                <span class=""><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Xóa</span>&nbsp;&nbsp;
                                            </button>
                                        </form>
                                    @endcan
                                    @can('owner-block')
                                        @if ($owner->status == config('user-container.status.blocked'))
                                            <a href="{{ route('owner.unblock', [
                                                'id' => $owner->id
                                            ]) }}">
                                                <span class=""><i class="fa fa-unlock" aria-hidden="true"></i>&nbsp;Mở Khóa</span>
                                            </a>
                                        @elseif($owner->status == config('user-container.status.actived'))
                                            <a href="{{ route('owner.block', [
                                                'id' => $owner->id
                                            ]) }}">
                                                <span class=""><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;Khóa</span>
                                            </a>
                                        @elseif($owner->status == config('user-container.status.deactived'))
                                            <a href="{{ route('owner.active', [
                                                'id' => $owner->id
                                            ]) }}">
                                                <span class=""><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Kích hoạt</span>
                                            </a>
                                        @endif
                                    @endcan
                                </td>
                            </tr>  
                        @empty
                            <tr>
                                <td colspan="6">
                                    <p class="ml-4">
                                        {{ __('contractor::admin.list.not_found') }}
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($owners->hasPages())
            <div class="card-footer">
                    {{ $owners->appends($searchData)->links() }}
            </div>
            @endif
        </div>
    </div>
@endsection
@push('css_bot_all')
  <link rel="stylesheet" href="{{ asset('admin/css/jquery.datetimepicker.min.css') }}" />
@endpush 

@push('js_bot_before')
  <script src="{{ asset('admin/js/library/jquery.datetimepicker.min.js') }}"></script>
@endpush