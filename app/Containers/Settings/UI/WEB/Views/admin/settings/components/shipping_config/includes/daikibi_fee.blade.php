<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="phone">Phí daibiki</label>
            <div class="table-responsive">
                <table class="table-bordered">
                    <thead>
                        <tr>
                            <th class="p-2 text-center">Giá trị đơn</th>
                            <th class="p-2 text-center">Phí (Nhỏ hơn giá trị đơn)</th>
                            <th class="p-2 text-center">Phí (Lớn hơn giá trị đơn)</th>
                            <th class="p-2 text-center"><a href="javascript:void(0)"
                                    data-count="{{ count(@$data['shippings']['daibiki'] ?? []) > 0 ? count(@$data['shippings']['daibiki']) : 1 }}"
                                    id="add_rule_daibiki">Thêm mới</a> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="rule_daibiki_copy" class="fck_rule_daibiki" style="display: none">
                            <td>
                                <div class="d-flex">
                                    <input type="text" name="daibiki_order_value[copy]"
                                        onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                        onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                </div>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <input type="text" name="daibiki_ship_fee_down[copy]"
                                        onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                        onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                </div>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <input type="text" name="daibiki_ship_fee_up[copy]"
                                        onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                        onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                </div>
                            </td>
                            <td class="p-2 text-center"><a href="javascript:void(0)" class="remove_rule_daibiki"
                                    data-id="copy">Xóa</a> </td>
                        </tr>
                        @if (!empty(@$data['shippings']['daibiki']))
                            @foreach ($data['shippings']['daibiki'] as $rule)
                                <tr class="fck_rule_daibiki" id="rule_daibiki_{{ $loop->index + 1 }}">
                                    <td>
                                        <div class="d-flex">
                                            <input type="text" name="daibiki_order_value[{{ $loop->index + 1 }}]"
                                                value="{{ \FunctionLib::numberFormat($rule['daibiki_order_value']) }}"
                                                onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                                onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <input type="text" name="daibiki_ship_fee_down[{{ $loop->index + 1 }}]"
                                                value="{{ \FunctionLib::numberFormat($rule['daibiki_ship_fee_down']) }}"
                                                onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                                onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <input type="text" name="daibiki_ship_fee_up[{{ $loop->index + 1 }}]"
                                                value="{{ \FunctionLib::numberFormat($rule['daibiki_ship_fee_up']) }}"
                                                onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                                onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                        </div>
                                    </td>
                                    <td class="p-2 text-center"><a href="javascript:void(0)" class="remove_rule_daibiki"
                                            data-id="{{ $loop->index + 1 }}">Xóa</a> </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="fck_rule_daibiki" id="rule_daibiki_1">
                                <td>
                                    <div class="d-flex">
                                        <input type="text" name="daibiki_order_value[1]"
                                            onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                            onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <input type="text" name="daibiki_ship_fee_down[1]"
                                            onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                            onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <input type="text" name="daibiki_ship_fee_up[1]"
                                            onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)"
                                            onfocus="this.select()" placeholder="" class="p-2 m-2" size="20" />
                                    </div>
                                </td>
                                <td class="p-2 text-center"><a href="javascript:void(0)" class="remove_rule_daibiki"
                                        data-id="1">Xóa</a> </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('js_bot_all')
    <script>
        $('#add_rule_daibiki').on('click', function() {
            var html = $('#rule_daibiki_copy').html();
            var count = $(this).attr('data-count');
            var next = $('.fck_rule_daibiki:last-child');
            count++;
            $(this).attr('data-count', count);
            html = html.replace(new RegExp("copy", 'g'), count);
            next.after("<tr class='fck_rule_daibiki' id='rule_daibiki_" + count + "'>" + html + "</tr>");
        });
        $(document).on('click', '.remove_rule_daibiki', function() {
            var id = $(this).data('id');
            var count = $('#add_rule_daibiki').attr('data-count');
            console.log(id, count);
            if (id == count) {

                $('#rule_daibiki_copy').attr('data-count', ($('.remove_rule_daibiki').length - 1));
            }
            if ($('.remove_rule_daibiki').length > 2) {
                $('#rule_daibiki_' + id).remove();
            }
        });

    </script>
@endpush
