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
                            <input type="text" class="form-control" value="{{ $key }}"
                                name="extra_data[{{ $loop->index }}][key]">
                        </th>
                        <td>
                            <input type="text" class="form-control" value="{{ $item }}"
                                name="extra_data[{{ $loop->index }}][value]">
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
