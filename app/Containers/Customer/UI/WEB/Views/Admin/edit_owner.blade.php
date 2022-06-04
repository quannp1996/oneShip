@extends('basecontainer::admin.layouts.default')
@section('content')
    <div class="container-fluid">
        <div class="header">
            <h2> 
                <a href="{{ route('owner.list') }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
                {{ __('customer::admin.edit.header', [
                    'string' => $owner->fullname
                ]) }} 
            </h2>
        </div>
        <div class="clearfix mb-2"></div>
        <div class="row">
            <div class="col-6">
                <form action="{{ route('owner.update', [
                    'id' => $owner->id
                ]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-accent-primary">
                        <div class="card-body">
                            <div class="header_label">
                                <p class="text-uppercase">{{ __('customer::admin.add.owner_infor') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="fullname">Avatar</label>
                                <input type="file" class="form-control rounded-0" id="avatar" autocomplete="false" name="avatar">
                            </div>
                            <div class="form-group">
                                <label for="fullname">{{ __('customer::admin.add.fullname') }}</label>
                                <input type="text" value="{{ @$owner->fullname }}" class="form-control rounded-0" id="fullname" autocomplete="false" name="fullname" placeholder="{{ __('customer::admin.add.fullname_placeholder') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">{{ __('customer::admin.add.phone') }}</label>
                                <input type="text" value="{{ @$owner->phone }}" class="form-control rounded-0" id="phone" autocomplete="false" name="phone" placeholder="{{ __('customer::admin.add.phone_placeholder') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('customer::admin.add.email') }}</label>
                                <input type="text" value="{{ @$owner->email }}" class="form-control rounded-0" id="email" autocomplete="false" name="email" placeholder="{{ __('customer::admin.add.email_placeholder') }}">
                            </div>
                            <div class="form-group">
                                <label for="address">{{ __('customer::admin.add.address') }}</label>
                                <input type="text" value="{{ @$owner->mainAddress->address }}" class="form-control rounded-0" id="address" autocomplete="false" name="address_book[address]" placeholder="{{ __('customer::admin.add.address_placeholder') }}">
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="email">{{ __('contractor::admin.edit.city_lable') }}</label>
                                        <select name="address_book[city_id]" id="city_dropdown" class="form-control rounded-0">
                                            <option value="">{{ __('contractor::admin.edit.city_lable') }}</option>
                                            @foreach ($allCities as $city)
                                                <option value="{{ $city->id }}" {{ @$owner->mainAddress->city_id == $city->id ? 'selected' : '' }}> {{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="email">{{ __('contractor::admin.edit.district_lable') }}</label>
                                        <select name="address_book[district_id]" class="form-control rounded-0" id="district_dropdown">
                                            <option value="">{{ __('contractor::admin.edit.district_lable') }}</option>
                                            @foreach ($allDistricts as $district)
                                                <option value="{{ $district->id }}" {{ @$owner->mainAddress->district_id == $district->id ? 'selected' : '' }}> {{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="email">{{ __('contractor::admin.edit.ward_lable') }}</label>
                                        <select name="address_book[ward_id]" class="form-control rounded-0" id="ward_dropdown">
                                            <option value="">{{ __('contractor::admin.edit.ward_lable') }}</option>
                                            @foreach ($allWards as $ward)
                                                <option value="{{ $ward->id }}" {{ @$owner->mainAddress->ward_id == $ward->id ? 'selected' : '' }}> {{ $ward->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success rounded-0">
                                {{ __('contractor::admin.edit.button_edit_label') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js_bot')
<script src="{{ asset('admin/js/location.js') }}"></script>
@endsection