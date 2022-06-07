@extends('basecontainer::admin.layouts.default_for_iframe')
@section('content')
<div class="row" id="sectionContent">
  <div class="col-12">
    <form action="{{ route('admin.orders.note.store', ['orderId' => $input['orderId'] ]) }}" method="POST">
      @csrf
      <div class="card mb-0">
        <div class="card-header d-flex">
          <button class="btn btn-link">Danh sách ghi chú của đơn hàng: <b>{{ $order->code }}</b> </button>
          <div class="ml-auto">
            <button type="button" class="btn btn-secondary mr-2" onclick='return closeFrame()'>Đóng lại</button>
            <a class="btn btn-primary" href="{{ route('admin.orders.note.create', ['orderId' => $input['orderId'] ])}}">Tạo ghi chú</a>
          </div>
        </div>

        <div class="card-body">
          @forelse($orderNotes->sortDesc() as $note)
            @include('order::note.note-item', ['item' => $note])
          @empty
            Chưa có ghi chú
          @endforelse
        </div><!-- /.Card-body -->
      </div><!-- /.End card -->
    </form>
  </div>
</div>
@endsection


