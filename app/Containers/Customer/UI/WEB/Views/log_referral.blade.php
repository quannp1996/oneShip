@extends('basecontainer::admin.layouts.default_for_iframe')

@section('right-breads')
{!! $logs->appends($input)->links('order::inc.paginator') !!}
@endsection
@section('content')
<div class="row" id="sectionContent">
    <div class="col-12">
        <div class="card mb-0">


            <div class="card-header d-flex">
                <button class="btn btn-link">Log giới thiệu của KH: {{ $customer->fullname }}</button>
                <div class="d-flex ml-auto">
                    <button type="button" class="btn btn-secondary mr-2"
                        onclick='return closeFrame(@bladeJson($customer))'>Đóng lại</button>
                </div>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs nav-underline nav-underline-primary">
                    <li class="nav-item">
                        <a class="nav-link {{ $input['type']=='don_hang' ? 'active' : '' }}"
                            href="{{ route('admin.customers.log_referral',['id'=>$customer_id,'type'=>'don_hang']) }}">
                            DS đơn hàng hưởng điểm
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ $input['type']=='luot_gioi_thieu' ? 'active' : '' }}"
                            href="{{ route('admin.customers.log_referral',['id'=>$customer_id,'type'=>'luot_gioi_thieu']) }}">
                            DS lượt giới thiệu
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ $input['type']=='nguoi_gioi_thieu' ? 'active' : '' }}"
                            href="{{ route('admin.customers.log_referral',['id'=>$customer_id,'type'=>'nguoi_gioi_thieu']) }}">
                            DS người giới thiệu
                        </a>
                    </li>


                </ul>
                <br>
                @include('customer::inc.filter-log-referral')
                <br>
                @if(@$input['type']=='don_hang')

                <table class="table table-hover table-bordered mb-0">
                    <thead>
                        <tr>
                            <th scope=" col">Mã đơn hàng</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col" class="text-center">Tổng tiền</th>
                            <th scope="col" class="text-center">Điểm thưởng</th>
                            <th scope="col" class="text-center">Ngày đặt</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (@$logs as $refRevenue)
                        <tr>
                            <td scope="col">{{ @$refRevenue->order->code }}</td>
                            <td scope="col">
                                <p class="mb-1"><i class="fa fa-user"></i>
                                    &nbsp;{{ ucwords(@$refRevenue->order->fullname) }}</p>

                                @if (!empty(@$refRevenue->order->email))
                                <p class="mb-1"><b>@</b> <a
                                        href="mailto:{{ @$refRevenue->order->email }}">{{ @$refRevenue->order->email }}</a>
                                </p>
                                @endif

                                @if (!empty(@$refRevenue->order->phone))
                                <p class="mb-1"><i class="fa fa-mobile"></i>
                                    &nbsp;&nbsp;{{ @$refRevenue->order->phone }}</p>
                                @endif
                            </td>
                            <td scope="col" class="text-center">{{ (@$refRevenue->order->total_price + @$refRevenue->order->fee_shipping - (@$refRevenue->order->point_value*@$refRevenue->order->point_rate) ) }}</td>
                            <td scope="col" class="text-center">{{ @$refRevenue->point }}</td>
                            <td scope="col" class="text-center">{{ @$refRevenue->order->created_at }}</td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">Chưa có thông tin</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @else
                <table class="table table-hover table-bordered mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">ID</th>
                            <th scope="col">Họ Tên</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-center">Số Điện Thoại</th>
                            <th scope="col" class="text-center">Ngày giới thiệu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (@$logs as $ref)
                        <?php
                                if($input['type']=='luot_gioi_thieu'){
                                    $value=@$ref->customerReferraled;
                                }
                                else{
                                    $value=@$ref->customerReferral;
                                }
                            ?>
                        <tr>
                            <td scope="col" class="text-center">{{ @$value->id }}</td>
                            <td scope="col">{{ @$value->fullname }}</td>
                            <td scope="col">
                                {{ @$value->email}}
                            </td>
                            <td scope="col" class="text-center">{{ @$value->phone }}</td>
                            <td scope="col" class="text-center">{{ @$ref->created_at }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">Chưa có thông tin</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @endif

                <br>
                <div class="row">
                <ol class="breadcrumb border-0 m-auto ml-auto">
                    <li class="breadcrumb-item">@yield('right-breads')</li>
                </ol>
                </div>
                
            </div>



        </div>
    </div>
</div>
@endsection