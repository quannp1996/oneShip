<div class="card">
    <div class="card-header p-2" id="headingThree">
        <p class="btn btn-link collapsed m-0" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
            aria-controls="collapseThree">
            <i class="fa fa-list"></i>
            Thông tin sản phẩm và kiện hàng
        </p>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
        <div class="card-body">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>Mã sản phẩm <br> <small>(Không bắt buộc)</small></th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in packages">
                        <th>
                            <input type="text" v-model="item.code" :name="'package[item][' + index + '][product_code]'"
                                class="form-control">
                        </th>
                        <td>
                            <input type="text" v-model="item.product" :name="'package[item][' + index + '][product_name]'"
                                class="form-control">
                        </td>
                        <td>
                            <input type="text" v-model="item.quanlity"
                                :name="'package[item][' + index + '][product_quanlity]'" class="form-control">
                        </td>
                        <td>
                            <div class="input-group">
                                <input v-model="item.price" type="text" :name="'package[item][' + index + '][price]'"
                                    class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">VNĐ</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-link" @click="removePackage(index)" type="button">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <div class="text-center">
                                <button type="button" @click="addNewPackge()" class="btn btn-secondary">
                                    <i class="fa fa-plus"></i>
                                    Thêm vào
                                </button>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="row">
                <div class="col-4">
                    <div class="input-group">
                        <label for="packageWeight">Trọng lượng kiện hàng</label>
                            <div class="input-group">
                            <input type="text" class="form-control" v-model="package.weight">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">Kg</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="packageRefcode">Số tham chiếu</label>
                        <input type="text" v-model="package.ref_code" class="form-control" name="package[ref_code]"
                            id="packageRefcode">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="packageNote">Ghi chú</label>
                        <input type="text" v-model="package.note" class="form-control" name="package[note]"
                            id="packageNote">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
