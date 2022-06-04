<div class="tab-pane active" id="image">
    <div class="tabbable">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="image">{{ $imgTittle ?? 'Hình ảnh' }}</label>
                    <input type="file" id="image" name="image" accept="image/*"
                           class="form-control pt-1 {{ $errors->has('image') ? 'is-invalid' : '' }}">
                    @if(!empty($data->image))
                        <div class="holderImg mt-2">
                            <img width="100" class="oldImg img-thumbnail" src="{{ $data->getImageUrl('small') }}">

                            <input type="hidden" name="delete_image" class="delete_image">
                            <a class="btn-danger btn-sm ml-3 mt-0 text-decoration-none"
                               href="javascript:void(0)"
                               onclick="$(this).closest('.holderImg').find('.delete_image').val('1');$(this).closest('.holderImg').find('.oldImg').remove();$(this).remove();"
                               title="Xóa ảnh"><i class="fa fa-trash"></i> {{__('Xóa')}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
