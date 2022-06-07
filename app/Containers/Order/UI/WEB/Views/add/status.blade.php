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
                        <input class="form-check-input" value="{{ $key }}" type="radio" name="status" id="radioStatus{{ $key }}">
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
        Vận chuyển
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                Đơn vị vận chuyển
            </div>
            <div class="card-body">

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Trạng thái vận chuyển
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
