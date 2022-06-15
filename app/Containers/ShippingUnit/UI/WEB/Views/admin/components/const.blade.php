<div class="card card-accent-primary">
    <div class="card-header">
        <div class="row">
            <div class="col-4">
                <i class="fa fa-opencart"></i>
                Danh sách bảng giá
                <br><small class="text-danger">(Sẽ được thêm bảng giá sau khi lưu đơn vị vận chuyển)</small>
            </div>
            <div class="col-4">
                <button type="button" @click="openModalAdd()" class="btn btn-success">
                    <i class="fa fa-plus"></i>
                    Thêm bảng giá
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table" v-if="shipping_const && shipping_const.length">
            <thead>
                <tr>
                    <th>Tên Bảng giá</th>
                    <th>Mặc định</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in shipping_const">
                    <td v-text="item.title"></td>
                    <td>
                        <a href="javascript:;" @click="setDefault(item.id)"
                            :class="item.is_default == 1 ? 'text-success' : 'text-danger'">
                            <i :class="item.is_default == 1 ? 'fa fa-check-circle' : 'fa fa-times-circle'"></i>
                        </a>
                    </td>
                    <td>
                        <a href="javascript:;" @click="openEditModal(item)">
                            <i class="fa fa-pencil"></i>
                        </a>
                        &nbsp;
                        <a href="javascript:;" @click="deleteConst(item)">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    id="addShippingCostModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-biglg">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <div class="form-group">
                        <h4>Tên Bảng giá</h4>
                        <input type="text" v-model="current_const.title" id="title" placeholder="Tiêu đề"
                            class="form-control">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td class="text-center align-middle" rowspan="3">Khối lượng <br><small>(kg)</small>
                                    </td>
                                    <td class="text-center" colspan="4">Nội Miền / Liên Miền</td>
                                    <td class="text-center" colspan="4">Nội Tỉnh / Liên Tỉnh</td>
                                    <td class="text-center" colspan="4">Nội Thành / Ngoại Thành</td>
                                    <td rowspan="3" class="align-middle">
                                        <button @click="addItem()" type="button" class="btn btn-success">
                                            <i class="fa fa-plus"></i>
                                            Thêm
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="2">
                                        Nội Miền
                                    </td>
                                    <td class="text-center" colspan="2">
                                        Liên Miền
                                    </td>
                                    <td class="text-center" colspan="2">
                                        Nội tỉnh
                                    </td>
                                    <td class="text-center" colspan="2">
                                        Liên Tỉnh
                                    </td>
                                    <td class="text-center" colspan="2">
                                        Nội Thành
                                    </td>
                                    <td class="text-center" colspan="2">
                                        Ngoại Thành
                                    </td>
                                </tr>
                                <tr>
                                    @for ($i = 0; $i < 6; $i++)
                                        <td class="text-center">Mang ra BC</td>
                                        <td class="text-center">Lấy tận nơi</td>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in current_const.items" :key="index"
                                    v-if="current_const.items.length > 0">
                                    <td class="text-center">
                                        <input type="text" v-model="item.weight" class="form-control"
                                            placeholder="1-3">
                                    </td>
                                    <!-- Vùng Miền -->
                                    <td class="text-center">
                                        <input type="text" v-model="item.gia.vungmien.in.mangra" class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="item.gia.vungmien.in.layhang"
                                            class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="item.gia.vungmien.out.mangra"
                                            class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="item.gia.vungmien.out.layhang"
                                            class="form-control">
                                    </td>
                                    <!-- Nội Tỉnh / Liên Tỉnh -->
                                    <td class="text-center">
                                        <input type="text" v-model="item.gia.tinh.in.mangra" class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="item.gia.tinh.in.layhang" class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="item.gia.tinh.out.mangra" class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="item.gia.tinh.out.layhang" class="form-control">
                                    </td>
                                    <!-- Nội Thành / Ngoại Thành -->
                                    <td class="text-center">
                                        <input type="text" v-model="item.gia.thanh.in.mangra" class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="item.gia.thanh.in.layhang" class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="item.gia.thanh.out.mangra" class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="item.gia.thanh.out.layhang" class="form-control">
                                    </td>
                                    <!--  End -->
                                    <td class="text-center">
                                        <button type="button" @click="deleteItem(index)" class="btn btn-danger">
                                            <i class="fa fa-trash"> </i>
                                            Xóa
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="current_const.items.length > 0" style="antiquewhite">
                                    <td class="text-center">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">+</span>
                                            </div>
                                            <input type="text" v-model="current_const.overweight.weight"
                                                class="form-control" placeholder="2">
                                        </div>
                                    </td>
                                    <!-- Vùng Miền -->
                                    <td class="text-center">
                                        <input type="text" v-model="current_const.overweight.gia.vungmien.in.mangra"
                                            class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="current_const.overweight.gia.vungmien.in.layhang"
                                            class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="current_const.overweight.gia.vungmien.out.mangra"
                                            class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="current_const.overweight.gia.vungmien.out.layhang"
                                            class="form-control">
                                    </td>
                                    <!-- Nội Tỉnh / Liên Tỉnh -->
                                    <td class="text-center">
                                        <input type="text" v-model="current_const.overweight.gia.tinh.in.mangra"
                                            class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="current_const.overweight.gia.tinh.in.layhang"
                                            class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="current_const.overweight.gia.tinh.out.mangra"
                                            class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="current_const.overweight.gia.tinh.out.layhang"
                                            class="form-control">
                                    </td>
                                    <!-- Nội Thành / Ngoại Thành -->
                                    <td class="text-center">
                                        <input type="text" v-model="current_const.overweight.gia.thanh.in.mangra"
                                            class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="current_const.overweight.gia.thanh.in.layhang"
                                            class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="current_const.overweight.gia.thanh.out.mangra"
                                            class="form-control">
                                    </td>
                                    <td class="text-center">
                                        <input type="text" v-model="current_const.overweight.gia.thanh.out.layhang"
                                            class="form-control">
                                    </td>
                                </tr>
                                <tr v-if="current_const.items == 0">
                                    <td class="text-center" colspan="14">
                                        <p class="text-danger">Chưa có thông tin</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="button" @click="saveShippingConst()" class="btn btn-primary">
                        <i class="fa fa-arrow-circle-down"></i>
                        Lưu bảng giá
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
