function removeDiscountCode(ele, endpoint='') {
  Swal.fire({
    title: $.i18n('confirm_title'),
    text: $.i18n('Xóa mã giảm giá này?'),
    icon: 'warning',
    showCancelButton: true,
  }).then(result => executeDeleteDiscountCode(result, endpoint))
    .then(res => hanldeDeleteResult(res, ele));
}

function executeDeleteDiscountCode(result, endpoint) {
  if (result.isConfirmed) {
    return $.post(endpoint, {
      _method: "DELETE"
    })
  }
}

function hanldeDeleteResult(res, ele) {
  if (res && res.success) {
    Swal.fire({
      title: $.i18n('success'),
      text: res.message,
      icon: 'success',
      showCloseButton: true,
    }).then( () => {
      $(ele).closest('tr').remove();
    })
  }
}

function toggleDiscountCodeStatus(endpoint, code='', status=0, ele) {
  let msg = `Ngừng hoạt động mã "${code}"?`;
  if (status != 1) {
      msg = `Đánh dấu mã "${code}" là đang hoạt động`;
  }
  Swal.fire({
    title: $.i18n('confirm_title'),
    text: msg,
    icon: 'info',
    showCancelButton: true,
  }).then(result => handleToggleDiscountCodeStatus(result, endpoint, status))
    .then(res => {
      Swal.fire({
        title: $.i18n('success'),
        text: res.message,
        icon: 'success',
        showCloseButton: true,
      }).then( () => {
        $(ele).closest('tr').replaceWith(res.data);
      })
    })
}

function handleToggleDiscountCodeStatus(result, endpoint, status) {
  if (result.isConfirmed) {
    return $.post(endpoint, {
      _method: "PUT",
      status: status
    });
  }
}
