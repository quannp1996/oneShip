<div class="card card-accent-primary">
    <div class="card-header">
        <i class="fa fa-server"></i>
        Dịch vụ
        <br>
    </div>
    <div class="card-body">
        <table class="table table-striped" id="services">
            <thead>
                <tr>
                    <th style="width: 55%;">Tên Dịch vụ</th>
                    <th >Giá trị</th>
                    <th >Đơn vị</th>
                    <th >
                        <button class="btn btn-sm btn-success" type="button" onclick="service.add()">
                            <i class="fa fa-plus"></i>
                            Thêm
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody id="items">
                @forelse (!empty($data) && @$data->services ? $data->services : [] as $key => $item)
                    <tr id="service_{{ $loop->index }}">
                        <th>
                            <input type="text" class="form-control" value="{{ $item->name }}"
                                name="services[{{ $loop->index }}][name]">
                        </th>
                        <td>
                            <div class="input-group">
                                <input type="number" value="{{ $item->price }}" class="form-control" name="services[{{ $loop->index }}][price]">
                            </div>
                        </td>
                        <td>
                            <div class="input-group-append">
                                <label class="c-switch c-switch-label c-switch-primary">
                                    <input type="hidden" name="services[{{ $loop->index }}][mode]" value="0"> 
                                    <input type="checkbox" 
                                        id="switchViewType" 
                                        name="services[{{ $loop->index }}][mode]" value="1" class="c-switch-input"
                                        {{ $item->mode == 1 ? 'checked' : '' }}
                                    > 
                                    <span data-checked="VND" data-unchecked="%" class="c-switch-slider"></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="service.remove('{{ $loop->index }}')">
                                <i class="fa fa-times"></i>
                                Xóa
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr id="service_0">
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
                                    data-checked="VND" data-unchecked="%" class="c-switch-slider"></span>
                                </label>
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
@push('js_bot_all')
    <script>
        const service = {
            html: $('#serviceItem').html(),
            count: '{{ !empty($data) ? $data->services->count() : '0' }}',
            remove: function(key) {
                $(`table#services #service_${key}`).remove();
            },
            add: function() {
                this.count = +this.count + 1;
                $('table#services tbody#items').append(this.html.replaceAll('{COUNT}', this.count))
            }
        }
    </script>
@endpush
