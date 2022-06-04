<?php $type=$input['type'];?>
<form action="{{ route('admin.customers.log_referral',['id'=>$customer_id]) }}" method="GET" class="form-inline">
    @if(@$input['type']=='don_hang')
    <div class="form-group col-3 pl-0">
        <input type="text" class="form-control w-100" placeholder="Mã đơn hàng" name="code"
            value="{{ @$input['code']}}" />
    </div>
    <div class="form-group col-3 pl-0">
        <input type="text" class="form-control w-100" placeholder="Tên/Email/Số điện thoại" name="keyword"
            value="{{ @$input['keyword']}}" />
    </div>
    <div class="form-group mx-2">
        <input type="text" class="form-control datetimepicker" autocomplete="off" placeholder="Thời gian đặt hàng"
            name="created_at" value="{{ @$input['created_at']}}" />
    </div>
    @else
    <div class="form-group col-3 pl-0">
        <input type="text" class="form-control w-100" placeholder="ID" name="customer_id"
            value="{{ @$input['customer_id']}}" />
    </div>
    <div class="form-group col-3 pl-0">
        <input type="text" class="form-control w-100" placeholder="Tên/Email/Số điện thoại" name="keyword"
            value="{{ @$input['keyword']}}" />
    </div>
    <div class="form-group mx-2">
        <input type="text" class="form-control datetimepicker" autocomplete="off" placeholder="Ngày giới thiệu"
            name="created_at" value="{{ @$input['created_at']}}" />
    </div>

    @endif
    <input type="hidden" name='type' value="{{$input['type']}}">
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
    </div>


 


</form>

@push('js_bot_all')
<script>
$('.datetimepicker').datetimepicker({
    format: 'd/m/Y',
    timepicker: false
});
</script>
@endpush