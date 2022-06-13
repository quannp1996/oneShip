<div class="card card-accent-primary">
    <div class="card-header">
        <i class="fa fa-server"></i>
        Dịch vụ
        <br>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 55%;">Tên Dịch vụ</th>
                    <th >Giá trị</th>
                    <th >Đơn vị</th>
                    <th >
                        <button class="btn btn-sm btn-success" type="button" onclick="item.add()">
                            <i class="fa fa-plus"></i>
                            Thêm
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody id="items">
                @forelse (!empty($data) && @$data->services ? $data->services : [] as $key => $item)
                    <tr id="item_{{ $loop->index }}">
                        <th>
                            <input type="text" class="form-control" value=""
                                name="extra_data[{{ $loop->index }}][key]">
                        </th>
                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" aria-label="Text input with dropdown button">
                            </div>
                        </td>
                        <td>
                            <div class="input-group-append">
                                <label class="c-switch c-switch-label c-switch-primary"><input type="hidden"
                                        name="dev_mode" value="0"> <input type="checkbox" id="switchViewType"
                                        name="dev_mode" value="1" checked="checked" class="c-switch-input"> <span
                                        data-checked="VND" data-unchecked="%" class="c-switch-slider"></span></label>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="item.remove('{{ $loop->index }}')">
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
                            <div class="input-group-append">
                                <label class="c-switch c-switch-label c-switch-primary"><input type="hidden"
                                        name="dev_mode" value="0"> <input type="checkbox" id="switchViewType"
                                        name="dev_mode" value="1" checked="checked" class="c-switch-input"> <span
                                        data-checked="VND" data-unchecked="%" class="c-switch-slider"></span></label>
                            </div>
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
