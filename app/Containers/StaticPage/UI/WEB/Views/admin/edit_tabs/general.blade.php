<div class="tab-pane active" id="general">
    <div class="tabbable">
        <ul class="nav nav-tabs nav-underline nav-underline-primary mb-3" role="tablist">
            @foreach($langs as $it_lang)
                <li class="nav-item">
                    <a class="nav-link {{$loop->first ? 'active' : ''}}" href="#lang_{{$it_lang['language_id']}}" ><i class="icon-globe"></i> {{$it_lang['name']}}</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content p-0">
            @foreach($langs as $it_lang)
                <div class="tab-pane {{$loop->first ? 'active' : ''}}" id="lang_{{$it_lang['language_id']}}" >
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title">Tên <span class="small text-danger">( {{$it_lang['name']}} )</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><img src="{{ asset('admin/img/lang/'.$it_lang['image']) }}" title="{{$it_lang['name']}}"></span></div>
                                    <input type="text" class="form-control" name="staticpage_description[{{$it_lang['language_id']}}][name]" id="name_{{$it_lang['language_id']}}" value="{{ old('staticpage_description.'.$it_lang['language_id'].'.name',@$data['all_desc'][$it_lang['language_id']]['name']) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="description_{{$it_lang['language_id']}}">Mô tả ngắn <span class="small text-danger">( {{$it_lang['name']}} )</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><img src="{{ asset('admin/img/lang/'.$it_lang['image']) }}" title="{{$it_lang['name']}}"></span></div>
                                    <textarea rows="5" class="form-control __editor" name="staticpage_description[{{$it_lang['language_id']}}][short_description]" id="description_{{$it_lang['language_id']}}" >{!! old('staticpage_description.'.$it_lang['language_id'].'.short_description',@$data['all_desc'][$it_lang['language_id']]['short_description'])  !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="description_{{$it_lang['language_id']}}">Nội dung <span class="small text-danger">( {{$it_lang['name']}} )</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class=" input-group-text"><img src="{{ asset('admin/img/lang/'.$it_lang['image']) }}" title="{{$it_lang['name']}}"></span></div>
                                    <textarea class="__editor" name="staticpage_description[{{$it_lang['language_id']}}][description]" id="description_{{$it_lang['language_id']}}">{!! old('staticpage_description.'.$it_lang['language_id'].'.description',@$data['all_desc'][$it_lang['language_id']]['description'])  !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div> --}}

{{--                    <div class="row">--}}
{{--                        <div class="col-sm-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="description_{{$it_lang['language_id']}}">Giá trị<span class="small text-danger">( {{$it_lang['name']}} )</span></label>--}}
{{--                                <div class="input-group">--}}
{{--                                    <div class="input-group-prepend"><span class=" input-group-text"><img src="{{ asset('admin/img/lang/'.$it_lang['image']) }}" title="{{$it_lang['name']}}"></span></div>--}}
{{--                                    <textarea class="__editor" name="staticpage_description[{{$it_lang['language_id']}}][content]" id="description_{{$it_lang['language_id']}}">{!! old('staticpage_description.'.$it_lang['language_id'].'.content',@$data['all_desc'][$it_lang['language_id']]['content'])  !!}</textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <hr>
                    <div class="row form-group">
                        <label class="col-sm-2 control-label text-right" for="input-meta-title_{{$it_lang['language_id']}}">Meta Tag Title</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><img src="{{ asset('admin/img/lang/'.$it_lang['image']) }}" title="{{$it_lang['name']}}"></span></div>
                                <input type="text" name="staticpage_description[{{$it_lang['language_id']}}][meta_title]" value="{{ old('staticpage_description.'.$it_lang['language_id'].'.meta_title',@$data['all_desc'][$it_lang['language_id']]['meta_title']) }}" placeholder="Meta Tag Title" id="input-meta-title_{{$it_lang['language_id']}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 control-label text-right" for="input-meta-description_{{$it_lang['language_id']}}">Meta Tag Description</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><img src="{{ asset('admin/img/lang/'.$it_lang['image']) }}" title="{{$it_lang['name']}}"></span></div>
                                <textarea rows="5" class="form-control" name="staticpage_description[{{$it_lang['language_id']}}][meta_description]" placeholder="Meta Tag Description" id="meta_description_{{$it_lang['language_id']}}" >{{ old('staticpage_description.'.$it_lang['language_id'].'.meta_description',@$data['all_desc'][$it_lang['language_id']]['meta_description']) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-2 control-label text-right" for="input-meta-keyword_{{$it_lang['language_id']}}">Meta Tag Keywords</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class=" input-group-text"><img src="{{ asset('admin/img/lang/'.$it_lang['image']) }}" title="{{$it_lang['name']}}"></span></div>
                                <input type="text" name="staticpage_description[{{$it_lang['language_id']}}][meta_keyword]" value="{{ old('staticpage_description.'.$it_lang['language_id'].'.meta_keyword',@$data['all_desc'][$it_lang['language_id']]['meta_keyword']) }}" placeholder="Meta Tag Keyword" id="input-meta-keyword_{{$it_lang['language_id']}}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>