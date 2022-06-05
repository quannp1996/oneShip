@extends('basecontainer::admin.layouts.default')
@section('content')
    <form action="" enctype="multipart/form-data">
        <div class="row">
            <div class="col-5">
                <div class="card card-accent-primary">
                    <div class="card-header">
                        <i class="fa fa-pencil"></i>
                        Thông tin cơ bản
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Tiêu đề">
                        </div>
                        <div class="form-group">
                            <label for="type">Đơn vị vận chuyển</label>
                            <select name="type" class="form-control" id="type">
                                @foreach ($list_type as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Dev Mode</label>
                            <label class="c-switch c-switch-label c-switch-primary m-0 align-middle">
                                <input type="hidden" name="dev_mode" value="0">
                                <input type="checkbox" id="switchViewType" name="dev_mode" value="1" class="c-switch-input"
                                    {{ @$data['dev_mode'] == 1 ? 'checked' : '' }}>
                                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="image">Ảnh</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @if (@$data->image)
                                <img src="{{ ImageUrl::getImageUrl($data->image, 'shipping', '') }}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="card card-accent-primary">
                    <div class="card-header">
                        <i class="fa fa-shield"></i>
                        Thông tin bảo mật
                        <br>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Tên Key</th>
                                    <th scope="col">Giá trị</th>
                                    <th scope="col">
                                        <button class="btn btn-sm btn-success">Thêm</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>
                                        <input type="text" name="extra[]">
                                    </th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-sm btn-primary" id="subMitForm"><i class="fa fa-dot-circle-o"></i>
                Cập nhật
            </button>
            <a class="btn btn-sm btn-danger" href="https://admin.oneship.test/page">
                <i class="fa fa-ban"></i>
                Hủy bỏ
            </a>
        </div>
    </form>
@endsection
