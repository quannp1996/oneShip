@if (empty($data) || $data->isEmpty())
    <h4 align="center">Không tìm thấy dữ liệu phù hợp</h4>
@else
    <div class="p-3">
        <div class="pull-right">Tổng cộng: {{ $data->total() }} bản ghi / {{ $data->lastPage() }} trang</div>
        {!! $data->appends($search_data->toArray())->links('basecontainer::admin.inc.paginator') !!}
    </div>
@endif
