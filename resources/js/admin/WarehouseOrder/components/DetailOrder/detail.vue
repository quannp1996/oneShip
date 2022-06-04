<template>
    <div>
       <el-dialog
            title="Chi tiết phiếu"
            :visible.sync="dialog2"
            width="60%"
            :before-close="handleClose">
            <el-card class="box-card">
                <h2>Kho</h2>
                <div  v-if="detailOrder.warehouse" style="background: rgb(245, 245, 245); border: 1px solid rgb(217, 217, 217); box-sizing: border-box; border-radius: 4px;">
                    <p class="mag-left15">Tên kho: {{ detailOrder.warehouse.name }}</p>
                    <p class="mag-left15">Address: {{ detailOrder.warehouse.address }}</p>
                    <p class="mag-left15">Phone: {{ detailOrder.warehouse.phone }}</p>
                </div>
            </el-card>
            <el-card class="box-card" v-loading="loading">
                 <h2>Thông tin chi tiết</h2>
                <div class="table-responsive"  v-if="detailOrder">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="70">Mã</th>
                                <th width="250">Tên</th>
                                <th style="100">Giá</th>
                                <th >Số lượng</th>
                                <th >Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr v-for="(post,index) in detailOrder.order_detail" :key="index">
                                    <td>{{ post.id }}</td>
                                    <td>
                                        <a><img :src="post.product.image_url" style="width: 60px;height: 60px;float: left;"><span style="
                                            display: block;
                                            margin-left: 70px;
                                            word-break: break-word; min-width:100px
                                        ">{{post.product.desc.name}}</span></a>
                                        <a v-for="(items, index) in  post.product_detail"  :key="index">
                                            <a v-if="post.product_variants_id == items.product_variant_id">
                                                :{{ items.sku }}
                                            <div class="box-style">
                                                <a v-for=" (childItem,index) in items.product_option_values"  :key="index">
                                                    <i v-if="childItem.option_value" >{{ '('+childItem.option.draft_name+':' + childItem.option_value.draft_name+ ') ' }}</i>
                                                    </a>
                                            </div>
                                            </a>
                                        </a>
                                    </td>
                                    <td>
                                        {{ numberFormat(post.price) }}
                                    </td>
                                    <td>{{post.quantity}}</td>
                                    <td> {{ numberFormat( post.price * post.quantity) }}</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </el-card>
            <el-card class="box-card">
                <h2>Trạng thái</h2>
                <el-radio-group v-model="statusOrder">
                    <el-radio  :label="0" >Mới</el-radio>
                    <el-radio  :label="1" >Chờ</el-radio>
                    <el-radio  :label="2">Hoàn thành</el-radio>
                    <el-radio  :label="-1">Hủy</el-radio>
                </el-radio-group>

            </el-card>
            <span slot="footer" class="dialog-footer">
                <el-button @click="closeDialogTableV">Cancel</el-button>
                <el-button type="primary" @click="submitForm">Confirm</el-button>
            </span>
            </el-dialog>
    </div>
</template>

<style >
    .v-modal{
        z-index: 1000 !important;
    }
    .mag-left15{
        margin-left: 15px;
    }
</style>
<script>
import api from '../../helpers/api';
import { eventBus } from '../../app.js';
    export default {
        data() {
            return {
                openDialogTable: this.dialog,
                formLabelWidth: '220px',
                form: {
                },
                herf: window.location.origin,
            };
        },
        computed: {
            loading() {
              return this.$store.state.a.loadingOrderDetail;
            },
            dialog2: {
                get() {
                    return this.$store.state.a.dialogTableVisible;
                },
                set(value) {
                    this.$store.dispatch('a/setDialogTable', value);
                },
            },
            detailOrder() {
                return this.$store.state.a.detailOrder;
            },

            statusOrder: {
                get() {
                    const test = this.$store.state.a.detailOrder.status;
                    return test;
                },
                set(value) {
                    this.$store.dispatch('a/setDetailOrder', value);
                },
            },
        },
        mounted() {

        },
        methods: {
            async submitForm() {
                const url = 'ajax/warehouse/controller/updateWarehouseOrder';
                const data = this.$store.state.a.detailOrder;
                const update = await api.request('POST', url, { data });
                if (!update.data.error) {
                    this.closeDialogTableV();
                    this.openSuccess(update.data.msg);
                    this.someComponent2Method();
                } else {
                    this.openError(pdate.data.msg);
                }
            },
            numberFormat(number) {
             return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number);
            },
            someComponent2Method: function() {
            // your code here
                eventBus.$emit('fireMethod');
            },
            handleClose(done) {
                this.$confirm('Bạn có chắc muốn đóng?', 'Cảnh báo!', {
                  confirmButtonText: 'Đồng ý',
                  cancelButtonText: 'Bỏ qua',
                })
                .then((_) => {
                    done();
                })
                .catch((_) => {});
            },
            closeDialogTableV() {
                this.$store.dispatch('a/setDialogTable', false);
            },
            openSuccess(msg) {
                this.$message({
                    message: msg,
                    type: 'success',
                });
            },
            openError(msg) {
            this.$message.error(msg);
            },
        },
    };
</script>
