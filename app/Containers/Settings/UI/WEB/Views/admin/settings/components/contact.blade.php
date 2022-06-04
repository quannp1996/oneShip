<div class="tab-pane" id="contact" role="tabpanel" aria-expanded="false">
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="title">Email liên hệ</label>
                <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"
                       name="contact[email]" value="{{ old('contact.email', @$data['contact']['email']) }}" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="cc_email">CC Email</label>
                <small>Mỗi email cách nhau bởi dấu phẩy</small>
                <input type="text" class="form-control{{ $errors->has('cc_email') ? ' is-invalid' : '' }}" id="cc_email" autocomplete="false"
                       name="contact[cc_email]" value="{{ old('contact.cc_email', @$data['contact']['cc_email']) }}">
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="fb_page_id">FB page ID for Messenger</label>
                <input type="text" class="form-control{{ $errors->has('fb_page_id') ? ' is-invalid' : '' }}"
                       id="fb_page_id" name="contact[fb_page_id]"
                       value="{{ old('contact.fb_page_id', @$data['contact']['fb_page_id']) }}">
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="other_website">Website</label>
                <input type="text" class="form-control{{ $errors->has('other_website') ? ' is-invalid' : '' }}"
                       id="other_website" name="contact[other_website]"
                       value="{{ old('contact.other_website', @$data['contact']['other_website']) }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="title">Hotline</label>
                <input type="text" class="form-control{{ $errors->has('hotline') ? ' is-invalid' : '' }}" id="hotline"
                       name="contact[hotline]" value="{{ old('contact.hotline', @$data['contact']['hotline']) }}">
            </div>
        </div>
    </div>
</div>