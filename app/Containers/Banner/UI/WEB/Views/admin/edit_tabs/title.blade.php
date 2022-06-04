<div class="tab-pane" id="title">
  <div class="tabbable">
    <div class="tab-content p-0">
      @foreach($langs as $it_lang)
        <div class="tab-pane {{$loop->first ? 'active' : ''}}" id="lang_{{$it_lang['language_id']}}">

          <table class="table-bordered mt-3 w-100 tab-table-holder">
            <thead>
            <tr>
              <td class="py-2 pl-2"><span class="px-1 py-2">Tiêu đề phụ</span></td>
              <td class="py-2 pl-2"><span class="px-1 py-2">Link</span></td>
              <td class="py-2 text-center"  width="5%">
                                <span class="px-1 py-2">
                                <a href="javascript:void(0)" class="badge badge-success" onclick="createTabTitle(this)">Thêm mục</a>
                                </span>
              </td>
            </tr>
            </thead>
            <tbody class="tab-container data-title">
            <template class="layout-title">
              @include('banner::admin.edit_tabs.inc.tab_title', [])
            </template>
            <?php $itemTabs = json_decode(@$data['all_desc'][$it_lang['language_id']]['title_child'],true);?>
            @if(empty($itemTabs))
              @include('banner::admin.edit_tabs.inc.tab_title', [])
            @else
               @foreach($itemTabs as $item)
            <tr>

              <td>
                <div class="input-group p-1">
                  <div class="input-group-prepend"><span class=" input-group-text"><img
                        src="/admin/img/lang/{{$it_lang['image']}}" title="{{$it_lang['name']}}"></span></div>
                  <input type="text" class="form-control"
                         name="banner_description[{{$it_lang['language_id']}}][title_child][title_child_name][]"
                         id="name_{{$it_lang['language_id']}}"
                         placeholder="Nhập tiêu đề"
                         value="{{@$item['title_child_name']}}"
                  >
                </div>
              </td>

              <td>
                <div class="input-group p-1">
                  <div class="input-group-prepend"><span class=" input-group-text">
                      <img src="/admin/img/lang/{{$it_lang['image']}}" title="{{$it_lang['name']}}"></span></div>
                  <input type="text" class="form-control" placeholder="http://example.com/"
                         name="banner_description[{{$it_lang['language_id']}}][title_child][title_child_link][]"
                         id="name_{{$it_lang['language_id']}}"
                         value="{{@$item['title_child_link']}}"
                  >
                </div>
              </td>

              <td class="px-2 text-center" style="width: 80px">
                <a href="javascript:void(0)" class="badge badge-danger" onclick="deleteTabTitle(this)">
                  Xóa
                </a>
              </td>
            </tr>
            @endforeach
            @endif
            </tbody>
          </table>
        </div>
      @endforeach
    </div>
  </div>
</div>
@push('js_bot_all')
  <script>
    createTabTitle = () => {
      let html = $('.layout-title').html();
      $('.data-title').append(html);
    };
    deleteTabTitle = (thisA) => {
      $(thisA).closest('tr').remove();
    }
  </script>
@endpush


