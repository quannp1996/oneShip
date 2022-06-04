<div class="tab-pane fade show active" id="email-config" role="tabpanel" aria-labelledby="email-config-tab">
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="mail_driver">Driver</label>
                <input type="text" class="form-control{{ $errors->has('mail_driver') ? ' is-invalid' : '' }}"
                    id="mail_driver" name="intergrated[mail_driver]"
                    value="{{ old('intergrated.mail_driver', @$data['intergrated']['mail_driver']) }}" required>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="mail_host">Host</label>
                <input type="text" class="form-control{{ $errors->has('mail_host') ? ' is-invalid' : '' }}"
                    id="mail_host" name="intergrated[mail_host]"
                    value="{{ old('intergrated.mail_host', @$data['intergrated']['mail_host']) }}" required>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="mail_port">Port</label>
                <input type="text" class="form-control{{ $errors->has('mail_port') ? ' is-invalid' : '' }}"
                    id="mail_port" name="intergrated[mail_port]"
                    value="{{ old('intergrated.mail_port', @$data['intergrated']['mail_port']) }}" required>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="mail_username">Username</label>
                <input type="text" class="form-control{{ $errors->has('mail_username') ? ' is-invalid' : '' }}"
                    id="mail_username" name="intergrated[mail_username]"
                    value="{{ old('intergrated.mail_username', @$data['intergrated']['mail_username']) }}" required>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="mail_password">Password</label>
                <input type="password" class="form-control{{ $errors->has('mail_password') ? ' is-invalid' : '' }}"
                    id="mail_password" name="intergrated[mail_password]"
                    value="{{ old('intergrated.mail_password', @$data['intergrated']['mail_password']) }}" required>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="mail_encryption">Encryption</label>
                <input type="text" class="form-control{{ $errors->has('mail_encryption') ? ' is-invalid' : '' }}"
                    id="mail_encryption" name="intergrated[mail_encryption]"
                    value="{{ old('intergrated.mail_encryption', @$data['intergrated']['mail_encryption']) }}" required>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="mail_from_address">From address</label>
                <input type="text" class="form-control{{ $errors->has('mail_from_address') ? ' is-invalid' : '' }}"
                    id="mail_from_address" name="intergrated[mail_from_address]"
                    value="{{ old('intergrated.mail_from_address', @$data['intergrated']['mail_from_address']) }}"
                    required>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="mail_from_name">From name</label>
                <input type="text" class="form-control{{ $errors->has('mail_from_name') ? ' is-invalid' : '' }}"
                    id="mail_from_name" name="intergrated[mail_from_name]"
                    value="{{ old('intergrated.mail_from_name', @$data['intergrated']['mail_from_name']) }}" required>
            </div>
        </div>
    </div>
</div>
