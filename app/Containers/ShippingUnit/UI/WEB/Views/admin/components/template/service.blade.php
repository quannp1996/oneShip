<template id="extra_item">
    <tr id="item_{COUNT}">
        <th>
            <input type="text" class="form-control" name="extra_data[{COUNT}][key]">
        </th>
        <td>
            <input type="text" class="form-control" name="extra_data[{COUNT}][value]">
        </td>
        <td>
            <div class="input-group-append">
                <label class="c-switch c-switch-label c-switch-primary"><input type="hidden" name="dev_mode" value="0">
                    <input type="checkbox" id="switchViewType" name="dev_mode" value="1" checked="checked"
                        class="c-switch-input"> <span data-checked="VND" data-unchecked="%"
                        class="c-switch-slider"></span></label>
            </div>
        </td>
        <td>
            <button class="btn btn-sm btn-danger" onclick="item.remove('{COUNT}')">
                <i class="fa fa-times"></i>
                Xóa
            </button>
        </td>
    </tr>
</template>
