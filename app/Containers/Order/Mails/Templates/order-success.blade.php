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
                    <b style="font-size: 20px;"> XÁC NHẬN ĐƠN HÀNG</b>
                    <p class="text-center" style="margin: 5px 0;text-align: center;">
                        Mã đơn hàng : #{{$order->code}}
                    </p>
                </div>
            </div>


        </div>

        <div class="template-email-main" style="background : #F4F8FA; padding: 20px ;color: #000;">
            <p>
                Kính chào quý khách {{ ucwords($order->fullname) }}
            </p>
            <p>
                Chân thành cảm ơn quý khách đã mua sắm tại Hamall
            </p>
            <p>
                Chúng tôi hy vọng quý khách hài lòng với trải nghiệm mua sắm và các sản phẩm đã chọn.
            </p>
            <p>
                Đơn hàng của quý khách hiện đã được tiếp nhận.
            </p>

            <div class="order-detail" style="    margin-top: 20px;
            background: #fff;
            border-radius: 5px;">
                <div class="title" style="padding: 15px;
                font-size: 16px;
                line-height: 21px;
                vertical-align: middle;
                color: #00B9FF;
                font-weight: 600;">
                    <img src="{{ asset('template/images/order-detail-img.jpg') }}" alt="" style="    margin-right: 10px;
                    position: relative;
                    top: 2px;">
                    Chi tiết đơn hàng
                </div>

                <div style="    display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar;">
                    <table style="        border-collapse: collapse;
                    width: calc(100% - 16px);
                    color: rgb(51,51,51);
                    margin: 0 8px; font-size: 13px; line-height: 16px;">
                       
                        <tbody>
                            <tr style="background: #EFEFEF;;font-weight:bold ; border-radius: 4px;">
                                <td style="padding: 9px; text-align: left; font-size: 14px;">
                                    Sản phẩm
                                </td>
                                <td style="padding: 9px; text-align: center;    min-width: 80px; font-size: 14px;">
                                    Số lượng
                                </td>
                                <td style="padding: 9px; text-align: center;    min-width: 80px; font-size: 14px;">
                                    Đơn giá
                                </td>
                                <td style="padding: 9px; text-align: right;    min-width: 80px; font-size: 14px;">
                                    Thành tiền
                                </td>
                            </tr>
                            @if ($order->orderItems->isNotEmpty())
                            @foreach ($order->orderItems as $orderItem)
                            <tr>
                                <td style="padding:  9px; text-align: left;">
                                    <img src="{{ \ImageURL::getImageUrl(@$orderItem->product->image,'product','small')}}" alt="" class="order-detail-img" style="    float: left;
                                    width: 73px;
                                    height: 73px;">
                                    <div class="order-detail-info" style="    display: block;
                                    width: 120px;
                                    margin-left: 10px;
                                    float: left;
                                    font-size: 13px;
                                    line-height: 16px;
                                    color: #444444;">
                                        <a href="" class="name" style="    text-decoration: none;padding-left: 0px;
                                        color: #444444;">
                                          {{ $orderItem->name }}
                                        </a>
                                        @php($opts = json_decode($orderItem->opts))
                                        @if ($opts)
                                        @foreach ($opts as $opt)
                                        <span class="desc" style="display: block ; ">
                                            {{ $opt->option_name . ': ' . $opt->option_value }}
                                        </span>

                                        @endforeach
                                        @endif
                                    </div>
                                </td>
                                <td style="padding:  9px; text-align: center;">
                                {{ $orderItem->quantity }}
                                </td>
                                <td style="padding:  9px; text-align: center;">
                                {{ $orderItem->price_currency }}
                                </td>
                                <td style="padding:  9px; text-align: right;">
                                {{ $orderItem->total_price_product_currency }}
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                    </table>
                </div>
              
                
                
                <div class="order-detail-summary" style="    background: #FFFFFF;padding:10px;margin-top: 10px;">

                    <hr> </hr>
                    <div class="summary-item" style="padding: 10px; margin-bottom: 2px; background: #EBEBEB;margin-top: 20px;  ">
                        <span class="name">
                            Tổng giá trị sản phẩm : 
                        </span>
                        <b style="float: right;">
                        {{ \FunctionLib::priceFormat($order->total_price)}}
                        </b>
                    </div>
                    <div class="summary-item" style="    padding: 10px;
                    margin-bottom: 2px;background: #EBEBEB;">
                        <span class="name">
                            Giảm giá :
                        </span>
                        <b style="float: right;">
                        - {{ \FunctionLib::priceFormat($order->coupon_value) }}
                        </b>
                    </div>
                    @if($order->point_value>0)
                    <div class="summary-item" style="padding: 10px;
                    margin-bottom: 2px;background: #EBEBEB;">
                        <span class="name">
                            Điểm {{$order->point_value}} :
                        </span>
                        <b style="float: right;"> 
                        - {{ \FunctionLib::priceFormat($order->point_value *$order->point_rate) }}
                        </b>
                    </div>
                    @endif
                    <div class="summary-item" style="padding: 10px;
                    margin-bottom: 2px;background: #EBEBEB;">
                        <span class="name">
                            Phí vận chuyển :
                        </span>
                        <b style="float: right;"> 
                        {{ $order->fee_ship_currency }}
                        </b>
                    </div>
                   
                    <div class="summary-item final" style="padding: 10px;
                    margin-bottom: 2px;">
                        <div class="name" style="color: #000000;font-weight: 500;text-transform: uppercase;display: inline-block;">
                            Tổng đơn hàng<br>
                            <span style="font-size: 12px;color: #7E7E7E;text-transform: initial;"> ( Đã bao gồm VAT )</span>
                        </div>
                        <b style="    font-weight: 500;
                        font-size: 22px;
                        line-height: 26px;
                        color: #F81001;float: right;">
                           {{ \FunctionLib::priceFormat($order->total_price+$order->fee_shipping - ($order->point_value * $order->point_rate) ) }}
                        </b>
                    </div>
                </div>
            </div>


            <div class="order-info" style="background-color: #fff;
            padding: 15px;
            margin-top: 20px;">

                <p class="title" style="        margin: 10px 0;
                display: inline-block;
                width: 100%; font-weight: 600;
                font-size: 16px;
                color: #00B9FF;">
                     THÔNG TIN ĐƠN HÀNG
                </p>

                <p style="    margin: 10px 0;
    display: inline-block;
    width: 100%;">
                    <span style="float: left ; font-weight: 600;width: 50%;">
                        Mã đơn hàng của quý khách:
                    </span>
                    <span style="float:left;width: 50%;color: #747474;">
                    #{{$order->code}}
                    </span>
                </p>
                <p style="    margin: 10px 0;
    display: inline-block;
    width: 100%;">
                    <span style="float: left ; font-weight: 600;width: 50%;">
                        Thời gian đặt hàng:
                    </span>
                    <span style="float:left;width: 50%;color: #747474;">
                    {{ $order->created_at }}
                    </span>
                </p>
                <p style="    margin: 10px 0;
    display: inline-block;
    width: 100%;">
                    <span style="float: left ; font-weight: 600;width: 50%;">
                        Phương thức thanh toán:
                    </span>
                    <span style="float:left;width: 50%;color: #747474;">
                    {{ $order->getPaymentText() }}

                    </span>
                </p>
                <p style="    margin: 10px 0;
    display: inline-block;
    width: 100%;">
                    <span style="float: left ; font-weight: 600;width: 50%;">
                        Tình trạng thanh toán:
                    </span>
                    <span style="float:left;width: 50%;color: #747474;">
                    {{ $order->getPaymentStatusText() }}
                    </span>
                </p>
                <p style="    margin: 10px 0;
                display: inline-block;
                width: 100%;">
                    <span style="float: left ; font-weight: 600;width: 50%;">
                    Phương thức giao hàng:
                    </span>
                    <span style="float:left;width: 50%;color: #747474;">
                        Giao hàng tận nơi
                    </span>
                </p>

                <hr> </hr>

                <p class="title" style="        margin: 10px 0;
                display: inline-block;
                width: 100%; font-weight: 600;
                font-size: 16px;
                color: #00B9FF;">
                   ĐỊA CHỈ NHẬN HÀNG
                </p>

                <p style="    margin: 10px 0;
                display: inline-block;
                width: 100%;">
                    <span style="float: left ; font-weight: 600;width: 50%;">
                        Tên người nhận:
                    </span>
                    <span style="float:left;width: 50%;color: #747474;"> 
                    {{ ucwords($order->fullname) }}
                    </span>
                </p>
                <p style="    margin: 10px 0;
                display: inline-block;
                width: 100%;">
                    <span style="float: left ; font-weight: 600;width: 50%;">
                        Địa chỉ người nhận:
                    </span>
                    <span style="float:left;width: 50%;color: #747474;">
                    {{ $order->stringAddress() }}
                    </span>
                </p>
                <p style="    margin: 10px 0;
                display: inline-block;
                width: 100%;">
                    <span style="float: left ; font-weight: 600;width: 50%;">
                        Số điện thoại liên hệ :
                    </span>
                    <span style="float:left;width: 50%;color: #747474;">
                    @if (!empty($order->phone))
                        {{ $order->phone }}
                        @else
                        Đang cập nhật
                        @endif
                    </span>
                </p>
            </div>

            <div class="order-info" style="    background-color: #fff;
            padding: 15px;
            margin-top: 20px;margin-bottom: 10px;">

                <p class="title" style="        margin: 10px 0;
                display: inline-block;
                width: 100%; font-weight: 600;
                font-size: 16px;
                color: #00B9FF;">
                    THỜI GIAN GIAO HÀNG DỰ KIẾN
                </p>
                <p style="margin: 5px 0 ; 
                display: inline-block;
                width: 100%;">
                    Lưu ý :
                </p>
                <p style="margin: 5px 0 ; 
                display: inline-block;
                width: 100%;color: #747474;line-height: 24px;"> 
                    - Thời gian giao hàng trên được tính kể từ ngày đơn vị vận chuyển bắt đầu phát hàng đi, chưa bao gồm thời gian xử lý đơn hàng và không giao hàng vào ngày Chủ nhật và ngày Lễ.
                </p>
                <p style="margin: 5px 0 ; 
                display: inline-block;
                width: 100%;color: #747474;line-height: 24px;">
                    
