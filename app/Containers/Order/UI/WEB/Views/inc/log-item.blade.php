<div class="row order-log-item">
    <!-- timeline item 1 left dot -->
    <div class="col-auto text-center flex-column d-none d-sm-flex">
        <div class="row h-50">
            <div class="col {{ $loop->even ? 'border-right' : '' }}">&nbsp;</div>
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
        <div class="card mb-2 {{ $loop->even ? 'shadow' : '' }}">
            <div class="card-body p-2">
                <div class="float-right {{ $loop->even ? 'text-muted' : '' }}">{{ $log->created_at }}</div>
                <h5 class="card-title {{ $loop->even ? 'text-muted' : '' }}">
                    @if (isset($orderActions[$log->action_key]))
                        {{ $orderActions[$log->action_key] }} - [ {{ $log->action_key }} ]
                    @else
                        [ {{ $log->action_key }} ]
                    @endif
                </h5>
                <p class="card-text d-flex">
                    <span>{{ $log->getObjectProcessText() }}: {{ $log->note }}</span>
                    {{-- <a href="javascript:void(0)" class="text-danger ml-auto btn-log-delete">Xóa</a> --}}
                </p>
            </div>
        </div>
    </div>
</div>
<!--/row-->
