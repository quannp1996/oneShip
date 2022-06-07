@extends('basecontainer::admin.layouts.default_for_iframe')
@section('content')
<div class="row" id="sectionContent">
  <div class="col-12">
    <div class="card mb-0">
      <form action="{{ route('admin.customers-groups.store') }}" method="POST">
        @csrf
        <div class="card-header d-flex">
          <a href="javascript:void(0)" class="mt-2">Tạo nhóm khách hàng</a>
          <div class="ml-auto">
            <button type="button" class="btn btn-secondary" onclick="return closeFrame()">Đóng lại</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu thông tin</button>
          </div>
        </div>

        <div class="card-bod">
          <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="title">Tên nhóm</label>
                        <input  type="text"
                                class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                id="title"
                                name="title"
                                value="{{ old('email',@$data->title) }}"
                                required
                        />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="sort">Sắp xếp</label>
                        <input  type="number"
                                min="1"
                                class="form-control{{ $errors->has('sort') ? ' is-invalid' : '' }}"
                                id="sort"
                                name="sort"
                                value="{{ old('sort', $data->sort ?? 1) }}"
                                required
                        />
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
        </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
