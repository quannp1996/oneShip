<div class="tab-pane" id="data">
    <div class="tabbable">
        <div class="row form-group align-items-center">
            <label class="col-sm-2 control-label text-right mb-0" for="status">Trạng thái <span
                    class="d-block small text-danger">(Hiển thị hay không)</span></label>
            <div class="col-sm-3">
                <select class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status"
                    id="status">
                    <option value="1" {{ @$data['status'] == 1 ? 'selected' : '' }}>Ẩn</option>
                    <option value="2" {{ @$data['status'] == 2 ? 'selected' : '' }}>Hiển thị</option>
                </select>
            </div>
        </div>

        <div class="row form-group align-items-center">
            <label class="col-sm-2 control-label text-right mb-0" for="shipping_fee">Phí ship cố định <span
                class="d-block small text-danger">(Phí ship mặc định của phương thức)</span></label>
            <div class="col-sm-3">
                <input onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)" onfocus="this.select()"
                    type="text" class="form-control{{ $errors->has('shipping_fee') ? ' is-invalid' : '' }}"
                    id="shipping_fee" name="shipping_fee"
                    value="{{ \FunctionLib::numberFormat(old('shipping_fee', @$data['shipping_fee'])) }}"
                    required>
            </div>
        </div>

        <div class="row form-group align-items-center">
            <label class="col-sm-2 control-label text-right mb-0" for="min_order_free_ship">
                Giá trị đơn tối thiểu FreeShip
                <span class="d-block small text-danger">(Giá trị đơn đạt mức miễn phí ship)</span>
            </label>
            <div class="col-sm-3">
                <input onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)" onfocus="this.select()"
                    type="text" class="form-control{{ $errors->has('min_order_free_ship') ? ' is-invalid' : '' }}"
                    id="min_order_free_ship" name="min_order_free_ship"
                    value="{{ \FunctionLib::numberFormat(old('min_order_free_ship', @$data['min_order_free_ship'])) }}"
                    onkeypress="return shop.numberOnly()">
            </div>
        </div>

        <div class="row form-group align-items-center">
            <label class="col-sm-2 control-label text-right mb-0" for="sort_order">Sắp xếp <span
                    class="d-block small text-danger">(Vị trí, càng nhỏ thì càng lên đầu)</span></label>
            <div class="col-sm-3">
                <input type="text" name="sort_order" value="{{ old('sort_order', @$data['sort_order']) }}"
                    placeholder="Vị trí sắp xếp" id="sort_order" class="form-control"
                    onkeypress="return shop.numberOnly()" onfocus="this.select()">
            </div>
        </div>
    </div>
</div>

@push('js_bot_all')
    <script>
        $('#publish_at').datetimepicker({
            format: 'd/m/Y H:i',
        });
        $('#end_at').datetimepicker({
            format: 'd/m/Y H:i',
        });
        // $(".chosen-select").chosen({disable_search_threshold: 10});
    </script>
@endpush
