<div class="card card-accent-primary">
    <div class="card-header card-accent-warning" id="headingTwo">
        Ảnh
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="image">Icon</label>
                    <input type="file" id="icon" name="icon"
                        class="form-control{{ $errors->has('icon') ? ' is-invalid' : '' }}">
                    <div class="mt-2">
                        @if (!empty(@$data->icon))
                            <div class="pull-right">
                                <img src="{{ \ImageURL::getImageUrl($data->icon,'menu','small') }}" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
