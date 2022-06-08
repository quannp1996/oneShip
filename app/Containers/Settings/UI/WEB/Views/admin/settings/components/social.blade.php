<div class="tab-pane" id="social" role="tabpanel" aria-expanded="false">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="facebook_name">Facebook APP ID</label>
                <input type="text" class="form-control{{ $errors->has('facebook_app_id') ? ' is-invalid' : '' }}"
                       id="facebook_app_id" name="social[facebook_app_id]"
                       value="{{ old('social.facebook_app_id', !empty($data['social']['facebook_app_id']) ? $data['social']['facebook_app_id'] : '') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="facebook">Facebook</label>
                <input type="text" class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}" id="facebook"
                       name="social[facebook]"
                       value="{{ old('social.facebook', !empty($data['social']['facebook']) ? $data['social']['facebook'] : '') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="messages">Messages</label>
                <input type="text" class="form-control{{ $errors->has('messages') ? ' is-invalid' : '' }}"
                       id="messages" name="social[messages]"
                       value="{{ old('social.messages', !empty($data['social']['messages']) ? $data['social']['messages'] : '') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="zalo">Zalo</label>
                <input type="text" class="form-control{{ $errors->has('zalo') ? ' is-invalid' : '' }}" id="zalo"
                       name="social[zalo]"
                       value="{{ old('social.zalo', !empty($data['social']['zalo']) ? $data['social']['zalo'] : '') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="instagram">Instagram</label>
                <input type="text" class="form-control{{ $errors->has('instagram') ? ' is-invalid' : '' }}"
                       id="instagram" name="social[instagram]"
                       value="{{ old('social.instagram', !empty($data['social']['instagram']) ? $data['social']['instagram'] : '') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="youtube">Youtube</label>
                <input type="text" class="form-control{{ $errors->has('youtube') ? ' is-invalid' : '' }}" id="youtube"
                       name="social[youtube]"
                       value="{{ old('social.youtube', !empty($data['social']['youtube']) ? $data['social']['youtube'] : '') }}">
            </div>
        </div>
    </div>
</div>