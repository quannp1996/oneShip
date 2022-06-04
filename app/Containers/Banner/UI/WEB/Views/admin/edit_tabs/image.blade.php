<div class="tab-pane" id="image">
    <div class="tabbable">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="image">Ảnh đại diện</label>
                    <input type="file" id="image" name="image"
                           class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}">
                                            
                    <div class="mt-2">
                        @if(!empty(@$data->desc->image))
                            <div class="pull-right">
                                <input type="hidden" id="old_image" name="old_image" value="{{ $data->desc->image }}">   
                                <img id="images" src="{{ $data->desc->getImageUrl('slide') }}" width="400"/>
                                <button type="button" id="delete-image-image" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>