<article class="tab-pane" id="kiot-viet">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="kiot_api_key">API KEY KIOT VIET</label>
                        <input type="text"
                            class="form-control{{ $errors->has('version') ? ' is-invalid' : '' }}"
                            id="kiot_api_key" name="kiot_api_key"
                            value="{{ old('kiot_api_key', @$data['kiot_api_key']) }}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="kiot_api_secret_key">API KEY SECRET KIOT VIET</label>
                        <input type="text"
                            class="form-control{{ $errors->has('version') ? ' is-invalid' : '' }}"
                            id="kiot_api_secret_key" name="kiot_api_secret_key"
                            value="{{ old('kiot_api_secret_key', @$data['kiot_api_secret_key']) }}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="kiot_api_retailer_key">API RETAILER KIOT VIET</label>
                        <input type="text"
                            class="form-control{{ $errors->has('kiot_api_retailer_key') ? ' is-invalid' : '' }}"
                            id="kiot_api_retailer_key" name="kiot_api_retailer_key"
                            value="{{ old('kiot_api_retailer_key', @$data['kiot_api_retailer_key']) }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="kiot_api_cashier_id">ID NGƯỜI BÁN HÀNG</label>
                        <input type="text"
                            class="form-control{{ $errors->has('kiot_api_cashier_id') ? ' is-invalid' : '' }}"
                            id="kiot_api_cashier_id" name="kiot_api_cashier_id"
                            value="{{ old('kiot_api_cashier_id', @$data['kiot_api_cashier_id']) }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="install_webhook">Setup Webhook</label>
                        <a href="javascript:void(0)" onclick="shop.admin.install_kiotwebhook()"
                            class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Cài đặt
                            Webhook</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</article>