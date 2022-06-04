<div class="row">
    <div class="form-group col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-hashtag"></i></span></div>
            <input type="text" name="id" class="form-control" placeholder="ID" value="{{ $search_data->id }}">
        </div>
    </div>

    <div class="form-group col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-envelope-o "></i></span></div>
            <input type="text" name="keyword" class="form-control" placeholder="Phone, Email, Tên"
                value="{{ $search_data->keyword ?? '' }}">
        </div>
    </div>

    <div class="form-group col-sm-3">
        <div class="input-group">
            {{-- <span class="input-group-addon"><i class="fa fa-calendar"></i></span> --}}
            <select class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                name="status" id="status">
                <option value="">--Chọn trạng thái--</option>
                @foreach($status as $status_key => $itm_status)
                    <option value="{{ $status_key }}" {{isset($search_data->status) && $search_data->status == $status_key ? 'selected' : '' }}>{{ $itm_status }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-calendar"></i></span></div>
            <input type="text" name="time_from" class="datepicker form-control" placeholder="Ngày tạo từ" autocomplete="off"
                value="{{ $search_data->time_from }}">
        </div>
    </div>
    <div class="form-group col-sm-3">
        <div class="input-group">
            <div class="input-group-prepend"><span class=" input-group-text"><i class="fa fa-calendar"></i></span></div>
            <input type="text" name="time_to" class="datepicker form-control" placeholder="Ngày tạo đến" autocomplete="off"
                value="{{ $search_data->time_to }}">
        </div>
    </div>

    {{-- <div class="col-4">
        <label for="">Ngày tạo</label>
        <input type="text" class="form-control dateptimeicker" name="created_at"
            value="{{ $search_data->created_at ?? '' }}">
    </div> --}}
</div>
