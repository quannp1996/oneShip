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
            <input type="text" name="title" value="{{ @$data->title }}" class="form-control" id="title"
                placeholder="Tiêu đề">
        </div>
        <div class="form-group">
            <label for="type">Đối tác vận chuyển</label>
            <select name="type" class="form-control" id="type">
                @foreach ($list_type as $key => $item)
                    <option value="{{ $key }}" {{ @$data->type == $key ? 'selected' : '' }}>
                        {{ $item }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="time">Thời gian giao hàng</label>
            <input type="text" name="time" value="{{ @$data->time }}" class="form-control" id="time"
                placeholder="Tiêu đề">
        </div>
        <div class="form-group">
            <label for="image">Ảnh</label>
            <input type="file" name="image" id="image" class="form-control">
            @if (@$data->image)
                <img class="mt-3" width="150px" src="{{ $data->getImageUrl() }}" alt="">
            @endif
        </div>
    </div>
</div>
