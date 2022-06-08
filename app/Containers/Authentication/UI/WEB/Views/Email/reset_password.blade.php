<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="css/stylesheet.css">

</head>

<body>
    <div>
        <div class="main-wrap" style="
        font-family: 'Google Sans';
        font-weight: normal;
        font-size: 14px;
        color: #333;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        padding-bottom: 100px;">
            <p style="font-style: normal;font-weight: normal;font-size: 20px;line-height: 30px; color: #000000;">Chúng
                tôi nhận được yêu cầu thiết lập lại mật khẩu cho tài khoản của bạn.</p>
            <p style="font-style: normal;font-weight: normal;font-size: 20px;line-height: 30px; color: #000000;">
                Nhấn <a href="{{ $link }}">
                    tại đây
                </a> để thiết lập mật khẩu mới cho tài khoản của bạn.
            </p>
            <span class="note" style="
                font-weight: normal;
                font-size: 14px;
                line-height: 25px;">
                <span style="color: #C42128;">*</span> Lưu ý: Đường dẫn thay đổi mật khẩu có hiệu lực trong thời gian
                {{ round(config('authentication-container.token_reset.time') / 60) }} phút. Vui lòng không chia sẻ Email
                này cho người khác.
            </span>
        </div>
    </div>
</body>

</html>
