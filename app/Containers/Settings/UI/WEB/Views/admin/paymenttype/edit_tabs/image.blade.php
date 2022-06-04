<div class="tab-pane" id="image">
    <div class="tabbable">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="image">Ảnh đại diện</label>
                    <input type="file" id="image" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}">
                    <div class="mt-2">
                        @if(!empty(@$data->desc->image))
                            <div class="pull-right">
                                <img src="{{ $data->desc->getImageUrl('slide') }}" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>