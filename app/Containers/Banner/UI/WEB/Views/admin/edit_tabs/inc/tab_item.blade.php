<tr class="tab-item-tr">
 {{--     <td>
        <div class="input-group p-1">
            @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
          <input type="text" class="form-control"
                 name="banner_description[{{$it_lang['language_id']}}][item][item_icon][]"
                 id="name_{{$it_lang['language_id']}}"
                 placeholder="Nhập icon"
                 value="{{@$item->item_icon}}"
          >
        </div>
      </td>--}}

      <td>
        <div class="input-group p-1">
            @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
          <input type="text" class="form-control"
                 name="banner_description[{{$it_lang['language_id']}}][item][item_title][]"
                 id="name_{{$it_lang['language_id']}}"
                 placeholder="Nhập tiêu đề"
                 value="{{@$item['item_title']}}"
          >
        </div>
      </td>

      <td>
        <div class="input-group p-1">
            @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
          <input type="text" class="form-control" placeholder="http://example.com/"
                 name="banner_description[{{$it_lang['language_id']}}][item][item_link][]" id="name_{{$it_lang['language_id']}}"
                 value="{{@$item['item_link']}}"
          >
        </div>
      </td>

      <td>
        <div class="input-group p-1">
            @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
          <input type="text" class="form-control"
                 name="banner_description[{{$it_lang['language_id']}}][item][item_description][]"
                 id="name_{{$it_lang['language_id']}}"
                 placeholder="Nhập mô tả"
                 value="{{@$item['item_description']}}"
          >
        </div>
      </td>

      <td class="px-2 text-center" style="width: 80px">
        <a href="javascript:void(0)" class="badge badge-danger" onclick="deleteATab(this)">
          Xóa
        </a>
      </td>
</tr>
