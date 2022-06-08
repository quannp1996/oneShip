<div class="tab-pane" id="security" role="tabpanel" aria-expanded="false">
    <div class="row">
        <div class="col-sm-9">
            <div class="form-group">
                <label for="weakpass">Blacklist mật khẩu (cách nhau dấu ";")</label>
                <textarea rows="10" class="form-control{{ $errors->has('weakpass') ? ' is-invalid' : '' }}" id="weakpass" name="weakpass">{{ old('weakpass', !empty($data['weakpass']) ? $data['weakpass'] : '') }}</textarea>
            </div>
        </div>
    </div>
</div>