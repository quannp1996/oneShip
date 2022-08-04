@extends('basecontainer::frontend.pc.layouts.home')
@section('content')
    <div class="admin-main-layout" id="orderAPP">
        <svg aria-hidden="true" style="position: absolute; width: 0px; height: 0px; overflow: hidden;">
            <symbol id="icon-Filter" viewBox="0 0 1024 1024">
                <path
                    d="M111.402667 166.698667a38.4 38.4 0 0 1 34.858666-22.229334H877.653333a38.4 38.4 0 0 1 29.312 63.146667l-283.477333 335.274667v334.848a38.4 38.4 0 0 1-55.594667 34.304l-146.304-73.130667a38.4 38.4 0 0 1-21.205333-34.346667v-261.674666L116.949333 207.658667a38.4 38.4 0 0 1-5.546666-40.96z m117.632 54.570666l239.104 282.752a38.4 38.4 0 0 1 9.088 24.789334v252.032l69.504 34.730666v-286.72a38.4 38.4 0 0 1 9.045333-24.832l239.146667-282.752H229.034667z">
                </path>
            </symbol>
        </svg>
        <div class="admin-main-container xxl">
            <div class="d-flex justify-content-between mt-20">
                <div class="title text-24 lh-32">
                    Quản lý đơn hàng
                </div>
                <div class="d-flex align-items-center position-relative">
                    <div class="btn-themes nocolor-btn mr-2">
                        <div class="d-flex align-items-center">
                            <a href="{{ route('web_orders_export') }}">
                                <span class="icon-svg">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" class="">
                                        <path
                                            d="M7.57656 9.47171C7.68909 9.58424 7.8417 9.64745 8.00083 9.64745C8.15996 9.64745 8.31257 9.58424 8.42509 9.47171L10.7108 7.186C10.9451 6.95169 10.9451 6.57179 10.7108 6.33747C10.4765 6.10316 10.0966 6.10316 9.86228 6.33747L8.60083 7.59892V2.28555C8.60083 1.95418 8.3322 1.68555 8.00083 1.68555C7.66946 1.68555 7.40083 1.95418 7.40083 2.28555L7.40083 7.59892L6.13938 6.33747C5.90506 6.10316 5.52517 6.10316 5.29085 6.33747C5.05654 6.57179 5.05654 6.95169 5.29085 7.186L7.57656 9.47171Z">
                                        </path>
                                        <path
                                            d="M3.3618 7.99992C3.3618 7.66855 3.09318 7.39992 2.7618 7.39992C2.43043 7.39992 2.1618 7.66855 2.1618 7.99992V12.5714C2.1618 13.0336 2.34543 13.4769 2.67228 13.8037C2.99912 14.1306 3.44243 14.3142 3.90466 14.3142H12.0951C12.5574 14.3142 13.0007 14.1306 13.3275 13.8037C13.6544 13.4769 13.838 13.0336 13.838 12.5714V7.99992C13.838 7.66855 13.5694 7.39992 13.238 7.39992C12.9066 7.39992 12.638 7.66855 12.638 7.99992V12.5714C12.638 12.7153 12.5808 12.8534 12.479 12.9552C12.3772 13.057 12.2391 13.1142 12.0951 13.1142H3.90466C3.76069 13.1142 3.62261 13.057 3.5208 12.9552C3.419 12.8534 3.3618 12.7153 3.3618 12.5714V7.99992Z">
                                        </path>
                                    </svg>
                                </span>
                                Xuất đơn hàng
                            </a>
                        </div>
                    </div>
                    <div class="btn-themes color-btn dropdown-hover">
                        <div class="d-flex align-items-center">
                            <span class="icon-svg">
                                <svg class="" focusable="false" viewBox="0 0 24 24" aria-hidden="true"
                                    style="color: rgb(255, 255, 255);stroke: transparent;fill: currentColor;">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.9993 4.24219C12.4964 4.24219 12.8993 4.64513 12.8993 5.14219V11.0993H18.8565C19.3535 11.0993 19.7565 11.5023 19.7565 11.9993C19.7565 12.4964 19.3535 12.8993 18.8565 12.8993H12.8993V18.8565C12.8993 19.3535 12.4964 19.7565 11.9993 19.7565C11.5023 19.7565 11.0993 19.3535 11.0993 18.8565V12.8993H5.14219C4.64513 12.8993 4.24219 12.4964 4.24219 11.9993C4.24219 11.5023 4.64513 11.0993 5.14219 11.0993H11.0993V5.14219C11.0993 4.64513 11.5023 4.24219 11.9993 4.24219Z">
                                    </path>
                                </svg>
                            </span>
                            Tạo đơn hàng
                        </div>
                        <div class="dropdown-trigger-content">
                            <ul class="list-unstyled p-0 m-0">
                                <li class="item">
                                    <a href="{{ route('web_orders_create') }}">
                                        Tạo đơn hàng
                                    </a>
                                </li>
                                {{-- <li class="item">
                                    <a href="javascript:;">
                                        Tạo hàng loạt
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @include('frontend::order.sections.list.filter')
        </div>
    </div>
    @include('frontend::order.sections.list.filter_advanced')
    <!-- chinh sua tieu de -->
    {{-- @include('frontend::order.sections.list.edit_header') --}}
@endsection
@push('css_bot_all')
    <link rel="stylesheet" href="{{ asset('template/libs/daterangepicker/daterangepicker.css') }}">
@endpush
@push('js_bot_all')
    <script src="{{ asset('template/libs/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('template/libs/daterangepicker/daterangepicker.min.js') }}"></script>
    <script>
        var api = {
            fetch: '{{ route('ajax.orders.index') }}'
        }

        function showFilterBars() {
            $('#fixed-filter-bars').addClass('opened');
        }

        function closeFilterBars() {
            $('#fixed-filter-bars').removeClass('opened');
        }

        function showEditBars() {
            $('#fixed-edit-bars').addClass('opened');
        }

        function closeEditBars() {
            $('#fixed-edit-bars').removeClass('opened');
        }
        
        $(document).ready(function() {
            $('.js-customdropdown-holder').on('click', function(e) {
                e.stopPropagation();
                $(this).find('.js-customdropdown-parent').slideToggle(200);
            })
            $('.js-show-sortby').on('click', function(e) {
                e.stopPropagation();
                $(this).parent().find('.js-sortby-content').slideToggle(200);
            })
            $('.js-customdropdown-item').on('click', function(e) {
                e.stopPropagation();
                let text = $(this).text();
                $(this).parents('.js-customdropdown-holder').find('.js-customdropdown-value').text(text);
            })

            $('input[name="datetimes"]').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(24, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });

            $(document).mousedown(function(n) {
                n.stopPropagation();
                if (!$(n.target).parents().hasClass("js-customdropdown-holder")) {
                    $('.js-customdropdown-parent').slideUp();
                }
                if (!$(n.target).parents().hasClass("sortby-status")) {
                    $('.js-sortby-content').slideUp();
                }
            });
        })
    </script>
    <script src="{{ asset('js/pages/orders.js') }}?v={{ $settings['other']['version'] }}"></script>
@endpush
