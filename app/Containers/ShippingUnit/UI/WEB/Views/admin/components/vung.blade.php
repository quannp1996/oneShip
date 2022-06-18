<div class="card card-accent-primary">
    <div class="card-header">
        <i class="fa fa-server"></i>
        Phụ phí vùng miền
        <br>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="vung_vung_1">Vùng 1</label> 
            <input type="number" name="vung[vung_1]" value="{{ @$data->vung['vung_1'] }}"
                id="vung_vung_1" placeholder="50000" class="form-control">
        </div>
        <div class="form-group">
            <label for="vung_vung_2">Vùng 2</label> 
            <input type="number" name="vung[vung_2]" value="{{ @$data->vung['vung_2'] }}"
                id="vung_vung_2" placeholder="50000" class="form-control">
        </div>
        <div class="form-group">
            <label for="vung_vung_3">Vùng 3</label> 
            <input type="number" name="vung[vung_3]" value="{{ @$data->vung['vung_3'] }}"
                id="vung_vung_3" placeholder="50000" class="form-control">
        </div>
    </div>
</div>
