function copyLink($link = '') {
    let dummy = document.createElement('input'),
        text = $link;

    document.body.appendChild(dummy);
    dummy.value = text;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);

    Swal.fire({
        position: 'bottom-end',
        text: 'Đã copy link bài viết!',
        showConfirmButton: false,
        timer: 400
    })
}