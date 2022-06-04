<tr>
    <td>
        <div class="input-group p-1">
            @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
            <input type="file" class="form-control"
                name="staticpage_description[{{ $it_lang['language_id'] }}][item][item_image][]"
                id="name_{{ $it_lang['language_id'] }}" accept="image/png, image/gif, image/jpeg"
                value="{{ @$item['item_image'] }}">
            @if (!empty(@$item['item_image']))
                <input type="hidden" class="form-control"
                    name="staticpage_description[{{ $it_lang['language_id'] }}][item][check_item_image][]"
                    value="{{ @$item['item_image'] }}">
            @endif
            <div class="text-center"><img src="{{ asset('upload/staticpage/' . @$item['item_image']) }}" alt=""
                    style="width:35%"></div>
        </div>
    </td>

    <td>
        <div class="input-group p-1">
            @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
            <textarea 
                class="form-control"
                name="staticpage_description[{{ $it_lang['language_id'] }}][item][item_title][]"
                id="name_{{ $it_lang['language_id'] }}"
                cols="30" rows="10">
                {{ @$item['item_title'] }}
            </textarea>
        </div>
    </td>

    <td>
        <div class="input-group p-1">
            @include('basecontainer::admin.inc.ensign', ['lang' => $it_lang])
            <textarea class="form-control __editor" rows="10"
                name="staticpage_description[{{ $it_lang['language_id'] }}][item][item_description][]"
                id="name_{{ $it_lang['language_id'] }}" placeholder="Nhập mô tả"
                value="">{!! @$item['item_description'] !!}</textarea>

        </div>
    </td>

    <td class="px-2 text-center" style="width: 80px">
        <a href="javascript:void(0)" class="badge badge-danger" onclick="deleteATab(this)">
            Xóa
        </a>
    </td>
</tr>
