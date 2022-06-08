
<div class="tab-pane" id="activity" role="tabpanel" aria-expanded="false">
    {{--<div class="row">--}}
    {{--<div class="col-sm-3">--}}
    {{--<div class="form-group">--}}
    {{--<label for="title">Giờ mở cửa hàng</label>--}}
    {{--<input type="text" class="form-control{{ $errors->has('res_open') ? ' is-invalid' : '' }}" id="res_open" name="res_open" value="{{ old('res_open', !empty($data['res_open']) ? $data['res_open'] : '10:00') }}">--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
    {{--<div class="col-sm-3">--}}
    {{--<div class="form-group">--}}
    {{--<label for="title">Giờ đóng cửa hàng</label>--}}
    {{--<input type="text" class="form-control{{ $errors->has('res_close') ? ' is-invalid' : '' }}" id="res_close" name="res_close" value="{{ old('res_close', !empty($data['res_close']) ? $data['res_close'] : '22:30') }}">--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    @include('settings::admin.settings.components.shipping_config.index')
    {{--<div class="row">--}}
    {{--<div class="col-sm-3">--}}
    {{--<div class="form-group">--}}
    {{--<label for="currency">Giá trị đơn tối thiểu</label>--}}
    {{--<input type="text" class="form-control{{ $errors->has('min_order') ? ' is-invalid' : '' }}" id="min_order" name="min_order" value="{{ old('min_order', !empty($data['min_order']) ? $data['min_order'] : '150000') }}" required onkeypress="return shop.numberOnly()">--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
    {{--<div class="col-sm-3">--}}
    {{--<div class="form-group">--}}
    {{--<label for="currency">Số lượng tối đa của 1 sản phẩm/lần mua</label>--}}
    {{--<input type="text" class="form-control{{ $errors->has('max_quantity') ? ' is-invalid' : '' }}" id="max_quantity" name="max_quantity" value="{{ old('max_quantity', !empty($data['max_quantity']) ? $data['max_quantity'] : '100') }}" required onkeypress="return shop.numberOnly()">--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-sm-3">--}}
{{--            <div class="form-group">--}}
{{--                <label for="loyalty_project_token">Project token loyalty:</label>--}}
{{--                <input type="text" class="form-control{{ $errors->has('loyalty_project_token') ? ' is-invalid' : '' }}" id="loyalty_project_token" name="loyalty_project_token" value="{{ old('loyalty_project_token', !empty($data['loyalty_project_token']) ? $data['loyalty_project_token'] : '') }}" required>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    {{-- <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="loyalty_vid">Vid loyalty:</label>
                <input type="text" class="form-control{{ $errors->has('loyalty_vid') ? ' is-invalid' : '' }}" id="loyalty_vid" name="loyalty_vid" value="{{ old('loyalty_vid', !empty($data['loyalty_vid']) ? $data['loyalty_vid'] : '') }}" required>
            </div>
        </div>
    </div> --}}

{{--    <div class="row">--}}
{{--        <div class="col-sm-3">--}}
{{--            <div class="form-group">--}}
{{--                <label for="currency">Đơn vị tiền tệ</label>--}}
{{--                <input type="text" class="form-control{{ $errors->has('currency') ? ' is-invalid' : '' }}" id="currency" name="activity[currency]" value="{{ old('activity.currency', !empty($data['activity']['currency']) ? $data['activity']['currency'] : 'VNĐ') }}" required>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-sm-3">--}}
{{--            <div class="form-group">--}}
{{--                <label for="currency">Đơn vị tiền tệ ngắn</label>--}}
{{--                <input type="text" class="form-control{{ $errors->has('currency_short') ? ' is-invalid' : '' }}" id="currency_short" name="activity[currency_short]" value="{{ old('activity.currency_short', !empty($data['activity']['currency_short']) ? $data['activity']['currency_short'] : 'đ') }}" required>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div class="col-sm-3">--}}
{{--            <div class="form-group">--}}
{{--                <label for="email_order">Email nhận thông tin đơn</label>--}}
{{--                <input type="text" class="form-control{{ $errors->has('email_order') ? ' is-invalid' : '' }}" id="email_order" name="activity[email_order]" value="{{ old('activity.email_order', @$data['activity']['email_order']) }}" required>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    {{--                    <div class="row clearfix">--}}
    {{--                        <div class="col-lg-12">--}}
    {{--                            <h3>Extra fee rules</h3>--}}
    {{--                            <table class="table table-bordered table-hover table-sortable table-striped" id="tab_logic">--}}
    {{--                                <thead>--}}
    {{--                                <tr>--}}
    {{--                                    <th class="text-center vcenter" style="width: 20px;"></th>--}}
    {{--                                    <th style="width: 300px;">Danh mục</th>--}}
    {{--                                    <th>Value</th>--}}
    {{--                                    <th class="text-center vcenter"></th>--}}
    {{--                                </tr>--}}
    {{--                                </thead>--}}
    {{--                                <tbody class="container-items tableForm">--}}
    {{--                                <tr id='attr0' data-id="0" class="hidden">--}}
    {{--                                    <td data-name="sort" style="width: 20px;">--}}
    {{--                                        <span class="fa fa-sort"></span>--}}
    {{--                                    </td>--}}
    {{--                                    <td data-name="label">--}}
    {{--                                        <select name="extrafee_cate_id[]" required multiple="multiple" style="width:100%" class="select2 form-control{{ $errors->has('extrafee_cate_id') ? ' is-invalid' : '' }}">--}}
    {{--                                            @foreach ($catOpt as $cat)--}}
    {{--                                                <option  value="{{ old('title', $cat['id']) }}">{{$cat['title']}}</option>--}}
    {{--                                            @endforeach--}}
    {{--                                        </select>--}}
    {{--                                    </td>--}}
    {{--                                    <td data-name="description">--}}
    {{--    --}}{{--                                        <textarea class="form-control" rows="5" name="description" placeholder="giá trị"></textarea>--}}
    {{--                                        <input type="text" class="form-control" name="extrafee_cate_value[]" placeholder="Giá trị" onkeypress="return shop.numberOnly()" onkeyup="shop.mixMoney(this)" onfocus="this.select()">--}}
    {{--                                    </td>--}}
    {{--                                    <td data-name="del" style="width: 90px;">--}}
    {{--                                        <button type="button" class="btn-remove btn btn-danger btn-xs row-remove"><span class="fa fa-minus"></span></button>--}}
    {{--                                    </td>--}}
    {{--                                </tr>--}}
    {{--                                </tbody>--}}
    {{--                            </table>--}}
    {{--                            <input type="hidden" name="serializedData" id="serializedData" value="default"/>--}}
    {{--                            <a id="add_row" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Add Attribute</a>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}

</div>