<div class="tab-pane" id="other" role="tabpanel" >
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="title">Phiên bản JS/CSS</label>
                <input type="text" class="form-control{{ $errors->has('version') ? ' is-invalid' : '' }}" id="version" name="other[version]" value="{{ old('other.version', @$data['other']['version']) }}" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <div class="form-group">
                <label for="script_head">Code nhúng Head</label>
                <textarea rows="9" class="form-control{{ $errors->has('script_head') ? ' is-invalid' : '' }}" id="script_head" name="other[script_head]">{{ old('other.script_head', isset($data['other']['script_head']) ? $data['other']['script_head'] : '') }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <div class="form-group">
                <label for="script_body">Code nhúng Body</label>
                <textarea rows="9" class="form-control{{ $errors->has('script_body') ? ' is-invalid' : '' }}" id="script_body" name="other[script_body]">{{ old('other.script_body', isset($data['other']['script_body']) ? $data['other']['script_body'] : '') }}</textarea>
            </div>
        </div>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-sm-9">--}}
{{--            <div class="form-group">--}}
{{--                <label for="embed_ggmap">Embeded GGMAP</label>--}}
{{--                <textarea rows="9" class="form-control{{ $errors->has('embed_ggmap') ? ' is-invalid' : '' }}" id="embed_ggmap" name="embed_ggmap">{{ old('embed_ggmap', isset($data['embed_ggmap']) ? $data['embed_ggmap'] : '') }}</textarea>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    {{--<div class="row">--}}
    {{--<div class="col-sm-9">--}}
    {{--<div class="form-group">--}}
    {{--<label for="site_chatbot">Code nhúng Chatbot</label>--}}
    {{--<textarea rows="9" class="form-control{{ $errors->has('site_chatbot') ? ' is-invalid' : '' }}" id="site_chatbot" name="site_chatbot">{{ old('site_chatbot', isset($data['site_chatbot']) ? $data['site_chatbot'] : '') }}</textarea>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
</div>