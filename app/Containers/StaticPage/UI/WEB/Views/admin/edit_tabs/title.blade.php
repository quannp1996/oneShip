<div class="tab-pane" id="title">
  <div class="tabbable">

      <ul class="nav nav-tabs nav-underline nav-underline-primary mb-3" role="tablist">
          @foreach($langs as $it_lang)
              <li class="nav-item">
                  <a class="nav-link {{$loop->first ? 'active' : ''}}"
                     href="#layout_lang_title{{$it_lang['language_id']}}">
                      <img src="{{ asset('admin/img/lang/'.$it_lang['image']) }}"
                           title="{{$it_lang['name']}}"> {{$it_lang['name']}}
                  </a>
              </li>
          @endforeach
      </ul>

    <div class="tab-content p-0">
      @foreach($langs as $it_lang)
        <div class="tab-pane {{$loop->first ? 'active' : ''}}" id="layout_lang_title{{$it_lang['language_id']}}">

          <table class="table-bordered mt-3 w-100 tab-table-holder">
            <thead>
            <tr>
              <td class="py-2 pl-2"><span class="px-1 py-2">Tiêu đề phụ</span></td>
              <td class="py-2 pl-2"><span class="px-1 py-2">Link</span></td>
              <td class="py-2 text-center"  width="5%">
                                <span class="px-1 py-2">
                                <a href="javascript:void(0)" class="badge badge-success" onclick="createATabTitle(this)">Thêm mục</a>
                                </span>
              </td>
            </tr>
            </thead>
            <tbody class="tab-container data-title">
            <template class="layout-title">
              @include('staticpage::admin.edit_tabs.inc.tab_title', [])
            </template>
            <?php $itemTabsTitle = json_decode(@$data['all_desc'][$it_lang['language_id']]['title_child'],true);?>
            @if(empty($itemTabsTitle))
              @include('staticpage::admin.edit_tabs.inc.tab_title', [])
            @else
               @foreach($itemTabsTitle as $item)
                      @include('staticpage::admin.edit_tabs.inc.tab_title', ['item' => $item])
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
    <script !src="">
        createATabTitle = (thisA) => {
            let html = $(thisA).closest('.tab-table-holder').find('.tab-container').find('.layout-title').html();
            $(thisA).closest('.tab-table-holder').find('.tab-container').append(html);
        }
        deleteATabTitle = (thisA) => {
            $(thisA).closest('tr').remove();
        }
    </script>
@endpush


