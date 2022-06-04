@extends('basecontainer::admin.layouts.default_for_iframe')
@section('content')
<div class="row" id="sectionContent">
  <div class="col-12">
    <form action="{{ route('admin.orders.note.store', ['orderId' => $input['orderId'] ]) }}" method="POST">
      @csrf
      <div class="card mb-0">
        <div class="card-header d-flex">
          <button class="btn btn-link">Tạo ghi chú đơn hàng: <strong>{{ $order->code }}</strong></button>
          <div class="ml-auto">
            <button type="button" class="btn btn-secondary mr-2" onclick='return closeFrame()'>Đóng lại</button>
            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
          </div>
        </div>

        <div class="card-body">
          <div class="form-group">
            <label for="">Tiêu đề ghi chú</label>
            <div class="input-group">
              <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
              <div class="input-group-append" style="width: 6%;">
                <input type="color" name="color" class="form-control p-0" value="{{ old('color', '#ffffff') }}" />
              </div>
            </div>
          </div>

          <div class="from-group">
            <label for="">Nội dung ghi chú</label>
            <textarea name="message" cols="30" rows="10" class="form-control" required>{{ old('message', '') }}</textarea>
          </div>
        </div><!-- /.Card-body -->
      </div><!-- /.End card -->
    </form>
  </div>
</div>
@endsection


