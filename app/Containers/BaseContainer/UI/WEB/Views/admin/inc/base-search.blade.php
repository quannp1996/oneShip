<div class="row">
    <div class="form-group col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-bookmark-o"></i></span>
            </div>
            <input type="text" name="name" class="form-control" placeholder="Tìm theo tên" value="{{ $request->name ?? '' }}">
        </div>
    </div>
    <div class="form-group col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
            <input type="text" name="time_from" class="form-control datepicker" placeholder="Ngày tạo từ"
                   value="{{ $request->time_from ?? '' }}" autocomplete="off">
        </div>
    </div>
    <div class="form-group col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
            <input type="text" name="time_to" class="form-control datepicker" placeholder="Ngày tạo đến"
                   value="{{ $request->time_to ?? '' }}" autocomplete="off">
        </div>
    </div>
    @if(!isset($hideStatus) || $hideStatus === false)
    <div class="form-group col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-sliders"></i></span>
            </div>
            <select name="status" id="status" class="form-control" data-placeholder="Chọn trạng thái">
                <option value="">-- Chọn trạng thái --</option>
                <option value="1" {{(isset($request->status) && $request->status == 1) ? 'selected' : '' }}>Đang hiển thị</option>
                <option value="2" {{(isset($request->status) && $request->status == 2) ? 'selected' : '' }}>Đang ẩn</option>
            </select>
        </div>
    </div>
    @endif
</div>