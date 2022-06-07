<div class="card">
    <div class="card-header p-2" id="headingOne">
        <p class="btn btn-link m-0" data-toggle="collapse" data-target="#addressSender" aria-expanded="true"
            aria-controls="collapseOne">
            <i class="fa fa-send-o"></i>
            Địa chỉ người gửi
        </p>
    </div>
    <div id="addressSender" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="sendFullname required">Họ tên</label>
                        <input type="text" class="form-control" name="sender[fullname]" id="sendFullname">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="senderPhone">Số điện thoại</label>
                        <input type="text" class="form-control" name="sender[phone]" id="senderPhone">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="userID">Email</label>
                        <input type="text" class="form-control" name="sender[email]" id="senderEmail">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="sendCity required">Tỉnh/ Thành phố</label>
                        <select class="form-control select2customer" name="sender[city]" id="sendCity"></select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="sendDistrict required">Quận/ Huyện</label>
                        <select class="form-control select2customer" name="sender[district]" id="sendDistrict"></select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="sendWard required">Thôn/ Xóm</label>
                        <select class="form-control select2customer" name="sender[ward]" id="sendWard"></select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="sendZipcode">Mã zip code</label>
                        <input type="text" class="form-control" name="sender[zipcode]" id="sendZipcode">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="sendAddress1 required">Địa chỉ 1</label>
                        <input type="text" name="sender[address1]" class="form-control" id="sendAddress1">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="sendAddress2">Địa chỉ 2</label>
                        <input type="text" name="sender[address2]" class="form-control" id="sendAddress2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
