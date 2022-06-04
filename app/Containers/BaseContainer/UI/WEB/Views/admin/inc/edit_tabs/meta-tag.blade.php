<div class="row">
    <div class="col-12">
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="meta_title_{{$it_lang['language_id']}}">Meta Tag Title <span
                        class="small text-danger">({{$it_lang['name']}})</span></label>
            <div class="input-group">
                @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
                <input type="text"
                       class="form-control {{ $errors->has("description.{$it_lang['language_id']}.meta_title") ? 'is-invalid' : '' }}"
                       name="description[{{$it_lang['language_id']}}][meta_title]"
                       id="meta_title_{{$it_lang['language_id']}}"
                       placeholder="Meta Tag Title"
                       value="{{ old("description.{$it_lang['language_id']}.meta_title", @$data['all_desc'][$it_lang['language_id']]['meta_title']) }}">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="meta_description_{{$it_lang['language_id']}}">Meta Tag Description <span
                        class="small text-danger">({{$it_lang['name']}})</span></label>
            <div class="input-group">
                @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
                <textarea name="description[{{$it_lang['language_id']}}][meta_description]"
                          class="form-control {{ $errors->has("description.{$it_lang['language_id']}.meta_description") ? 'is-invalid' : '' }}"
                          id="meta_description_{{$it_lang['language_id']}}"
                          placeholder="Meta Tag Description" rows="4"
                >{!! old("description.{$it_lang['language_id']}.meta_description", @$data['all_desc'][$it_lang['language_id']]['meta_description']) !!}</textarea>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="meta_keyword_{{$it_lang['language_id']}}">Meta Tag Keywords <span
                        class="small text-danger">({{$it_lang['name']}})</span></label>
            <div class="input-group">
                @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
                <input type="text"
                       class="form-control {{ $errors->has("description.{$it_lang['language_id']}.meta_keyword") ? 'is-invalid' : '' }}"
                       name="description[{{$it_lang['language_id']}}][meta_keyword]"
                       id="meta_keyword_{{$it_lang['language_id']}}" placeholder="Meta Tag Keywords"
                       value="{{ old("description.{$it_lang['language_id']}.meta_keyword", @$data['all_desc'][$it_lang['language_id']]['meta_keyword']) }}">
            </div>
        </div>
    </div>
</div>