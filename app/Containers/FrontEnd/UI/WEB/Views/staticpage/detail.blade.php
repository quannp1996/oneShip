@extends('basecontainer::frontend.pc.layouts.home')
@section('content')
    <div class="admin-main-layout">
        <div class="admin-main-container">
            @if (!empty($staticPage))
                {!! $staticPage->desc->short_description !!}
            @endif
        </div>
    </div>
@endsection
