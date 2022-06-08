
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">

</head>
<body>


    <div class="email-template" style="  font-size: 14px;
    font-family: 'Roboto', sans-serif;    max-width: 600px;margin: auto;">

        <p style="margin: 0 ;">
            <img src="{{ asset('template/images/logo.jpg') }}" alt="">
        </p>
        <p style="margin: 0 0 10px 0 ;">
            <span class="float-left">
                Trang bán hàng trực tuyến của HAMALL
            </span>
            <a href="tel:0936628879" style="text-decoration: none;float: right ; font-size: 14px;color: #209CD8;">
                Hotline: <b style="color : #ED1B24;">{{$settings['contact']['hotline']}}</b>
            </a>
        </p>

        <div class="order-id-wrap" style="   background : url('{{ asset('template/images/bg-title-template-email.png') }}') no-repeat center center ;
        background-size: cover; 
        text-align: center;
        padding: 35px 15px;">

            
            <div class="order-id-box" style="max-width: 350px;
            margin: 0 auto;
            color: #ffffff;">
                <img src="{{ asset('template/images/letter-template.png') }}" width="56" height="43" alt="" style="float:left ; width: 56px; height: 43px;">
                <div class="order-id-content" style="display: block;
                margin-left: 70px;
                width: calc(100% - 70px);">
                    <b style="font-size: 20px;"> HỦY ĐƠN HÀNG</b>
                    <p class="text-center" style="margin: 5px 0;text-align: center;">
                        Mã đơn hàng : #{{$order->code}}
                    </p>
                </div>
            </div>


        </div>

        <div class="template-email-main" style="background : #F4F8FA; padding: 20px ;">
            <p>
                Kính chào quý khách!
            </p>

            <div class="box-cancel-order" style="    background: #fff;
            border-radius: 5px;
            padding: 1px 15px;font-weight: bold;font-size: 14px;">

                <p style="color: #747474;">
                    Chúng tôi gửi email này để thông báo đơn hàng số #{{$order->code}} của quý khách được hủy thành công.
                </p>
                <p>
                    <b style="color : #ED1B24;">
                        Lý do hủy đơn hàng:
                    </b>
                    @if(!empty($order->reason))
                        {{$order->reason}}
                   @endif
                </p>
            </div>

            <p style="margin: 5px 0 ;font-size:14px; line-height: 24px; color : #000000">
                Mọi thắc mắc và góp ý, xin Quý khách vui lòng liên hệ với chúng tôi qua:
            </p>
            <p style="margin: 5px 0 ;font-size:14px; line-height: 24px; color : #000000">
                Email hỗ trợ: {{$settings['contact']['email']}}
            </p>
            <p style="margin: 5px 0 ;font-size:14px; line-height: 24px; color : #000000">
                
                Số hotline: <b style="color: #F81001;">
                    {{$settings['contact']['hotline']}}
                </b> 
            </p>
            <p style="margin: 5px 0 ;font-size:14px; line-height: 24px; color : #000000">
                
                Hamall Trân trọng cảm ơn và rất hân hạnh được phục vụ Quý khách.
            </p>
        </div>
    </div>


</body>
</html>