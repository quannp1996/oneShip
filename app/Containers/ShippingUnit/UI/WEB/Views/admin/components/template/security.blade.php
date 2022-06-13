<template id="extra_item">
    <tr id="item_{COUNT}">
        <th>
            <input type="text" class="form-control" name="extra_data[{COUNT}][key]">
        </th>
        <td>
            <input type="text" class="form-control" name="extra_data[{COUNT}][value]">
        </td>
        <td>
            <button class="btn btn-sm btn-danger" onclick="item.remove('{COUNT}')">
                <i class="fa fa-times"></i>
                Xóa
            </button>
        </td>
    </tr> 
</template>