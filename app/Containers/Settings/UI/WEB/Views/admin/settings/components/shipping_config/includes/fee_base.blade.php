<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="">Phí Ship</label>
            <input type="text" name="activity[fee_base][shiping_fee]" class="form-control" value="{{ \FunctionLib::numberFormat(old('activity.fee_base.shiping_fee', @$data['activity']['fee_base']['shiping_fee'])) }}" onkeypress="return shop.numberOnly()">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="">VAT (%)</label>
            <input type="text" name="activity[fee_base][vat]" class="form-control" value="{{ old('activity.fee_base.vat', @$data['activity']['fee_base']['vat']) }}">
        </div>
    </div>
</div>