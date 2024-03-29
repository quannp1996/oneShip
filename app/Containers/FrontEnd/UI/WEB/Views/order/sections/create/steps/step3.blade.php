<div class="admin-card">
    <div class="admin-card-body p-0">
        {{-- <div class="admin-card-head py-3">
            <span class="search-input mb-3">
                <input placeholder="Lục soát hậu cần" class="admin-form-input" type="text" value="" />
                <span class="icon-svg">
                    <span role="img" tabindex="-1" class="anticon searchBtn-fXszSa">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.28525 4.32178C6.54355 4.32178 4.32097 6.54436 4.32097 9.28606C4.32097 12.0278 6.54355 14.2503 9.28525 14.2503C10.6218 14.2503 11.835 13.7222 12.7274 12.8632C12.7467 12.8383 12.7678 12.8143 12.7906 12.7914C12.8135 12.7686 12.8375 12.7475 12.8624 12.7282C13.7214 11.8358 14.2495 10.6226 14.2495 9.28606C14.2495 6.54436 12.027 4.32178 9.28525 4.32178ZM14.3558 13.296C15.2285 12.194 15.7495 10.8009 15.7495 9.28606C15.7495 5.71594 12.8554 2.82178 9.28525 2.82178C5.71513 2.82178 2.82097 5.71594 2.82097 9.28606C2.82097 12.8562 5.71513 15.7503 9.28525 15.7503C10.8001 15.7503 12.1932 15.2293 13.2952 14.3566L15.8978 16.9592C16.1907 17.2521 16.6655 17.2521 16.9584 16.9592C17.2513 16.6664 17.2513 16.1915 16.9584 15.8986L14.3558 13.296Z"
                                fill="#415066"></path>
                        </svg>
                    </span>
                </span>
            </span>
            <div class="d-flex align-items-center">
                <label class="checkbox-custom">
                    <span class="checkbox-custom-name">Lọc : </span>
                    <span class="checkbox-custom-input">
                        <input type="checkbox" class="d-none" value="" />
                        <span class="checkbox-custom-icon"></span>
                    </span>
                    <span class="checkbox-custom-name">Khoản tiền thu hộ của đơn hàng COD </span>

                </label>
            </div>
        </div> --}}
        <div class="admin-card-body">
            <div class="admin-table">
                <div class="admin-table-container" style="overflow: auto scroll; max-height: 320px;">
                    <table style="table-layout: auto;">
                        <colgroup>
                            <col style="width: 101.312px;" />
                            <col style="width: 300.172px;" />
                            <col style="width: 189.984px;" />
                            <col style="width: 189.984px;" />
                            <col style="width: 151.984px;" />
                            <col style="width: 101.312px;" />
                            <col style="width: 111.25px;" />
                            <col style="width: 6px;" />
                        </colgroup>
                        <thead class="admin-table-thead">
                            <tr>
                                <th class="admin-table-cell">Số sê-ri</th>
                                <th class="admin-table-cell">Dịch vụ</th>
                                <th class="admin-table-cell">Hình thức lấy hàng</th>
                                <th class="admin-table-cell">Dich vụ giá trị gia tăng</th>
                                <th class="admin-table-cell" style="text-align: center;">Thời gian giao hàng</th>
                                <th class="admin-table-cell" style="text-align: right;">Phí vận chuyển</th>
                                <th class="admin-table-cell"></th>
                            </tr>
                        </thead>
                        <tbody class="admin-table-tbody">
                            <tr class="admin-table-row" v-for="(item, index) in listShipping">
                                <td class="admin-table-cell text-center" v-text="(index + 1)"></td>
                                <td class="admin-table-cell">
                                    <div class="d-flex align-items-center flex-wrap" style="row-gap: 0px;">
                                        <img class=" mr-2 img-fluid" :src="item.image" width="50" />
                                        <div v-text="item.title"></div>
                                    </div>
                                </td>
                                <td class="admin-table-cell">
                                    <div class="ant-row pickMethodRow-XO+K6h" style="row-gap: 0px;">
                                        <div class="d-flex align-items-start py-1 color-415066">
                                            <svg class="icon-svg color-415066" focusable="false" viewBox="0 0 18 18"
                                                aria-hidden="true">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M1.63366 5.79205C1.68822 5.25055 1.98155 4.71046 2.61746 4.34332C3.25336 3.97618 3.86776 3.9922 4.36399 4.21569C4.82155 4.42177 5.13469 4.78187 5.29584 5.06099L9.18109 11.7904C10.0764 11.5503 11.0396 11.8084 11.6949 12.464L15.3623 10.3466C15.6852 10.1602 16.098 10.2708 16.2844 10.5937C16.4708 10.9165 16.3602 11.3294 16.0373 11.5157L12.3699 13.6331C12.6677 14.7437 12.199 15.9587 11.1559 16.5609C9.91065 17.2799 8.31833 16.8532 7.59937 15.608C6.99714 14.5649 7.19873 13.2783 8.01196 12.4654L4.12671 5.73599C4.07357 5.64396 3.95394 5.51161 3.8096 5.44661C3.70394 5.39902 3.54732 5.36531 3.29246 5.51245C3.03759 5.6596 2.98848 5.81209 2.97686 5.92739C2.96099 6.08489 3.01578 6.25467 3.06892 6.3467C3.25532 6.66955 3.1447 7.08237 2.82185 7.26877C2.499 7.45517 2.08618 7.34455 1.89979 7.0217C1.73863 6.74258 1.58335 6.29134 1.63366 5.79205ZM9.22735 13.2206C8.62777 13.5667 8.42234 14.3334 8.76851 14.933C9.11467 15.5325 9.88134 15.738 10.4809 15.3918C11.0805 15.0456 11.2859 14.279 10.9398 13.6794C10.5936 13.0798 9.82692 12.8744 9.22735 13.2206Z">
                                                </path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M6.61411 4.42632C6.28591 3.92186 6.44804 3.24531 6.96924 2.9444L9.93755 1.23064C10.421 0.95154 11.0383 1.09947 11.3427 1.56737L15.3209 7.68218C15.6491 8.18664 15.4869 8.86319 14.9657 9.1641L11.9974 10.8779C11.514 11.157 10.8967 11.009 10.5923 10.5411L6.61411 4.42632ZM7.91825 3.95534L9.37489 6.19432L11.8228 4.78099L10.3662 2.54201L7.91825 3.95534ZM12.5601 5.91419L10.1121 7.32752L11.5688 9.5665L14.0167 8.15316L12.5601 5.91419Z">
                                                </path>
                                            </svg>
                                            <span>Tự gửi hàng</span>
                                        </div>
                                        <div class="d-flex align-items-start py-1 color-415066">
                                            <svg class="icon-svg color-415066" focusable="false" viewBox="0 0 18 18"
                                                aria-hidden="true">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M16.0503 4.04487C16.0503 3.25787 15.4123 2.61987 14.6253 2.61987H7.07981C6.29281 2.61987 5.65481 3.25787 5.65481 4.04487V5.1003H4.55711C4.34934 5.1003 4.15314 5.19599 4.02521 5.35971L2.0934 7.83221C2.00067 7.95089 1.95029 8.09718 1.95029 8.2478V12.8273C1.95029 13.2001 2.2525 13.5023 2.62529 13.5023C2.99809 13.5023 3.30029 13.2001 3.30029 12.8273V8.48022L4.88632 6.4503H6.32981C6.70261 6.4503 7.00481 6.14809 7.00481 5.7753V4.04487C7.00481 4.00345 7.03839 3.96987 7.07981 3.96987H14.6253C14.6667 3.96987 14.7003 4.00345 14.7003 4.04487V12.8273C14.7003 13.2001 15.0025 13.5023 15.3753 13.5023C15.7481 13.5023 16.0503 13.2001 16.0503 12.8273V4.04487ZM6.14578 7.19565C5.77299 7.19565 5.47078 7.49785 5.47078 7.87065V8.23388H5.09188C4.71909 8.23388 4.41688 8.53608 4.41688 8.90888C4.41688 9.28167 4.71909 9.58388 5.09188 9.58388H6.14578C6.51858 9.58388 6.82078 9.28167 6.82078 8.90888V7.87065C6.82078 7.49785 6.51858 7.19565 6.14578 7.19565ZM12.4503 13.3913C12.4503 13.0384 12.1642 12.7523 11.8113 12.7523C11.4585 12.7523 11.1724 13.0384 11.1724 13.3913C11.1724 13.7442 11.4585 14.0302 11.8113 14.0302C12.1642 14.0302 12.4503 13.7442 12.4503 13.3913ZM11.8113 11.4023C12.9098 11.4023 13.8003 12.2928 13.8003 13.3913C13.8003 14.4898 12.9098 15.3802 11.8113 15.3802C10.9518 15.3802 10.2196 14.835 9.94173 14.0714H8.09405C7.81622 14.835 7.08401 15.3802 6.22443 15.3802C5.12597 15.3802 4.23548 14.4898 4.23548 13.3913C4.23548 12.2928 5.12597 11.4023 6.22443 11.4023C7.08786 11.4023 7.82279 11.9525 8.09776 12.7214H9.93801C10.213 11.9525 10.9479 11.4023 11.8113 11.4023ZM6.85779 13.4762C6.85471 13.45 6.85312 13.4234 6.85312 13.3964C6.85312 13.3676 6.85493 13.3393 6.85843 13.3114C6.81911 12.9962 6.55025 12.7523 6.22443 12.7523C5.87155 12.7523 5.58548 13.0384 5.58548 13.3913C5.58548 13.7442 5.87155 14.0302 6.22443 14.0302C6.54853 14.0302 6.81626 13.7889 6.85779 13.4762Z"
                                                    fill="#748399"></path>
                                            </svg>
                                            <span>Lấy hàng</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="admin-table-cell">
                                    <div class="ant-row pickMethodRow-XO+K6h" style="row-gap: 0px;">
                                        <div class="d-flex align-items-center py-1 color-415066 text-12">
                                            <svg class="icon-svg color-415066 mr-2" focusable="false"
                                                viewBox="0 0 18 18" aria-hidden="true">
                                                <g clip-path="url(#clip0_2441_2780)" class="icon-YcU+DJ">
                                                    <circle cx="9.5" cy="9" r="9" fill="#748399">
                                                    </circle>
                                                    <path
                                                        d="M13.9435 6.93911C13.9434 6.77537 13.8976 6.6149 13.8114 6.47574C13.7251 6.33659 13.6018 6.22426 13.4552 6.1514L9.93601 4.39114C9.81435 4.33067 9.68035 4.29919 9.5445 4.29919C9.40865 4.29919 9.27465 4.33067 9.15299 4.39114L5.63382 6.1514C5.48724 6.22426 5.36388 6.33659 5.27762 6.47574C5.19136 6.6149 5.14562 6.77537 5.14553 6.93911V11.1285C5.14439 11.2925 5.18909 11.4536 5.27459 11.5936C5.36009 11.7335 5.48299 11.8468 5.62942 11.9206L9.1486 13.6809C9.27082 13.7421 9.40562 13.7739 9.5423 13.7739C9.67898 13.7739 9.81378 13.7421 9.93601 13.6809M5.2863 6.46384L9.5445 8.59375M9.5445 8.59375L13.8027 6.46384M9.5445 8.59375L9.5445 13.7689"
                                                        stroke="white" stroke-width="1.2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M13.1624 14.4506C12.9941 14.4506 12.8787 14.4159 12.8162 14.3464C12.7585 14.2769 12.7296 14.1749 12.7296 14.0402V13.7145C12.5902 13.7015 12.4435 13.6711 12.2896 13.6233C12.1358 13.5756 12.0035 13.5256 11.8929 13.4735C11.7727 13.417 11.6742 13.3541 11.5972 13.2846C11.5203 13.2107 11.465 13.1369 11.4313 13.0631C11.3977 12.9849 11.3809 12.9133 11.3809 12.8481C11.3857 12.7786 11.4073 12.72 11.4458 12.6722C11.5131 12.5767 11.5924 12.5246 11.6838 12.5159C11.78 12.5029 11.8689 12.5202 11.9506 12.568C12.0372 12.6201 12.1141 12.6657 12.1815 12.7048C12.2536 12.7439 12.3185 12.7786 12.3762 12.809C12.4387 12.8351 12.4964 12.8611 12.5493 12.8872C12.607 12.9089 12.6671 12.9306 12.7296 12.9523V11.4801C12.5757 11.428 12.4291 11.365 12.2896 11.2912C12.155 11.2174 12.0348 11.1305 11.929 11.0306C11.828 10.9264 11.7463 10.8091 11.6838 10.6788C11.6261 10.5486 11.5972 10.3987 11.5972 10.2294C11.5972 10.0643 11.6261 9.9145 11.6838 9.77987C11.7463 9.64524 11.828 9.52798 11.929 9.42809C12.0348 9.32821 12.155 9.24569 12.2896 9.18055C12.4291 9.11106 12.5757 9.05895 12.7296 9.0242V8.77666C12.7296 8.63334 12.7633 8.52911 12.8306 8.46397C12.8979 8.39448 13.0085 8.35974 13.1624 8.35974C13.3162 8.35974 13.4292 8.39014 13.5013 8.45094C13.5735 8.51174 13.6095 8.61814 13.6095 8.77014V9.01769C13.648 9.02637 13.6889 9.03723 13.7321 9.05026C13.7754 9.05895 13.8163 9.06763 13.8548 9.07632C13.999 9.11975 14.124 9.17403 14.2298 9.23918C14.3404 9.30432 14.427 9.37381 14.4895 9.44764C14.5568 9.52146 14.5977 9.59964 14.6121 9.68215C14.6313 9.76032 14.6169 9.83415 14.5688 9.90364C14.5351 9.95141 14.4919 9.9905 14.439 10.0209C14.3909 10.047 14.338 10.0665 14.2803 10.0795C14.2274 10.0882 14.1745 10.0882 14.1216 10.0795C14.0687 10.0708 14.0255 10.0535 13.9918 10.0274C13.9437 9.99267 13.886 9.95792 13.8187 9.92318C13.7514 9.8841 13.6817 9.84718 13.6095 9.81244V10.9915C13.7009 11.0263 13.785 11.0632 13.862 11.1023C13.9437 11.1414 14.0182 11.1783 14.0856 11.213C14.3308 11.3433 14.5063 11.4888 14.6121 11.6495C14.7227 11.8102 14.7732 12.0143 14.7635 12.2618C14.7539 12.6961 14.6049 13.0435 14.3164 13.3041C14.1385 13.4648 13.9028 13.5777 13.6095 13.6429V14.0337C13.6095 14.1727 13.5759 14.2769 13.5086 14.3464C13.446 14.4159 13.3306 14.4506 13.1624 14.4506ZM13.9918 12.3115C13.9918 12.1639 13.786 11.897 13.6095 11.897V12.7765C13.7495 12.7587 13.8187 12.7048 13.9485 12.533C13.9774 12.4549 13.9918 12.381 13.9918 12.3115ZM12.4845 10.2037C12.4845 10.3692 12.5596 10.4775 12.7296 10.5681V9.89061C12.5952 9.95807 12.4845 10.0345 12.4845 10.2037Z"
                                                        fill="white"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_2441_2780">
                                                        <rect width="18" height="18" fill="white"
                                                            transform="translate(0.5)"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            <span>Khoản thanh toán thu hộ của đơn hàng COD</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="admin-table-cell" style="text-align: center;" v-text="item.time_pickup"></td>
                                <td class="admin-table-cell" style="text-align: right;"><span
                                        class="color-415066">VND</span> @{{ item.fee }}</td>
                                <td class="admin-table-cell">
                                    <button type="button" @click="pickShipping(item)" class="btn-themes nocolor-btn">
                                        <span v-if="selectedShipping == item.id">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <span v-else>
                                            Đặt
                                        </span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="admin-card">
            <div class="admin-card-body p-0">
                <div class="admin-card-head py-3">
                    <div class="title">
                        Cài đặt vận chuyển
                    </div>
                </div>
                <div class="admin-card-body" v-if="shipping.selectedShipping">
                    <div class="admin-card-row">
                        <div class="col-5 mb-5">
                            <div class="admin-form-item-label">
                                <label for="sender_city" title="sender_city" class="admin-form-item-required">
                                    Khoản tiền thu hộ của đơn hàng COD
                                </label>
                                <span class="price-box-wrap">
                                    <div class="priceinput">
                                        <span class="price-input">
                                            <input placeholder="" v-model="shipping.cod" type="text" class="admin-form-input">
                                        </span>
                                    </div>
                                    <div class="pricesuggest">
                                        VND
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="admin-card-row"
                        v-if="shipping.selectedShipping.services && shipping.selectedShipping.services.length">
                        <div class="col-5 mb-5">
                            <div class="admin-form-item-label">
                                <label for="sender_city" title="sender_city" class="admin-form-item-required">
                                    Dịch vụ
                                </label>
                                <span class="price-box-wrap" v-for="item in shipping.selectedShipping.services">
                                    <div class="form-check">
                                        <input class="form-check-input" v-model="shipping.services" type="checkbox"
                                            :value="item.id" :id="'flexCheckDefault' + item.id">
                                        <label class="form-check-label" :for="'flexCheckDefault' + item.id"
                                            v-text="item.name"></label>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
