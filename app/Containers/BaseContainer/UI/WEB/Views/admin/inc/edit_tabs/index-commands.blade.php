@can($containerName.'-edit')
    @if(isset($routes['status']))
        @php
            $routeEnable = $routeDisable = route($routes['status'], $item->id)
        @endphp
    @elseif(isset($routes['enable']) && isset($routes['disable']))
        @php
            $routeEnable = route($routes['enable'], $item->id);
            $routeDisable = route($routes['disable'], $item->id)
        @endphp
    @endif
    @if(!empty($routeEnable) && !empty($routeDisable))
        <div class="mb-2">
            <a href="javascript:void(0)"
               @if($item->status == \App\Ship\core\Foundation\BladeHelper::HIEN_THI)
               class="text-success"
               data-route="{{ @$routeDisable }}"
               onclick="admin.updateStatus(this, {{$item->id}}, {{\App\Ship\core\Foundation\BladeHelper::AN}})"
               data-original-title="Đang HIỂN THỊ, Click để ẨN"
               @else
               class="text-danger"
               data-route="{{ @$routeEnable }}"
               onclick="admin.updateStatus(this, {{$item->id}}, {{\App\Ship\core\Foundation\BladeHelper::HIEN_THI}})"
               data-original-title="Đang ẨN, Click để HIỂN THỊ"
               @endif
               data-toggle="tooltip"
            ><i class="fa fa-eye"></i></a>
        </div>
    @endif
@endcan

@can($containerName.'-edit')
    <div class="mb-2">
        <a class="text-decoration-none text-primary" href="{{ route($routes['edit'], $item->id) }}"
           data-toggle="tooltip" data-original-title="Chỉnh sửa">
            <i class="fa fa-pencil"></i></a>
    </div>
@endcan

@can($containerName.'-delete')
    <div class="mb-2">
        <a class="text-decoration-none text-danger delete-btn" data-href="{{route($routes['destroy'], [$item->id])}}"
           onclick="admin.delete_this(this)" data-toggle="tooltip" data-original-title="Xóa"
        ><i class="fa fa-trash"></i></a>
    </div>
@endcan