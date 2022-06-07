<div class="row order-log-item" data-id="{{ $item['id'] }}">
  <!-- timeline item 1 left dot -->
  <div class="col-auto text-center flex-column d-none d-sm-flex">
    <div class="row h-50">
      <div class="col">&nbsp;</div>
      <div class="col">&nbsp;</div>
    </div>
    <h5 class="m-2">
      <span class="badge badge-pill bg-light border">&nbsp;</span>
    </h5>
    <div class="row h-50">
      <div class="col border-right">&nbsp;</div>
      <div class="col">&nbsp;</div>
    </div>
  </div>

  <!-- timeline item 1 event content -->
  <div class="col">
    <div class="card mb-2">
      <div class="card-body p-2" style="background-color: {{ $item['color'] }}">
        <div class="float-right">{{ $item['created_at'] }}</div>
        <h5 class="card-title">
          {{ $item['title'] }}
        </h5>
        <p class="card-text d-flex">
          <span>
          @if (!empty($item['message']))
            {{ $item['message'] }}
          @else
            Không xác định
          @endif
          </span>
        </p>
      </div>
    </div>
  </div>
</div>
<!--/row-->
