@extends('basecontainer::frontend.pc.layouts.home')

@section('content')
    <main>
        <div class="d-block text-center my-3 my-lg-5">
            <img src="{{asset('template/images/404_'. app()->getLocale() .'.'. (app()->getLocale() == 'vi' ? 'jpg' : 'png'))}}" alt="">
        </div>
    </main>
@endsection
