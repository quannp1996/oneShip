<div class="admin-card bg-transparent">
    <div class=" d-flex align-items-center justify-content-end py-3">
        <a href="{{ route('web_orders_index') }}" class="btn-themes nocolor-btn mr-2">
            Hủy
        </a>
        <button class="btn-themes color-btn" @click="gotoStep(steps[(currentStep + 1)])" type="button">
            Tiếp tục
        </button>
    </div>
</div>
