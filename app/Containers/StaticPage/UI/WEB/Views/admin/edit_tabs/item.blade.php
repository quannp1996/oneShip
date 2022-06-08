<div class="tab-pane" id="item">
    <div class="tabbable">
        <div class="float-right">
            <label class="c-switch c-switch-label c-switch-primary m-0 align-middle">
                <input type="hidden" name="view_type" value="0">
                <input type="checkbox" id="switchViewType" name="view_type" value="1" class="c-switch-input"
                    {{ $data['view_type'] == 1 ? 'checked' : '' }}>
                <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
            </label>
        </div>
        <br>
        <ul class="nav nav-tabs nav-underline nav-underline-primary mb-3" role="tablist">
            @foreach ($langs as $it_lang)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                        href="#layout_lang_{{ $it_lang['language_id'] }}">
                        <img src="{{ asset('admin/img/lang/' . $it_lang['image']) }}"
                            title="{{ $it_lang['name'] }}">
                        {{ $it_lang['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content p-0">
            @foreach ($langs as $it_lang)
                <div id="view_item" style="display: {{ $data['view_type'] == 0 ? 'block' : 'none' }}">
                    <div class="tab-pane {{ $loop->first ? 'active' : '' }}"
                        id="layout_lang_{{ $it_lang['language_id'] }}">
                        <table class="table-bordered mt-3 w-100 tab-table-holder">
                            <thead>
                                <tr>
                                    <td class="py-2 pl-2" width="15%"><span class="px-1 py-2">Hình ảnh</span>
                                    </td>
                                    <td class="py-2 pl-2"><span class="px-1 py-2">YouTube IFrame</span></td>
                                    <td class="py-2 pl-2" width="40%"><span class="px-1 py-2">Mô tả</span>
                                    </td>
                                    <td class="py-2 text-center" width="5%">
                                        <span class="px-1 py-2">
                                            <a href="javascript:void(0)" class="badge badge-success"
                                                onclick="createATab(this)">Thêm mục</a>
                                        </span>
                                    </td>
                                </tr>
                            </thead>
                            <tbody class="tab-container data-item">
                                <template class="layout-item">
                                    @include('staticpage::admin.edit_tabs.inc.tab_item', ['item' => null])
                                </template>
                                <?php $itemTabs = json_decode(@$data['all_desc'][$it_lang['language_id']]['item'], true); ?>
                                @if (empty($itemTabs))
                                    @include('staticpage::admin.edit_tabs.inc.tab_item', [])
                                @else
                                    @foreach ($itemTabs as $item)
                                        @include('staticpage::admin.edit_tabs.inc.tab_item', ['item' => $item])
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="view_page" style="display: {{ $data['view_type'] == 1 ? 'block' : 'none' }}">
                  <textarea name="staticpage_content" id="cms-edit" rows="500" class="cms-edit">
                    {!! $data['staticpage_content'] !!}
                  </textarea>
                </div>
            @endforeach
        </div>
    </div>
</div>
@push('js_bot_all')
    <script !src="">
        createATab = (thisA) => {
            let html = $(thisA).closest('.tab-table-holder').find('.tab-container').find('.layout-item').html();
            $(thisA).closest('.tab-table-holder').find('.tab-container').append(html);
            tinymce.remove('textarea');
            admin.system.tinyMCE('.__editor', plugins = '', menubar = '', toolbar = '', height = 500, '95%');
        }
        deleteATab = (thisA) => {
            $(thisA).closest('tr').remove();
        }
        $('#switchViewType').click(function() {
            $('#view_item').toggle();
            $('#view_page').toggle();
        })
    </script>
@endpush
