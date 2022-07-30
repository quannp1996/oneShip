<div class="tab-pane active" id="general">
    <div class="form-group">
        <label for="fullname"><strong>Họ và Tên: </strong></label>
        <span id="fullname">{{ $customer->fullname }}</span>
    </div>
    <div class="form-group">
        <label for="email"><strong>Email: </strong></label>
        <span id="email">{{ $customer->email }}</span>
    </div>
    <div class="form-group">
        <label for="phone"><strong>Số điện thoại: </strong></label>
        <span id="phone">{{ $customer->phone }}</span>
    </div>
    <div class="form-group">
        <label for="address"><strong>Địa chỉ: </strong></label>
        <span id="address">{{ $customer->address }}</span>
    </div>
    <div class="form-group">
        <label for="address"><strong>Tổng số tiền COD: </strong></label>
        <span id="address">{{ \FunctionLib::priceFormat($customer->orders->sum('cod')) }} &nbsp; <i class="fa fa-money"></i></span>
    </div>
</div>
