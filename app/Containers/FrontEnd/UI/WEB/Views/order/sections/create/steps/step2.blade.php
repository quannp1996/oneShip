<div class="admin-card">
    <div class="admin-card-body p-0">
        <div class="admin-card-head py-3">
            <a class="title d-flex align-items-center justify-content-between color-748399" data-toggle="collapse"
                href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                Thông tin sản phẩm và kiện hàng
                <span role="img" aria-label="right" class="icon-svg smm color-748399">
                    <svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em" height="1em"
                        fill="currentColor" aria-hidden="true" style="">
                        <path
                            d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z">
                        </path>
                    </svg>
                </span>
            </a>
        </div>
        <div class="admin-card-body collapse multi-collapse show" id="multiCollapseExample1">
            <div class="d-block text-right">
                <a class="d-flex align-items-center justify-content-end" data-toggle="modal"
                    data-target="#modalKichThuoc">
                    <svg class="icon-svg smm" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M14.7915 2.79192C15.143 2.44045 15.7128 2.44045 16.0643 2.79192L19.4929 6.2205C19.6617 6.38928 19.7565 6.6182 19.7565 6.85689C19.7565 7.09559 19.6617 7.3245 19.4929 7.49329L10.0643 16.9219C9.89552 17.0906 9.6666 17.1855 9.4279 17.1855H5.99933C5.50227 17.1855 5.09933 16.7825 5.09933 16.2855V12.8569C5.09933 12.6182 5.19415 12.3893 5.36293 12.2205L14.7915 2.79192ZM6.89933 13.2297V15.3855H9.05511L17.5837 6.85689L15.4279 4.70111L6.89933 13.2297ZM4.24219 20.5712C4.24219 20.0741 4.64513 19.6712 5.14219 19.6712H19.7136C20.2107 19.6712 20.6136 20.0741 20.6136 20.5712C20.6136 21.0682 20.2107 21.4712 19.7136 21.4712H5.14219C4.64513 21.4712 4.24219 21.0682 4.24219 20.5712Z">
                        </path>
                    </svg>
                    <span>Điền kích thước bưu kiện (không bắt buộc)</span>
                </a>
                <!-- Modal Nguoi Nhan-->
                <div class="modal fade" id="modalKichThuoc" tabindex="-1" role="dialog" aria-labelledby=""
                    aria-hidden="true">
                    <div class="modal-dialog modal-md " role="document">
                        <div class="modal-content">
                            <div class="modal-custom-header">
                                <div class="title">
                                    Thêm kiện hàng & thông tin
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-custom-form text-left">
                                <div class="admin-card-row">
                                    <div class="col-4 my-3">
                                        <div class="admin-form-item-label">
                                            <label for="l" class="admin-form-item" title="l">
                                                l
                                            </label>
                                        </div>
                                        <div class="admin-form-item-control">
                                            <div class="admin-form-item-control-input">
                                                <div class="admin-form-item-control-input-content">
                                                    <span class="admin-input-adon ">
                                                        <input placeholder="l" id="l"
                                                            class="admin-form-input admin-adon-input" type="text"
                                                            v-model="package.size.l" />
                                                        <span class="admin-input-group-addon">cm</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 my-3">
                                        <div class="admin-form-item-label">
                                            <label for="w" class="admin-form-item" title="w">
                                                w
                                            </label>
                                        </div>
                                        <div class="admin-form-item-control">
                                            <div class="admin-form-item-control-input">
                                                <div class="admin-form-item-control-input-content">
                                                    <span class="admin-input-adon ">
                                                        <input placeholder="w" id="w"
                                                            class="admin-form-input admin-adon-input" type="text"
                                                            v-model="package.size.w" />
                                                        <span class="admin-input-group-addon">cm</span>
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 my-3">
                                        <div class="admin-form-item-label">
                                            <label for="l" class="admin-form-item" title="h">
                                                h
                                            </label>
                                        </div>
                                        <div class="admin-form-item-control">
                                            <div class="admin-form-item-control-input">
                                                <div class="admin-form-item-control-input-content">
                                                    <span class="admin-input-adon ">
                                                        <input placeholder="h" id="h"
                                                            class="admin-form-input admin-adon-input" type="text"
                                                            v-model="package.size.h" />
                                                        <span class="admin-input-group-addon">cm</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-custom-actions d-flex align-items-center justify-content-end">
                                    <button class="btn-themes nocolor-btn mr-2" data-dismiss="modal" type="button">
                                        Hủy
                                    </button>
                                    <button class="btn-themes color-btn" type="button">
                                        Thêm
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="admin-table mt-20">
                <div class="admin-table-container border-0">
                    <div class="admin-table-header">
                        <table class="border-0">
                            <colgroup>
                                <col style="width: 80px;" />
                                <col style="width: 200px;" />
                                <col style="width: 200px;" />
                                <col style="width: 200px;" />
                                <col style="width: 200px;" />
                                <col style="width: 100px;" />
                            </colgroup>
                            <thead class="admin-table-thead">
                                <tr>
                                    <th class="admin-table-cell border-0">Số sê-ri</th>
                                    <th class="admin-table-cell border-0">Mã sản phẩm ( Không bắt buộc ) </th>
                                    <th class="admin-table-cell border-0">Tên sản phẩm</th>
                                    <th class="admin-table-cell border-0">Số lượng</th>
                                    <th class="admin-table-cell border-0">
                                        <span class="d-flex align-items-center">
                                            Giá
                                            <svg class="icon-svg small ml-2" focusable="false" viewBox="0 0 24 24"
                                                aria-hidden="true">
                                                <path
                                                    d="M12.8988 12.5673C12.8988 12.0702 12.4958 11.6673 11.9988 11.6673C11.5017 11.6673 11.0988 12.0702 11.0988 12.5673V15.9958C11.0988 16.4929 11.5017 16.8958 11.9988 16.8958C12.4958 16.8958 12.8988 16.4929 12.8988 15.9958V12.5673Z">
                                                </path>
                                                <path
                                                    d="M12.0008 10.2515C12.6991 10.2515 13.2652 9.68542 13.2652 8.98709C13.2652 8.28876 12.6991 7.72266 12.0008 7.72266C11.3024 7.72266 10.7363 8.28876 10.7363 8.98709C10.7363 9.68542 11.3024 10.2515 12.0008 10.2515Z">
                                                </path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M11.9988 2.52832C6.76785 2.52832 2.52734 6.76882 2.52734 11.9997C2.52734 17.2307 6.76785 21.4712 11.9988 21.4712C17.2297 21.4712 21.4702 17.2307 21.4702 11.9997C21.4702 6.76882 17.2297 2.52832 11.9988 2.52832ZM4.32734 11.9997C4.32734 7.76294 7.76196 4.32832 11.9988 4.32832C16.2356 4.32832 19.6702 7.76294 19.6702 11.9997C19.6702 16.2366 16.2356 19.6712 11.9988 19.6712C7.76196 19.6712 4.32734 16.2366 4.32734 11.9997Z">
                                                </path>
                                            </svg>
                                        </span>
                                    </th>
                                    <th class="admin-table-cell border-0"></th>
                                </tr>
                            </thead>
                            <tbody class="admin-table-body">
                                <tr v-for="(item, index) in package.list">
                                    <td class="admin-table-cell border-0" v-text="index + 1"></td>
                                    <td class="admin-table-cell border-0">
                                        <div class="admin-form-item-control-input py-2">
                                            <div class="admin-form-item-control-input-content">
                                                <input placeholder="" id="" class="admin-form-input "
                                                    type="text" v-model="item.productCode"/>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="admin-table-cell border-0">
                                        <div class="admin-form-item-control-input py-2">
                                            <div class="admin-form-item-control-input-content">
                                                <input placeholder="" id="" class="admin-form-input "
                                                    type="text" v-model="item.productName" />

                                            </div>
                                        </div>
                                    </td>
                                    <td class="admin-table-cell border-0">
                                        <div class="admin-form-item-control-input py-2">
                                            <div class="admin-form-item-control-input-content">
                                                <input placeholder="" id="" class="admin-form-input "
                                                    type="text" v-model="item.quanlity" />
                                            </div>
                                        </div>
                                    </td>
                                    <td class="admin-table-cell border-0">
                                        <span class="price-box-wrap">
                                            <div class="priceinput">
                                                <span class="price-input">
                                                    <input placeholder="" class="admin-form-input" type="text"
                                                        v-model="item.price" />
                                                </span>
                                            </div>
                                            <div class="pricesuggest">
                                                <div class="pricesuggest-dropdown js-customdropdown-holder coupon-actions">
                                                    <a href="javascript:;" class="color-00112f">
                                                        <span
                                                            class="admin-select-selection-item js-customdropdown-value">VND</span>
                                                    </a>
                                                </div>
                                                {{-- <div
                                                    class="pricesuggest-dropdown-menu dropdown-coupon-actions js-coupon-infos">
                                                    <a class="pricesuggest-item js-customdropdown-item"
                                                        href="javascript:;">VND</a>
                                                    <a class="pricesuggest-item js-customdropdown-item"
                                                        href="javascript:;">USD</a>
                                                    <a class="pricesuggest-item js-customdropdown-item"
                                                        href="javascript:;">CHN</a>
                                                </div> --}}
                                            </div>
                                        </span>
                                    </td>
                                    <td class="admin-table-cell border-0"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-block text-center my-3">
                <button type="button" @click="addPackage()" class="btn-themes nocolor-btn">
                    <span class="icon-svg smm">
                        <span role="img" class="color-748399">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                                class="">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.9998 2.8284C8.33117 2.8284 8.5998 3.09703 8.5998 3.4284V7.39983H12.5712C12.9026 7.39983 13.1712 7.66846 13.1712 7.99983C13.1712 8.3312 12.9026 8.59983 12.5712 8.59983H8.5998V12.5713C8.5998 12.9026 8.33117 13.1713 7.9998 13.1713C7.66843 13.1713 7.3998 12.9026 7.3998 12.5713V8.59983H3.42837C3.097 8.59983 2.82837 8.3312 2.82837 7.99983C2.82837 7.66846 3.097 7.39983 3.42837 7.39983H7.3998V3.4284C7.3998 3.09703 7.66843 2.8284 7.9998 2.8284Z">
                                </path>
                            </svg>
                        </span>
                    </span>
                    <span>Thêm vào</span>
                </button>
            </div>
            <div class="admin-card-row">
                <div class="col-4 my-3">
                    <div class="admin-form-item-label">
                        <label for="kg" class="admin-form-item-required" title="kg">
                            Trọng lượng kiện hàng
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <span class="admin-input-adon ">
                                    <input placeholder="Vui lòng nhập" id="weight"
                                        class="admin-form-input admin-adon-input" type="text" v-model="package.weight" />
                                    <span class="admin-input-group-addon">Kg</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 my-3">
                    <div class="admin-form-item-label">
                        <label for="aa" class="admin-form-item-required" title="aa">
                            Số tham chiếu (ví dụ: mã số gốc của đơn hàng)
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <input v-model="reference_code" placeholder="" id="aa" class="admin-form-input admin-adon-input"
                                    type="text" value="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 my-3">
                    <div class="admin-form-item-label">
                        <label for="note" class="admin-form-item-required" title="note">
                            Ghi chú
                        </label>
                    </div>
                    <div class="admin-form-item-control">
                        <div class="admin-form-item-control-input">
                            <div class="admin-form-item-control-input-content">
                                <textarea 
                                    v-model="note"
                                    class="admin-form-input admin-adon-input"
                                    placeholder="Vui lòng nhập" 
                                    name="note" id="note" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