- Trong thời gian đơn hàng được phát đi, quý khách có nhu cầu thay đổi thông tin địa chỉ nhận hàng, nếu trái tuyến đường đang vận chuyển trước đó sẽ phải thanh toán thêm phí vận chuyển phát sinh.
                </p>
            </div>

            <p style="margin: 0px 0px 5px ;font-size:14px; line-height: 20px; color : #000000;
            display: inline-block;
            width: 100%;">
                Mọi thắc mắc và góp ý, xin Quý khách vui lòng liên hệ với chúng tôi qua:
            </p>
            <p style="margin: 0px 0px 5px ;font-size:14px; line-height: 20px; color : #000000;
            display: inline-block;
            width: 100%;">
                Email hỗ trợ: {{$settings['contact']['email']}}
            </p>
            <p style="margin: 0px 0px 5px ;font-size:14px; line-height: 20px; color : #000000;
            display: inline-block;
            width: 100%;">
                
                Số hotline: <b style="color: #F81001;">
                    {{$settings['contact']['hotline']}}
                </b> 
            </p>
            <p style="margin: 0px 0px 5px ;font-size:14px; line-height: 20px; color : #000000;
            display: inline-block;
            width: 100%;">
                
                Hamall Trân trọng cảm ơn và rất hân hạnh được phục vụ Quý khách.
            </p>
        </div>
    </div>


</body>
</html>