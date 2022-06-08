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
                        <input type="text" class="form-control" v-model="receiver.fullname" name="receiver[fullname]" id="receiverFullname">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverPhone required">Số điện thoại</label>
                        <input type="text" class="form-control" v-model="receiver.phone" name="receiver[phone]" id="receiverPhone">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverEmail">Email</label>
                        <input type="text" class="form-control" v-model="receiver.email" name="receiver[email]" id="senderEmail">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverCity required">Tỉnh/ Thành phố</label>
                        <select class="form-control select2customer" @change="changeCity('receiver')" v-model="receiver.city" name="receiver[city]" id="receiverCity">
                            <option value="0">-- Chọn ---</option>
                            <option :value="city.id" v-for="city in cities" v-text="city.name"></option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverDistrict required">Quận/ Huyện</label>
                        <select class="form-control select2customer" @change="changeDistrict('receiver')" v-model="receiver.district" name="receiver[district]" id="receiverDistrict">
                            <option value="0">-- Chọn ---</option>
                            <option :value="district.id" v-for="district in districts.receiver" v-text="district.name"></option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverWard required">Thôn/ Xóm</label>
                        <select class="form-control select2customer" name="receiver[ward]" v-model="receiver.ward" id="receiverWard">
                            <option value="0">-- Chọn ---</option>
                            <option :value="ward.id" v-for="ward in wards.receiver" v-text="ward.name"></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverZipcode">Mã zip code</label>
                        <input type="text" name="receiver[zipcode]" v-model="receiver.zipcode" class="form-control" id="receiverZipcode">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverAddress1 required">Địa chỉ 1</label>
                        <input type="text" name="receiver[address1]" v-model="receiver.address1" class="form-control" id="receiverAddress1">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="receiverAddress2">Địa chỉ 2</label>
                        <input type="text" name="receiver[address2]" v-model="receiver.address2" class="form-control" id="receiverAddress2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
