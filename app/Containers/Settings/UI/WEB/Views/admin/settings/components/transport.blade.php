<div class="tab-pane" id="transport" role="tabpanel" aria-expanded="true">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="type">Gửi đơn hàng luôn</label>
                <label class="c-switch c-switch-label c-switch-primary m-0 align-middle">
                    <input type="hidden" name="transport[auto_send]" value="0">
                    <input type="checkbox" id="switchViewType" name="transport[auto_send]" value="1" {{ (int) @$data['transport']['auto_send'] == 1 ? 'checked' : ''}} class="c-switch-input">
                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                </label>
            </div>
        </div>
    </div>
</div>
