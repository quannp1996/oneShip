<div class="card border-secondary">
    <div class="card-header text-primary">
        <i class="fa fa-bookmark"></i>
        Trạng thái Đơn hàng
    </div>
    <div class="card-body">
        <div class="row">
            @foreach ($ordersType as $key => $item)
                <div class="col-4">
                    <div class="form-check">
                        <input class="form-check-input" v-model="status" value="{{ $key }}" type="radio"
                            name="status" id="radioStatus{{ $key }}">
                        <label class="form-check-label" for="radioStatus{{ $key }}">
                            {{ $item }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="card border-secondary">
    <div class="card-header text-primary">
        <i class="fa fa-truck"></i>
        Thông tin Vận chuyển
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                Đơn vị vận chuyển
            </div>
            <div class="card-body">
                <div class="list-group" v-if="shippings && shippings.length">
                    <div v-for="(shipping, index) in shippings">
                        <input type="radio" :value="shipping.id" name="shipping" v-model="shippingData.shipping"
                            value="Value1" checked :id="'Radio'+ index"/>
                        <label class="list-group-item" :for="'Radio'+ index">
                            <img width="50px" :src="shipping.image" alt="">
                            @{{ shipping.title }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Cài đặt vận chuyển
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="cod">Khoản tiền thu hộ của đơn hàng COD:</label>
                    <div class="input-group col-6 m-0 p-0">
                        <input type="text" name="shipping_cod" v-model="shippingData.cod" class="form-control">
                        <div class="input-group-append"><span id="basic-addon2" class="input-group-text">VNĐ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
