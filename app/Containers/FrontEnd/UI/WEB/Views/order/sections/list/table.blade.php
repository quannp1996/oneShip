<div class="admin-table mt-20">
    <div class="admin-table-container" style="position: relative; overflow-x: auto;">
        <div>
            <table style="table-layout: fixed;">
                <colgroup>
                    {{-- <col style="width: 44px;" /> --}}
                    <col style="width: 200px;" />
                    <col style="width: 200px;" />
                    <col style="width: 150px;" />
                    <col style="width: 230px;" />
                    <col style="width: 300px;" />
                    <col style="width: 160px;" />
                    <col style="width: 180px;" />
                    <col style="width: 280px;" />
                    <col style="width: 155px;" />
                    <col style="width: 120px;" />
                    <col style="width: 80px;" />
                </colgroup>
                <thead class="admin-table-thead">
                    <tr>
                        {{-- <th class="admin-table-cell admin-table-cell-fix-left" style="position: sticky; left: 0px;">
                            <label class="checkbox-custom mb-0" for="aaa">
                                <span class="checkbox-custom-input">
                                    <input type="checkbox" class="d-none" value="" id="aaa" />
                                    <span class="checkbox-custom-icon"></span>
                                </span>
                            </label>
                        </th> --}}
                        <th class="admin-table-cell admin-table-cell-fix-left admin-table-cell-fix-left-last"
                            style="position: sticky">Mã đơn hàng</th>
                        <th class="admin-table-cell">
                            <div>Người bán</div>
                            <span class="tips">Kiểu tích hợp</span>
                        </th>
                        <th class="admin-table-cell">Trạng thái đơn hàng</th>
                        <th class="admin-table-cell">Khu vực gửi hàng</th>
                        <th class="admin-table-cell">Người nhận</th>
                        <th class="admin-table-cell">Phương thức giao hàng</th>
                        <th class="admin-table-cell">Thông tin nhận hàng</th>
                        <th class="admin-table-cell">
                            <div>Hãng vận chuyển<span class="tips">(Dịch vụ)</span></div>
                            <div class="tips">Mã vận đơn trên</div>
                        </th>
                        <th class="admin-table-cell">Trạng thái vận chuyển OneShip</th>
                        <th class="admin-table-cell">Thời gian tạo</th>
                        <th class="admin-table-cell" style="text-align: right;">Ghi chú đơn
                            hàng</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="admin-table-body" v-if="orders && orders.length">
            <div>
                <div class="d-flex custom-row" v-for="item in orders">
                    {{-- <div class="variable-cell variable-cell-fix-left" style="width: 44px; left: 0px;">
                        <span>
                            <label class="checkbox-custom mb-0" for="a1">
                                <span class="checkbox-custom-input">
                                    <input type="checkbox" class="d-none" value="" id="a1" />
                                    <span class="checkbox-custom-icon"></span>
                                </span>
                            </label>
                        </span>
                    </div> --}}
                    <div class="variable-cell variable-cell-fix-left" style="width: 200px;">
                        <div class="d-flex align-items-center">
                            <div class="order-id color-15bbb9 h-20 lh-20 mr-1" v-text="item.code"></div>
                            <span role="img" tabindex="-1" class="icon-svg smm ">
                                <svg viewBox="0 0 14 15" class="color-748399" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                                    class="">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M2.99952 3.0251C2.87354 3.0251 2.75272 3.07514 2.66364 3.16422C2.57456 3.2533 2.52452 3.37412 2.52452 3.5001V8.0001C2.52452 8.12607 2.57456 8.24689 2.66364 8.33597C2.75272 8.42505 2.87354 8.4751 2.99952 8.4751H3.49952C3.78947 8.4751 4.02452 8.71015 4.02452 9.0001C4.02452 9.29005 3.78947 9.5251 3.49952 9.5251H2.99952C2.59506 9.5251 2.20717 9.36443 1.92118 9.07843C1.63519 8.79244 1.47452 8.40455 1.47452 8.0001V3.5001C1.47452 3.09564 1.63519 2.70775 1.92118 2.42176C2.20717 2.13577 2.59506 1.9751 2.99952 1.9751H7.49952C7.90397 1.9751 8.29186 2.13577 8.57785 2.42176C8.86385 2.70775 9.02452 3.09564 9.02452 3.5001V4.0001C9.02452 4.29005 8.78947 4.5251 8.49952 4.5251C8.20957 4.5251 7.97452 4.29005 7.97452 4.0001V3.5001C7.97452 3.37412 7.92447 3.2533 7.83539 3.16422C7.74631 3.07514 7.62549 3.0251 7.49952 3.0251H2.99952ZM6.49952 6.5251C6.23718 6.5251 6.02452 6.73776 6.02452 7.0001V11.5001C6.02452 11.7624 6.23718 11.9751 6.49952 11.9751H10.9995C11.2619 11.9751 11.4745 11.7624 11.4745 11.5001V7.0001C11.4745 6.73776 11.2619 6.5251 10.9995 6.5251H6.49952ZM4.97452 7.0001C4.97452 6.15786 5.65728 5.4751 6.49952 5.4751H10.9995C11.8418 5.4751 12.5245 6.15786 12.5245 7.0001V11.5001C12.5245 12.3423 11.8418 13.0251 10.9995 13.0251H6.49952C5.65728 13.0251 4.97452 12.3423 4.97452 11.5001V7.0001Z">
                                    </path>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="variable-cell" style="width: 200px;">
                        <div>
                            <div class="d-flex align-items-center flex-wrap">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                    viewBox="0 0 26 26" fill="none" style="font-size: 18px; width: 16px;">
                                    <path
                                        d="M22.3 25.5H3.19995C1.39995 25.5 0 24.1 0 22.3V3.19995C0 1.39995 1.39995 0 3.19995 0H22.3C24.1 0 25.5 1.39995 25.5 3.19995V22.3C25.5 24.1 24.1 25.5 22.3 25.5Z"
                                        fill="#02C9C4"></path>
                                    <path
                                        d="M12.9001 20.7001C10.7001 20.7001 8.60012 19.9001 7.00012 18.6001L6.6001 18.3001L8.6001 16.1001L8.90015 16.3001C9.90015 17.0001 11.1001 17.6001 12.9001 17.6001C13.7001 17.6001 16.0001 17.3001 16.0001 15.9001C16.0001 15.0001 14.8001 14.6001 12.7001 14.1001C10.1001 13.5001 6.80017 12.7001 6.80017 9.1001C6.80017 6.4001 9.30017 4.6001 13.3002 4.6001C15.6002 4.6001 17.3001 5.40009 18.1001 5.90009L18.5001 6.1001L17.1001 8.80011L16.7001 8.50012C15.7001 7.90012 14.5002 7.50012 13.3002 7.50012C11.7002 7.50012 9.90015 7.90012 9.90015 9.00012C9.90015 10.1001 11.2002 10.5001 13.3002 10.9001C15.9002 11.5001 19.1001 12.1001 19.1001 15.7001C19.0001 19.0001 16.7001 20.7001 12.9001 20.7001Z"
                                        fill="#00112F"></path>
                                </svg>
                                <p class="mb-0">Tạo thủ công</p>
                            </div>
                        </div>
                    </div>
                    <div class="variable-cell" style="width: 150px;">
                        <div>
                            <p class="d-block mb-0 w-100 color-748399">-</p>
                            <p class="d-block mb-0 w-100 color-748399" v-text="item.statusText"></p>
                            <p class="d-block mb-0 w-100 color-748399">-</p>
                        </div>
                    </div>
                    <div class="variable-cell" style="width: 230px;">
                        <div>
                            <p class="d-block mb-0 w-100 color-748399 text-12">
                                VN-đống đa-Thu Do Ha Noi
                            </p>
                        </div>
                    </div>
                    <div class="variable-cell" style="width: 300px;">
                        <div>
                            <p class="d-block mb-0 w-100 text-14 text-black">
                                name
                            </p>
                            <p class="d-block mb-0 w-100 color-748399 text-12">
                                VN-Tỉnh Bến Tre-Huyện Mỏ Cày Nam
                            </p>
                        </div>
                    </div>
                    <div class="variable-cell" style="width: 160px;">
                        <div>
                            <p class="d-block mb-0 w-100 color-748399 text-12">
                                Phương thức giao hàng
                            </p>
                        </div>
                    </div>
                    <div class="variable-cell" style="width: 180px;">
                        <div>
                            <p class="d-block mb-0 w-100 color-748399 text-12">
                                Tự gửi hàng
                            </p>
                        </div>
                    </div>
                    <div class="variable-cell" style="width: 280px;">
                        <div class="d-flex align-items-center flex-wrap" style="row-gap: 0px;">
                            <img class="img-fluid mr-2" :src="item.shipping_image" width="50" />
                            <div v-text="item.shipping_title"></div>
                        </div>
                    </div>
                    <div class="variable-cell" style="width: 155px;">
                        <span class="admin-tag admin-tag-waiting">Đợi xử lý</span>
                    </div>
                    <div class="variable-cell" style="width: 120px;">
                        <span class="color-748399" v-text="item.created_at"></span>
                    </div>
                    <div class="variable-cell" style="width: 80px;">
                        <span class="color-748399" v-text="item.note"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-3">
        <div class="d-flex align-items-center justify-content-end">
            <ul class=" custom-paging">
                <li class="paging-prev disabled">
                    <a href="javascript:;">
                        <span role="img" aria-label="left" class="icon-svg small">
                            <svg viewBox="64 64 896 896" focusable="false" data-icon="left" width="1em"
                                height="1em" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 000 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z">
                                </path>
                            </svg>
                        </span>
                    </a>
                </li>
                <li title="1" class="item-paging active" tabindex="0"><a rel="nofollow">1</a></li>
                <li class="paging-next disabled">
                    <a href="javascript:;">
                        <span role="img" aria-label="right" class="icon-svg small">
                            <svg viewBox="64 64 896 896" focusable="false" data-icon="right" width="1em"
                                height="1em" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M765.7 486.8L314.9 134.7A7.97 7.97 0 00302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 000-50.4z">
                                </path>
                            </svg>
                        </span>
                    </a>
                </li>
                <li class="ant-pagination-options">

                </li>
            </ul>

        </div>
    </div>
</div>
