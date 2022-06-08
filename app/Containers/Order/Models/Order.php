<?php

namespace App\Containers\Order\Models;

use App\Containers\Bizfly\Models\OrderLoyalty;
use App\Containers\EShopBizfly\Enum\EShopEnum;
use App\Ship\Parents\Models\Model;
use App\Containers\User\Models\User;
use App\Containers\Order\Enums\OrderStatus;
use App\Containers\Order\Traits\PriceTrait;
use App\Containers\Order\Traits\PaymentTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Containers\Settings\Models\PaymentType;
use App\Containers\Order\Traits\OrderScopeTrait;
use App\Containers\Settings\Enums\PaymentStatus;
use App\Containers\Settings\Models\DeliveryType;
use App\Containers\Order\Traits\OrderStatusTrait;
use App\Ship\core\Traits\HelpersTraits\DateTrait;
use App\Containers\Order\Traits\OrderPaymentTrait;
use App\Containers\Order\Traits\OrderCustomerTrait;
use App\Containers\Order\Traits\OrderDeliveryTrait;
use App\Containers\Order\Traits\OrderLocationTrait;
use App\Containers\Customer\Models\CustomerRefRevenue;

class Order extends Model
{
    use SoftDeletes,
        PriceTrait,
        OrderPaymentTrait,
        OrderDeliveryTrait,
        OrderStatusTrait,
        OrderScopeTrait,
        OrderLocationTrait,
        OrderCustomerTrait;

    protected $table = 'orders';

    protected $appends = ['total_price_currency', 'fee_ship_currency'];

    protected $guarded = [];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'orders';

    public function orderItems() {
      return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function paymentType() {
      return $this->hasOne(PaymentType::class, 'id','payment_type');
    }

    public function deliveryType() {
      return $this->hasOne(DeliveryType::class,'id','delivery_type');
    }

    public function user() {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function logs() {
      return $this->hasMany(OrderLog::class, 'order_id', 'id');
    }

    public function notes() {
      return $this->hasMany(OrderNote::class, 'order_id', 'id');
    }

    public function getTotalPrice(){
      $total = 0;
      foreach($this->orderItems AS $item){
        $total += $item->price * $item->quantity;
      }
      return $total;
    }

    public function isPaid(): bool {
      return $this->payment_status == PaymentStatus::PAID;
    }

    public function isRefund() {
      return $this->status == OrderStatus::PENDING_REFUND || $this->status == OrderStatus::REFUND;
    }

    public function getOrderStatusEShop(): string {
      $status = '';
      switch ($this->status) {
        case OrderStatus::CANCEL:
          $status = EShopEnum::ORDER_STATUS['HUY_DON']; 
          break;
        
        case OrderStatus::NEW_ORDER:
          $status = EShopEnum::ORDER_STATUS['TAO_DON_HANG_MOI']; 
          break;

        case OrderStatus::ASSIGNED:
          $status = EShopEnum::ORDER_STATUS['TIEP_NHAN_DON_HANG']; 
          break;
       // chưa thanh toán
        case OrderStatus::UNPAID:
          $status = EShopEnum::ORDER_STATUS['TIEP_NHAN_DON_HANG']; 
          break;

        case OrderStatus::EXPORTED:
          $status = EShopEnum::ORDER_STATUS['DANG_DONG_GOI']; 
          break;

        case OrderStatus::ON_DELIVERY:
          $status = EShopEnum::ORDER_STATUS['DANG_GIAO_HANG']; 
          break;

        case OrderStatus::DELIVERED:
          // Đã giao hàng
          $status = EShopEnum::ORDER_STATUS['DANG_GIAO_HANG'];
          break;
        
        // Hoàn tiền
        case OrderStatus::PENDING_REFUND:
          $status = EShopEnum::ORDER_STATUS['HUY_DON']; 
          break;

        case OrderStatus::REFUND:
          $status = EShopEnum::ORDER_STATUS['HUY_DON']; 
          break;

        case OrderStatus::DONE:
          $status = EShopEnum::ORDER_STATUS['DA_HOAN_THANH']; 
          break;

        default:
          # code...
          break;
      }

      return $status;
    }

    public function getOrderHadaStatusByEShopOrderStatus(string $eShopOrderStatus=''): string {
      $status = '';
      switch ($eShopOrderStatus) {
        case EShopEnum::ORDER_STATUS['HUY_DON']:
          $status = OrderStatus::CANCEL;  
          break;
        
        case EShopEnum::ORDER_STATUS['TAO_DON_HANG_MOI']:
          $status = OrderStatus::NEW_ORDER;  
          break;

        case EShopEnum::ORDER_STATUS['TIEP_NHAN_DON_HANG']:
          $status = OrderStatus::ASSIGNED;
          break;

        case EShopEnum::ORDER_STATUS['DANG_DONG_GOI']:
          $status = OrderStatus::EXPORTED; 
          break;

        case EShopEnum::ORDER_STATUS['DANG_GIAO_HANG']:
          $status = OrderStatus::ON_DELIVERY;  
          break;

        case EShopEnum::ORDER_STATUS['DA_HOAN_THANH']:
          $status =  OrderStatus::DONE; 
          break;

        default:
          # code...
          break;
      }

      return $status;
    }

    public function orderLoyalty() {
      return $this->hasOne(OrderLoyalty::class, 'mapping_id', 'id')
                  ->where(['mapping_model' => self::class, 'type' => 'sub', 'is_finish' => 1]);
    }

    public function customerRefRevenue() {
      return $this->hasOne(CustomerRefRevenue::class, 'order_id','id');
    }
} // End class
