<div class="d-flex justify-content-between mt-20">
    <div class="title font-weight-bold lh-32 d-flex align-items-center text-24">
        <button type="button" class="btn-themes btn-icons" @click="cancel()">
            <span class="icon-svg">
                <span role="img" aria-label="arrow-left">
                    <svg viewBox="64 64 896 896" focusable="false" data-icon="arrow-left" width="1em" height="1em"
                        fill="currentColor" aria-hidden="true">
                        <path
                            d="M872 474H286.9l350.2-304c5.6-4.9 2.2-14-5.2-14h-88.5c-3.9 0-7.6 1.4-10.5 3.9L155 487.8a31.96 31.96 0 000 48.3L535.1 866c1.5 1.3 3.3 2 5.2 2h91.5c7.4 0 10.8-9.2 5.2-14L286.9 550H872c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z">
                        </path>
                    </svg>
                </span>
            </span>
        </button>
        Tạo đơn hàng
    </div>
</div>
<div class="admin-steps">
    <div class="admin-steps-item admin-steps-item-finish">
        <div class="admin-steps-item-container">
            <div class="admin-steps-item-icon"><span
                    :class="currentStep > 0 ? 'admin-steps-finished-icon' : 'admin-steps-icon'"
                    v-text="currentStep > 0 ? '' : '1'"></span></div>
            <div class="admin-steps-item-content">
                <div class="admin-steps-item-title">Nhận hàng và giao hàng</div>
            </div>
        </div>
    </div>
    <div class="admin-steps-item admin-steps-item-finish one-step">
        <div class="admin-steps-item-container">
            <div class="admin-steps-item-icon">
                <span :class="currentStep > 1 ? 'admin-steps-finished-icon' : 'admin-steps-icon'"
                    v-text="currentStep > 1 ? '' : '2'"></span>
            </div>
            <div class="admin-steps-item-content">
                <div class="admin-steps-item-title">Thông tin sản phẩm và kiện hàng</div>
            </div>
        </div>
    </div>
    <div class="admin-steps-item admin-steps-item-active one-step">
        <div class="admin-steps-item-container">
            <div class="admin-steps-item-icon">
                <span :class="currentStep > 2 ? 'admin-steps-finished-icon' : 'admin-steps-icon'"
                    v-text="currentStep > 2 ? '' : '3'"></span>
            </div>
            <div class="admin-steps-item-content">
                <div class="admin-steps-item-title">Lựa chọn đơn vị vận chuyển và giao hàng</div>
            </div>
        </div>
    </div>
</div>
