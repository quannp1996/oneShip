<div class="card card-accent-primary">
    <div class="card-header card-accent-info">
        {{ __('menu::menu.general_info') }}
    </div>
    <div class="card-body bg-light">
      <ul class="nav nav-tabs nav-underline nav-underline-primary">
          @foreach ($langs as $lang)
              <li class="nav-item">
                  <a  class="nav-link {{ $loop->first ? 'active' : '' }}"
                      href="#lang_{{ $lang->language_id }}"
                      data-toggle="tab"
                      role="tab"
                      aria-controls="lang_{{ $lang->language_id }}">
                      {{ $lang->name }}
                  </a>
              </li>
          @endforeach
      </ul>
      <div class="tab-content pt-2">
          @foreach ($langs as $it_lang)
              <input  type="hidden"
                      name="menu_desc[{{ $it_lang['language_id'] }}][language_id]"
                      value="{{ $it_lang['language_id'] }}">

              <div  class="tab-pane {{ $loop->first ? 'active' : '' }}"
                    id="lang_{{ $it_lang->language_id }}"
                    role="tabpanel">
                  <div class="row">
                      <div class="col-12">
                          <div class="form-group">
                              <label for="title">Tên
                                <span class="small text-danger">( {{ $it_lang['name'] }})</span>
                              </label>

                              <div class="input-group">
                                  @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])

                                  <input  type="text"
                                          class="form-control"
                                          name="menu_desc[{{ $it_lang['language_id'] }}][name]"
                                          id="name_{{ $it_lang['language_id'] }}"
                                          value="{{ old('menu_desc.' . $it_lang['language_id'] . '.name', @$data->all_desc[$it_lang['language_id']]['name']) }}"
                                  />
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-12">
                          <div class="form-group">
                              <label for="description_{{ $it_lang['language_id'] }}">Nội dung <span
                                      class="small text-danger">( {{ $it_lang['name'] }} )</span></label>
                              <div class="input-group">
                                  @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
                                  <textarea class="editor_desc form-control"
                                            name="menu_desc[{{ $it_lang['language_id'] }}][description]"
                                            id="description_{{ $it_lang['language_id'] }}">{!!  old('menu_desc.' . $it_lang['language_id'] . '.description', @$data->all_desc[$it_lang['language_id']]['description']) !!}</textarea>
                              </div>
                          </div>
                      </div>
                  </div>
                  <hr>
                  <div class="row form-group">
                      <label class="col-sm-2 control-label text-right"
                          for="input-meta-title_{{ $it_lang['language_id'] }}">Meta Tag Title</label>
                      <div class="col-sm-10">
                          <div class="input-group">
                              @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
                              <input  type="text"
                                      name="menu_desc[{{ $it_lang['language_id'] }}][meta_title]"
                                      value="{{ old('menu_desc.' . $it_lang['language_id'] . '.meta_title', @$data->all_desc[$it_lang['language_id']]['meta_title']) }}"
                                      placeholder="Meta Tag Title"
                                      id="input-meta-title_{{ $it_lang['language_id'] }}"
                                      class="form-control"
                              />
                          </div>
                      </div>
                  </div>
                  <div class="row form-group">
                      <label class="col-sm-2 control-label text-right"
                          for="input-meta-description_{{ $it_lang['language_id'] }}">Meta Tag Description</label>
                      <div class="col-sm-10">
                          <div class="input-group">
                              @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
                              <textarea rows="5"
                                        class="form-control"
                                        name="menu_desc[{{ $it_lang['language_id'] }}][meta_description]"
                                        placeholder="Meta Tag Description"
                                        id="meta_description_{{ $it_lang['language_id'] }}">{{ old('menu_desc.' . $it_lang['language_id'] . '.meta_description', @$data->all_desc[$it_lang['language_id']]['meta_description']) }}</textarea>
                          </div>
                      </div>
                  </div>
                  <div class="row form-group">
                      <label class="col-sm-2 control-label text-right"
                          for="input-meta-keyword_{{ $it_lang['language_id'] }}">Meta Tag Keywords</label>
                      <div class="col-sm-10">
                          <div class="input-group">
                            @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
                              <input type="text"
                                      name="menu_desc[{{ $it_lang['language_id'] }}][meta_keyword]"
                                      value="{{ old('menu_desc.' . $it_lang['language_id'] . '.meta_keyword', @$data->all_desc[$it_lang['language_id']]['meta_keyword']) }}"
                                      placeholder="Meta Tag Keyword"
                                      id="input-meta-keyword_{{ $it_lang['language_id'] }}"
                                      class="form-control"
                              />
                          </div>
                      </div>
                  </div>
              </div>
          @endforeach
      </div>
    </div>
</div>
