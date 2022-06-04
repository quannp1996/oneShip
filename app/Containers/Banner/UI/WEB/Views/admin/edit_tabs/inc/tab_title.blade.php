<tr>

  <td>
    <div class="input-group p-1">
      <div class="input-group-prepend"><span class=" input-group-text"><img
            src="/admin/img/lang/{{$it_lang['image']}}" title="{{$it_lang['name']}}"></span></div>
      <input type="text" class="form-control"
             name="banner_description[{{$it_lang['language_id']}}][title_child][title_child_name][]"
             id="name_{{$it_lang['language_id']}}"
             placeholder="Nhập tiêu đề"
      >
    </div>
  </td>

  <td>
    <div class="input-group p-1">
      <div class="input-group-prepend"><span class=" input-group-text">
        <img src="/admin/img/lang/{{$it_lang['image']}}" title="{{$it_lang['name']}}"></span></div>
      <input type="text" class="form-control" placeholder="http://example.com/"
             name="banner_description[{{$it_lang['language_id']}}][title_child][title_child_link][]" id="name_{{$it_lang['language_id']}}"
      >
    </div>
  </td>

  <td class="px-2 text-center" style="width: 80px">
    <a href="javascript:void(0)" class="badge badge-danger" onclick="deleteATab(this)">
      Xóa
    </a>
  </td>
</tr>
