<tr>
  <td>
    <div class="input-group p-1">
        @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
      <input type="text" class="form-control"
             name="staticpage_description[{{$it_lang['language_id']}}][title_child][title_child_name][]"
             id="name_{{$it_lang['language_id']}}"
             placeholder="Nhập tiêu đề"
             value="{{@$item['title_child_name']}}"
      >
    </div>
  </td>

  <td>
    <div class="input-group p-1">
        @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
      <input type="text" class="form-control" placeholder="http://example.com/"
             name="staticpage_description[{{$it_lang['language_id']}}][title_child][title_child_link][]" id="name_{{$it_lang['language_id']}}"
             value="{{@$item['title_child_link']}}"
      >
    </div>
  </td>

  <td class="px-2 text-center" style="width: 80px">
    <a href="javascript:void(0)" class="badge badge-danger" onclick="deleteATabTitle(this)">
      Xóa
    </a>
  </td>
</tr>
