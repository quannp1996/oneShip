@if (1 == 2)
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="phone">Phí ship theo tỉnh thành</label>
                <div class="table-responsive">
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th class="p-2 text-center">Tỉnh</th>
                                <th class="p-2 text-center">Giá trị đơn</th>
                                <th class="p-2 text-center">Phí (Nhỏ hơn giá trị đơn)</th>
                                <th class="p-2 text-center">Phí (Lớn hơn giá trị đơn)</th>
                                <th class="p-2 text-center"><a href="javascript:void(0)"
                                        data-count="{{ count(@$data['activity']['shippings']['province'] ?? []) > 0 ? count(@$data['activity']['shippings']['province']) : 1 }}"
                                        id="add_rule">Thêm mới</a> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="rule_copy" class="fck_rule" style="display: none">
                                <td>
                                    <div class="d-flex">
                                        <select class="form-control p-2 m-2" name="activity[province_ship][copy]">
                                            <option value="0">--Chọn tỉnh--</option>
                                            @if (isset($provinces))
                                                @foreach ($provinces as $item)
                                                    <option value="{{ $item->id }}">{{ $item->Name_VI }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        {{-- <input type="text" name="province_ship[copy]" placeholder="Số lượng" class="p-2 m-2" size="10"/> --}}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <input type="text" name="activity[province_order_value][copy]"
                                            onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                            onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <input type="text" name="activity[province_ship_fee_down][copy]"
                                            onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                            onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <input type="text" name="activity[province_ship_fee_up][copy]"
                                            onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                            onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                    </div>
                                </td>
                                <td class="p-2 text-center"><a href="javascript:void(0)" class="remove_rule"
                                        data-id="copy">Xóa</a> </td>
                            </tr>
                            @if (!empty(@$data['activity']['shippings']))
                                @foreach ($data['activity']['shippings']['province'] as $rule)
                                    <tr class="fck_rule" id="rule_{{ $loop->index + 1 }}">
                                        <td>
                                            <div class="d-flex">
                                                <select class="form-control p-2 m-2"
                                                    name="activity[province_ship][{{ $loop->index + 1 }}]">
                                                    <option value="0">--Chọn tỉnh--</option>
                                                    @if (isset($provinces))
                                                        @foreach ($provinces as $item)
                                                            <option {{ $rule['id'] == $item->id ? 'selected' : '' }}
                                                                value="{{ $item->id }}">{{ $item->Name_VI }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                {{-- <input type="text" name="province_ship[{{$loop->index + 1}}]" placeholder="Số lượng" class="p-2 m-2" value="{{$rule->buy}}" size="10"/> --}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <input type="text"
                                                    name="activity[province_order_value][{{ $loop->index + 1 }}]"
                                                    value="{{ \FunctionLib::numberFormat($rule['province_order_value']) }}"
                                                    onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                                    onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <input type="text"
                                                    name="activity[province_ship_fee_down][{{ $loop->index + 1 }}]"
                                                    value="{{ \FunctionLib::numberFormat($rule['province_ship_fee_down']) }}"
                                                    onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                                    onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <input type="text"
                                                    name="activity[province_ship_fee_up][{{ $loop->index + 1 }}]"
                                                    value="{{ \FunctionLib::numberFormat($rule['province_ship_fee_up']) }}"
                                                    onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                                    onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                            </div>
                                        </td>
                                        <td class="p-2 text-center"><a href="javascript:void(0)" class="remove_rule"
                                                data-id="{{ $loop->index + 1 }}">Xóa</a> </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="fck_rule" id="rule_1">
                                    <td>
                                        <div class="d-flex">
                                            <select class="form-control p-2 m-2" name="activity[province_ship][1]">
                                                <option value="0">--Chọn tỉnh--</option>
                                                @if (isset($provinces))
                                                    @foreach ($provinces as $item)
                                                        <option value="{{ $item->id }}">{{ $item->Name_VI }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            {{-- <input type="text" name="province_ship[1]" placeholder="Số lượng" class="p-2 m-2"/> --}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <input type="text" name="activity[province_order_value][1]"
                                                onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                                onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <input type="text" name="activity[province_ship_fee_down][1]"
                                                onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                                onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <input type="text" name="activity[province_ship_fee_up][1]"
                                                onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                                onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                        </div>
                                    </td>
                                    <td class="p-2 text-center"><a href="javascript:void(0)" class="remove_rule"
                                            data-id="1">Xóa</a> </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
{{-- <div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="shipping_fee">Phí ship cố định</label>
            <input onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)" onfocus="this.select()"
                type="text" class="form-control{{ $errors->has('shipping_fee') ? ' is-invalid' : '' }}"
                id="shipping_fee" name="activity[shipping_fee]"
                value="{{ \FunctionLib::numberFormat(old('activity.shipping_fee', @$data['activity']['shipping_fee'])) }}"
                required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="min_order_free_ship">Giá trị đơn tối thiểu FreeShip</label>
            <input onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)" onfocus="this.select()"
                type="text" class="form-control{{ $errors->has('min_order_free_ship') ? ' is-invalid' : '' }}"
                id="min_order_free_ship" name="activity[min_order_free_ship]"
                value="{{ \FunctionLib::numberFormat(old('activity.min_order_free_ship', @$data['activity']['min_order_free_ship'])) }}"
                onkeypress="return shop.numberOnly()">
        </div>
    </div>
</div> --}}
@push('js_bot_all')
    <script>
        $('#add_rule').on('click', function() {
            var html = $('#rule_copy').html();
            var count = $(this).attr('data-count');
            var next = $('.fck_rule:last-child');
            count++;
            $(this).attr('data-count', count);
            html = html.replace(new RegExp("copy", 'g'), count);
            next.after("<tr class='fck_rule' id='rule_" + count + "'>" + html + "</tr>");
        });
        $(document).on('click', '.remove_rule', function() {
            var id = $(this).data('id');
            var count = $('#add_rule').attr('data-count');
            console.log(id, count);
            if (id == count) {

                $('#rule_copy').attr('data-count', ($('.remove_rule').length - 1));
            }
            if ($('.remove_rule').length > 2) {
                $('#rule_' + id).remove();
            }
        });

    </script>
@endpush
