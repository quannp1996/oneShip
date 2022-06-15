<template id="serviceItem">
    <tr id="service_{COUNT}">
        <th>
            <input type="text" class="form-control" value="" name="services[{COUNT}][name]">
        </th>
        <td>
            <div class="input-group">
                <input type="number" name="services[{COUNT}][price]" class="form-control" aria-label="">
            </div>
        </td>
        <td>
            <div class="input-group-append">
                <label class="c-switch c-switch-label c-switch-primary">
                    <input type="hidden" name="services[{COUNT}][mode]" value="0">
                    <input type="checkbox" id="switchViewType" name="services[{COUNT}][mode]" value="1" checked="checked"
                        class="c-switch-input">
                    <span data-checked="VND" data-unchecked="%" class="c-switch-slider"></span>
                </label>
            </div>
        </td>
        <td>
            <button class="btn btn-sm btn-danger" onclick="service.remove('{COUNT}')">
                <i class="fa fa-times"></i>
                Xóa
            </button>
        </td>
    </tr>
</template>
