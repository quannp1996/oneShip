<div class="tab-pane" id="image">
    <div class="tabbable">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="image">Ảnh Sưu tập</label>
                    <input type="file" id="images" name="images[]" multiple class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}">
                    @if ($data && $data->images)
                        <div class="mt-2">
                            @foreach (json_decode($data->images) AS $image)
                                <div class="pull-right">
                                    <img src="{{ ImageURL::getImageUrl($image, 'staticpage', '') }}" width="100" />
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="old_images" value="{{ $data->images }}">
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="image">Ảnh SEO</label>
                    <input type="file" id="image_seo" name="image_seo" multiple class="form-control{{ $errors->has('image_seo') ? ' is-invalid' : '' }}">
                    @if ($data && $data->image_seo)
                        <div class="pull-right">
                            <img src="{{ ImageURL::getImageUrl($data->image_seo, 'staticpage', '') }}" width="100" />
                        </div>
                        <input type="hidden" name="old_seo" value="{{ $data->image_seo }}">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>