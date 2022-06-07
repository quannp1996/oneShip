@extends('basecontainer::admin.layouts.default')
@section('content')
    <form action="{{ 
        !empty($data)
        ? route('admin_shipping_unit_update', ['id' => $data->id])
        : route('admin_shipping_unit_store')
    }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-5">
                <div class="card card-accent-primary">
                    <div class="card-header">
                        <i class="fa fa-pencil"></i>
                        Thông tin cơ bản
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="type">Dev Mode</label>
                            <label class="c-switch c-switch-label c-switch-primary m-0 align-middle">
                                <input type="hidden" name="dev_mode" value="0">
                                <input type="checkbox" id="switchViewType" name="dev_mode" value="1" class="c-switch-input"
                                    {{ @$data['dev_mode'] == 1 ? 'checked' : '' }}>
                                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                            </label>
                            &nbsp;&nbsp;&nbsp;
                            <label for="type">Trạng thái</label>
                            <label class="c-switch c-switch-label c-switch-primary m-0 align-middle">
                                <input type="hidden" name="status" value="0">
                                <input type="checkbox" id="switchViewType" name="status" value="1" class="c-switch-input"
                                    {{ @$data['status'] == 1 ? 'checked' : '' }}>
                                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" value="{{ @$data->title }}" class="form-control" id="title" placeholder="Tiêu đề">
                        </div>
                        <div class="form-group">
                            <label for="type">Đối tác vận chuyển</label>
                            <select name="type" class="form-control" id="type">
                                @foreach ($list_type as $key => $item)
                                    <option value="{{ $key }}" {{ @$data->type == $key ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
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
                                        <button class="btn btn-sm btn-success" type="button" onclick="item.add()">
                                            <i class="fa fa-plus"></i>
                                            Thêm
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="items">
                                @forelse (!empty($data) ? @$data->toSecurityJson() : [] as $key => $item)
                                    <tr id="item_{{ $loop->index }}">
                                        <th>
                                            <input type="text" class="form-control" value="{{ $key }}" name="extra_data[{{ $loop->index }}][key]">
                                        </th>
                                        <td>
                                            <input type="text" class="form-control" value="{{ $item }}" name="extra_data[{{ $loop->index }}][value]">
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa fa-times"></i>
                                                Xóa
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr id="item_0">
                                        <th>
                                            <input type="text" class="form-control" name="extra_data[0][key]">
                                        </th>
                                        <td>
                                            <input type="text" class="form-control" name="extra_data[0][value]">
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" type="button">
                                                <i class="fa fa-times"></i>
                                                Xóa
                                            </button>
                                        </td>
                                    </tr> 
                                @endforelse
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
            <a class="btn btn-sm btn-danger" href="{{ route('admin_shipping_unit_index') }}">
                <i class="fa fa-ban"></i>
                Hủy bỏ
            </a>
        </div>
    </form>
    <template id="extra_item">
        <tr id="item_{COUNT}">
            <th>
                <input type="text" class="form-control" name="extra_data[{COUNT}][key]">
            </th>
            <td>
                <input type="text" class="form-control" name="extra_data[{COUNT}][value]">
            </td>
            <td>
                <button class="btn btn-sm btn-danger" onclick="item.remove('{COUNT}')">
                    <i class="fa fa-times"></i>
                    Xóa
                </button>
            </td>
        </tr> 
    </template>
@endsection
@push('js_bot_all')
    <script>
        const item = {
            html: $('#extra_item').html(),
            count: '{{ !empty($data) ? count($data->toSecurityJson()) : '0' }}',
            remove: function(key){
                $(`#item_${key}`).remove();
            },
            add: function(){
                this.count = +this.count + 1;
                $('tbody#items').append(this.html.replaceAll('{COUNT}', this.count))
            }
        }
    </script>
@endpush