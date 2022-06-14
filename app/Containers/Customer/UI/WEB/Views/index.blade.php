@extends('basecontainer::admin.layouts.default')

@section('right-breads')
    {{-- {!! $customers->appends($input)->links('order::inc.paginator') !!} --}}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-accent-primary">
                <div class="card-header d-flex py-0">
                    <ul class="nav nav-tabs nav-underline nav-underline-primary card-header-tabs"
                        style="border-bottom: unset;border-color:unset;">
                        <li class="nav-item">
                            <a class="nav-link {{ empty($input['group_id']) ? 'active' : '' }}"
                                href="{{ route('admin.customers.index') }}">
                                Tất cả
                            </a>
                        </li>
                        @include('customer::inc.filter')
                    </ul>
                </div>
                <table class="table table-hover table-bordered mb-0" id="tableCustomer">
                    <thead>
                        <tr>
                            <th>
                                ID
                                <a href="javascript:void(0)"
                                    onclick="return addQueryParams('sort[id]', {{ !(!empty($input['sort']['id']) ? 1 : '0') }})">
                                    <i class="fa fa-long-arrow-{{ empty($input['sort']['id']) ? 'down' : 'up' }}"
                                        aria-hidden="true"></i>
                                </a>
                            </th>
                            <th>
                                Tên
                                <a href="javascript:void(0)"
                                    onclick="return addQueryParams('sort[fullname]', {{ !(!empty($input['sort']['fullname']) ? 1 : '0') }})">
                                    <i class="fa fa-long-arrow-{{ empty($input['sort']['fullname']) ? 'down' : 'up' }}"
                                        aria-hidden="true"></i>
                                </a>
                            </th>
                            <th>
                                Email
                                <a href="javascript:void(0)"
                                    onclick="return addQueryParams('sort[email]', {{ !(!empty($input['sort']['email']) ? 1 : '0') }})">
                                    <i class="fa fa-long-arrow-{{ empty($input['sort']['email']) ? 'down' : 'up' }}"
                                        aria-hidden="true"></i>
                                </a>
                            </th>
                            <th>
                                SĐT
                                <a href="javascript:void(0)"
                                    onclick="return addQueryParams('sort[phone]', {{ !(!empty($input['sort']['phone']) ? 1 : '0') }})">
                                    <i class="fa fa-long-arrow-{{ empty($input['sort']['phone']) ? 'down' : 'up' }}"
                                        aria-hidden="true"></i>
                                </a>
                            </th>
                            <th>
                                Ngày tạo
                                <a href="javascript:void(0)"
                                    onclick="return addQueryParams('sort[created_at]', {{ !(!empty($input['sort']['created_at']) ? 1 : '0') }})">
                                    <i class="fa fa-long-arrow-{{ empty($input['sort']['created_at']) ? 'down' : 'up' }}"
                                        aria-hidden="true"></i>
                                </a>
                            </th>
                            <th>Chi tiết</th>
                        </tr>

                        @if (isset($input['is_filter']))
                            <tr class="table-info">
                                <td colspan="8">
                                    <center class="font-weight-bold text-info">
                                        <i class="fa fa-search"></i> Tìm thấy
                                        @if ($customers->total() > 0)
                                            {{ $customers->firstItem() }} - {{ $customers->lastItem() }} trong số
                                            {{ $customers->total() }} kết quả.
                                        @else
                                            0 kết quả.
                                        @endif
                                    </center>
                                </td>
                            </tr>
                        @endif
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                            @include('customer::inc.item', ['item' => $customer])
                        @empty
                            <tr class="table-warning">
                                <td colspan="8">
                                    Không có dữ liệu.
                                    @if (!empty($input))
                                        <a href="{{ route('admin.customers.index') }}">Hủy bộ lọc</a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
