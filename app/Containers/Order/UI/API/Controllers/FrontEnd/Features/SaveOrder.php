<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-21 12:34:39
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-12-09 14:15:03
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\UI\API\Controllers\FrontEnd\Features;

use App\Containers\Customer\Actions\CusGetAddressBookByIdAction;
use App\Containers\Customer\Models\Customer;
use App\Containers\Order\Actions\CreateOrderAction;
use App\Containers\Order\UI\API\Requests\FrontEnd\SaveOrderRequest;
use App\Containers\Payment\Gateway\PaymentsGateway;
use App\Containers\ShoppingCart\Actions\FrontEnd\GetContentCartAction;
use App\Containers\ShoppingCart\Actions\FrontEnd\RemoveAllSelectedCartItemAction;
use App\Containers\Bizfly\Actions\Loyalty\FindCustomerLoyaltyAction;
use App\Containers\ShoppingCart\Actions\FrontEnd\StoreCartAction;
use App\Containers\Order\Events\FrontEnd\Events\OrderSuccessEvent;
use App\Containers\Bizfly\Events\SubPointEvent;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use App\Containers\Customer\Actions\FrontEnd\FindCustomerRefByCustomerAction;
use App\Containers\Customer\Actions\FrontEnd\SaveCustomerRefRevenueAction;
use App\Containers\Customer\Models\CustomerRefRevenue;

trait SaveOrder
{
  public function saveOrder(SaveOrderRequest $request)
  {
    $cart = app(GetContentCartAction::class)->currentLang($this->currentLang)->instance()->onlySelected()->run();
    $eshopCusInfo=app(FindCustomerLoyaltyAction::class)->run($this->user);
    if (!isset($cart['count_selected']) || $cart['count_selected'] <= 0) {
      return $this->sendError('', Response::HTTP_NOT_ACCEPTABLE, __('site.hientaikhongcosanphamnaotronggio'));
    }

    if(!isset($this->user->phone) || empty($this->user->phone)) {
      return $this->sendError('', Response::HTTP_NOT_ACCEPTABLE, __('site.vuilongcapnhatsodienthoaitaikhoan'));
    }

    if(isset($eshopCusInfo->response['data']['membership_point']) && !empty($request->points) && $request->points > $eshopCusInfo->response['data']['membership_point']){
      return $this->sendError('', Response::HTTP_NOT_ACCEPTABLE, __('site.koduocsudungquasodiemhienco'));
    }
    // dd($cart);
    $pointsToRate = isset($eshopCusInfo->response['data']['rank_info']) ? $eshopCusInfo->response['data']['rank_info']['point_value']/$eshopCusInfo->response['data']['rank_info']['point_rate'] : 0;
    $priceSpecial = $this->calcReFundingAndPriceDiscountSpecial($cart);
    // dd($priceSpecial);
    $data = array_merge(
      [
        'customer_id' => $this->user->id,
        'payment_type' => $request->payment_method,
        'payment_name' => $request->payment_method_extra,
        'delivery_type' => $request->delivery_method,
        'point_value' => isset($eshopCusInfo->response['data']['membership_point']) && isset($request->points) && !empty($request->points) ? $request->points : 0,
        'point_rate' =>isset($eshopCusInfo->response['data']['membership_point']) ? $pointsToRate :0,
        'note' => $request->order_note,
        'coupon_code' => isset($cart['coupon']['coupons'][0]) ? $cart['coupon']['coupons'][0]['code'] : '',
        'coupon_value' => isset($cart['coupon']['value']) ? $cart['coupon']['value'] : 0,
        'total_price' => $cart['total'],
        'total_gross' =>  $cart['sub_total'] + $priceSpecial['priceDiscount'] + @$cart['delivery']['value'] + @$cart['coupon']['value'],
        'refund_value' => $priceSpecial['refundPrice'],
        'total_discount_value' => $priceSpecial['priceDiscount'] + @$request->points*$pointsToRate + @$cart['coupon']['value'],
        'fee_shipping' => isset($cart['delivery']['value']) ? $cart['delivery']['value'] : 0,
      ],
      $this->convertAddress($this->user, $request->address_id),
    );
    $order = app(CreateOrderAction::class)->setData($data,$this->user)->setItems($cart['items'])->run();
    if ($order->isNewOrder()) {
      OrderSuccessEvent::dispatch($order->id);
      SubPointEvent::dispatch($this->user, $order, $request->points);
      //lưu log giới thiệu
      $this->saveCustomerRefRevenue($order->id);
    }

    /**
     * Xóa toàn bộ sản phẩm vừa mua khỏi giỏ hàng
     */
    $cart = app(RemoveAllSelectedCartItemAction::class)->currentLang($this->currentLang)->instance()->run();
    app(StoreCartAction::class)->currentLang($this->currentLang)->instance()->setIdentify($this->user->id)->run();

    /**
     * Check đơn thanh toán online => redirect qua cổng thanh toán
     */
    $transaction = App::make(PaymentsGateway::class)->charge($order);
    if ($transaction && $transaction->id) {
      return $this->sendResponse([
        'url' => $transaction->data
      ]);
    }

    return $this->sendResponse([
      'cart' => $cart,
      'token' => $order->token_tracking,
      'url' => route('web_checkout_complete', ['token' => $order->token_tracking])
    ]);
  }

  public function convertAddress(Customer $customer, int $addressId)
  {
    $address = app(CusGetAddressBookByIdAction::class)->run($customer->id, $addressId);

    return [
      'fullname' => $address->name,
      'phone' => $address->phone,
      'email' => $customer->email,
      'province_id' => $address->province_id,
      'district_id' => $address->district_id,
      'ward_id' => $address->ward_id,
      'address' => $address->address,
      'address_id' => $address->id,
      'eshop_shipping_id' => $address->eshop_shipping_id
    ];
  }

  public function calcReFundingAndPriceDiscountSpecial($cart)
  {
    $refundPrice = 0;
    $priceDiscount = 0;
    // dd($cart);
    foreach ($cart['items'] as $items){
      if(isset($items['specialOffers'])){
        foreach ($items['specialOffers'] as $subItems){
          if(isset($subItems['type']) && $subItems['type']=='refund'){
            $refundPrice +=  $subItems['value'];
          }
          // if(isset($subItems['type']) && $subItems['type']=='price'){
          //   $priceDiscount +=  $subItems['value']*$items['quantity'];
          // }
        }
      }
      $priceDiscount += ($items['priceOrigin'] - $items['price'])*$items['quantity'];
    }
    return ['refundPrice' => $refundPrice,'priceDiscount' => $priceDiscount];
  }

  public function saveCustomerRefRevenue($order_id)
  {
    $limitDate=0;
    $limitOrder=0;
    $customerRef=app(FindCustomerRefByCustomerAction::class)->run($this->user->id,$limitDate);
    if(!empty($customerRef)){
      $dataCusRef['customer_ref_id']=$customerRef->id;
      $dataCusRef['order_id']=$order_id;
      $dataCusRef['customer_id']=$customerRef->customerReferral->id;
      // nếu thêm điều kiện giới hạn số lượng đơn thì mở comment
      // $numberOrder=app(CustomerRefRevenue::class)->countOrderByRefId($customerRef->id);
      // if( $numberOrder<$limitOrder){
      //   app(SaveCustomerRefRevenueAction::class)->run($dataCusRef);
      // }
       app(SaveCustomerRefRevenueAction::class)->run($dataCusRef);
    }
    return $customerRef;
  }
}
