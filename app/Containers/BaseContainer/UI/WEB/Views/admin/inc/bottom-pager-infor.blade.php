@if (empty($data) || $data->isEmpty())
    <h4 align="center">Không tìm thấy dữ liệu phù hợp</h4>
@else
    <div class="pull-right">{{__('Tổng cộng')}}: {{ $data->total() }} {{__('bản ghi')}} / {{ $data->lastPage() }} {{__('trang')}}</div>
    {!! $data->links('basecontainer::admin.inc.paginator') !!}
@endif
