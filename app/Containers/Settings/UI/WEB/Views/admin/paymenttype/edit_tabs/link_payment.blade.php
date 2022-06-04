<div class="tab-pane" id="linkpayment">
    <div class="tabbable">
        <div class="row form-group align-items-center">
            <label class="col-sm-2 control-label text-right mb-0" for="online_method">Liên kết thanh toán<span
                    class="d-block small text-danger">(Chọn liên kết nếu thanh toán online)</span></label>
            <div class="col-sm-3">
                <select class="form-control{{ $errors->has('online_method') ? ' is-invalid' : '' }}"
                    name="online_method" id="online_method">
                    <option value="0">-- Không liên kết --</option>
                    @foreach ($onlineMethods as $key => $method)
                        <option value="{{ $key }}" {{ @$data['online_method'] == $key ? 'selected' : '' }}>
                            {{ $method['container'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
