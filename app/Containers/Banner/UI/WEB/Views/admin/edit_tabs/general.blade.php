<div class="tab-pane active" id="general">
    <div class="tabbable">
        <ul class="nav nav-tabs nav-underline nav-underline-primary mb-3" role="tablist">
            @foreach ($langs as $it_lang)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" href="#lang_{{ $it_lang['language_id'] }}"><i
                            class="icon-globe"></i> {{ $it_lang['name'] }}</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content p-0">
            @foreach ($langs as $it_lang)
                <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="lang_{{ $it_lang['language_id'] }}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title">Tên <span class="small text-danger">( {{ $it_lang['name'] }}
                                        )</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><img
                                                src="/admin/img/lang/{{ $it_lang['image'] }}"
                                                title="{{ $it_lang['name'] }}"></span></div>
                                    <input type="text" class="form-control"
                                        name="banner_description[{{ $it_lang['language_id'] }}][name]"
                                        id="name_{{ $it_lang['language_id'] }}"
                                        value="{{ old('banner_description.' . $it_lang['language_id'] . '.name', @$data['all_desc'][$it_lang['language_id']]['name']) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title">Đường dẫn <span class="small text-danger">( {{ $it_lang['name'] }}
                                        )</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><img
                                                src="/admin/img/lang/{{ $it_lang['image'] }}"
                                                title="{{ $it_lang['name'] }}"></span></div>
                                    <input type="text" class="form-control" placeholder="http://example.com/"
                                        name="banner_description[{{ $it_lang['language_id'] }}][link]"
                                        id="name_{{ $it_lang['language_id'] }}"
                                        value="{{ old('banner_description.' . $it_lang['language_id'] . '.link', @$data['all_desc'][$it_lang['language_id']]['link']) }}"
                                        pattern="(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="description_{{ $it_lang['language_id'] }}">Nội dung <span
                                        class="small text-danger">( {{ $it_lang['name'] }} )</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><img
                                                src="/admin/img/lang/{{ $it_lang['image'] }}"
                                                title="{{ $it_lang['name'] }}"></span></div>
                                    <textarea rows="5" cols="40" class="form-control __editor"
                                        name="banner_description[{{ $it_lang['language_id'] }}][short_description]"
                                        id="description_{{ $it_lang['language_id'] }}">{!! old('banner_description.' . $it_lang['language_id'] . '.short_description', @$data['all_desc'][$it_lang['language_id']]['short_description']) !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
