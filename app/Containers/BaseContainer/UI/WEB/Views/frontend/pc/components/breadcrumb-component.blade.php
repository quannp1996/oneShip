@if(isset($breadcrumb) && !empty($breadcrumb))
    <div class="breadcrumb-page">
        @foreach ($breadcrumb as $item)
            @if($item['isCurrent'])
                <a href="javascript:;">{{ $item['title'] }}</a>
            @else
                <a href="{{ $item['link'] }}" >{{ $item['title'] }}</a>
            @endif
        @endforeach
    </div>
@endif

