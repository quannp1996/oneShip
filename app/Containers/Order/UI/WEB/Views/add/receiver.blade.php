<div class="card">
    <div class="card-header p-2" id="headingTwo">
        <p class="btn btn-link m-0" data-toggle="collapse" data-target="#addressReceiver" aria-expanded="false"
            aria-controls="collapseOne">
            <i class="fa fa-truck"></i>
            Địa chỉ người nhận
        </p>
    </div>
    <div id="addressReceiver" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverFullname required">Họ tên</label>
                        <input type="text" class="form-control" name="receiver[fullname]" id="receiverFullname">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverPhone required">Số điện thoại</label>
                        <input type="text" class="form-control" name="receiver[phone]" id="receiverPhone">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverEmail">Email</label>
                        <input type="text" class="form-control" name="receiver[email]" id="senderEmail">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="asdas required">Tỉnh/ Thành phố</label>
                        <select class="form-control select2customer" name="asdsa" id="asdas">
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverDistrict required">Quận/ Huyện</label>
                        <select class="form-control select2customer" name="receiver[district]" id="receiverDistrict">
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverWard required">Thôn/ Xóm</label>
                        <select class="form-control select2customer" name="receiver[ward]" id="receiverWard">
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverZipcode">Mã zip code</label>
                        <input type="text" name="receiver[zipcode]" class="form-control" id="receiverZipcode">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverAddress1 required">Địa chỉ 1</label>
                        <input type="text" name="receiver[address1]" class="form-control" id="receiverAddress1">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverAddress2">Địa chỉ 2</label>
                        <input type="text" name="receiver[address2]" class="form-control" id="receiverAddress2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
