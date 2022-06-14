@extends('basecontainer::admin.layouts.default')


@section('content')
<div class="row">
    <div class="col-6">
        <div class="header">
            <h2> 
                @if (!empty($ward))
                    {{ __('location::admin.ward.edit_label', [
                        'string' => $ward->name
                    ]) }}
                @else
                    {{ __('location::admin.city.breadcrumb') }}
                @endif    
            </h2>
        </div>
        <form action="{{ route('location.ward_update', [
            'id' => $ward->id
        ]) }}" method="POST">
            @csrf
            <div class="card card-accent-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">{{ __('location::admin.city.city_name') }}</label>
                        <input type="text" class="form-control rounded-0" id="name" value="{{ $ward->name }}" autocomplete="false" name="name" placeholder="{{ __('location::admin.city.city_placeholder') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('location::admin.ward.city_label') }}</label>
                        <select class="form-control rouned-0" name="province_id" id="city_dropdown">
                            @foreach ($cities as $city)
                                <option {{ $city->id == @$ward->district->province_id ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('location::admin.ward.district_label') }}</label>
                        <select class="form-control rouned-0" name="district_id" id="district_dropdown">
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}" {{ $district->id == $ward->district_id ? 'selected' : '' }}>{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('location.ward_list') }}" class="btn btn-sm btn-danger">
                        <i class="fa fa-ban"></i>
                        {{__('location::admin.cancle')}}
                    </a>
                    <button class="btn btn-sm btn-primary">
                        <i class="fa fa-dot-circle-o"></i>
                        @if (!empty($ward))
                            {{ __('location::admin.edit_button') }}
                        @else
                            {{ __('location::admin.add_button') }}
                        @endif
                    </button>
                </div>
            </div>
            <input type="hidden" value="{{ $ward->id }}" name="id"/>
        </form>
    </div>
</div>

@endsection
@section('js_bot')
<script src="{{ asset('admin/js/location.js') }}"></script>
@endsection