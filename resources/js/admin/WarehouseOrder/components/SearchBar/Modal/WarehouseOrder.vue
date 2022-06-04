<template slot-scope="scope">
  <el-form v-bind:model="ruleForm" v-bind:rules="rules" ref="ruleForm">
    <el-dialog title="Phiếu nhập Xuất/ Nhập" :visible.sync="dialog"  width="60%">
      <el-card class="box-card">
        <el-form-item label="Kho" prop="warehouseStore">
          <el-select v-model="ruleForm.warehouseStore" placeholder="Kho nhập">
            <el-option
              v-for="item in warehouseStore"
              :key="item.id"
              :label="item.name"
              :value="item.id"
            >
            </el-option>
          </el-select>
        </el-form-item>
      </el-card>
      <el-card class="box-card">
        <el-autocomplete
          class="search"
          v-model="state"
          :fetch-suggestions="querySearchAsync"
          placeholder="Sản phẩm"
          @select="addProduct"
        >
          <template slot="append"
            ><i class="el-icon-search"></i> Danh sách</template
          >
        </el-autocomplete>
        <div
          class="table-responsive margin-bt-20"
          v-if="this.$store.state.b.productData != ''"
        >
          <table class="table table-striped">
            <thead>
              <tr>
                <th width="250px">Sản phẩm</th>
                <th>Thuộc tính</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(post, index) in this.$store.state.b.productData"
                :key="index"
              >
                <td>
                  <a><img
                    :src="post.product.image_url"
                    style="width:40px;height:40px;float: left"
                  /><span style="
                      display: block;
                      margin-left: 50px;
                      word-break: break-word; min-width:100px
                  ">{{post.name}}</span></a>
                </td>
                <td>
                  <el-form-item label="Loại hình" :prop="'choiceVariable.'+index" :rules="{required: true, message: 'Không được để trống', trigger: 'blur'}">
                  <el-select
                    v-model="ruleForm.choiceVariable[index]"
                    value-key="item"
                    placeholder="Select"
                    @change="addKey(index, post.product_id)"
                  >
                     <el-option
                      v-for="item in post.product_variants"
                      v-if="item.is_root === 1"
                      :key="item.product_variant_id"
                      :value=" 'Biến thể gốc'+ ' - Mã:' + item.product_variant_id"
                    >
                      <a>
                        <span  v-if="item.sku != null">{{ item.sku }}</span>
                        <span  v-if="typeof item.sku ==='undefined' ||  item.sku === null &&  item.is_root === 1">-Biến thể gốc-</span>
                      </a>
                      <a
                        v-for="(childItem, index) in item.product_option_values"
                        :key="index"
                      >
                        <a v-if="childItem.option_value">{{
                          "(" +
                            childItem.option.desc.name +
                            ":" +
                            childItem.option_value.desc.name +
                            ") "
                        }}</a>
                      </a>
                    </el-option>
                    <el-option
                        v-for="item in post.product_variants"
                        v-if="item.is_root === 0 && item.sku !== null"
                        :key="item.product_variant_id"
                        :value=" item.sku + ' - Mã:' + item.product_variant_id"
                      >
                        <a>
                          <span  v-if="item.sku != null">{{ item.sku }}</span>
                        </a>
                        <a
                          v-for="(childItem, index) in item.product_option_values"
                          :key="index"
                        >
                          <a v-if="childItem.option_value">{{
                            "(" +
                              childItem.option.desc.name +
                              ":" +
                              childItem.option_value.desc.name +
                              ") "
                          }}</a>
                        </a>
                      </el-option>
                    <el-option
                      v-for="item in post.product_variants"
                      v-if="item.is_root === 0 && item.sku === null"
                      :key="item.product_variant_id"
                      :value=" '-Biến thể chưa nhập tên sku-' + ' - Mã:' + item.product_variant_id"
                    >
                      <a>
                        <span  v-if="item.sku != null">{{ item.sku }}</span>
                        <span  v-if="typeof item.sku ==='undefined' ||  item.sku === null &&  item.is_root === 0">-Biến thể chưa nhập tên sku: Mã {{ item.product_variant_id }} -</span>
                      </a>
                      <a
                        v-for="(childItem, index) in item.product_option_values"
                        :key="index"
                      >
                        <a v-if="childItem.option_value">{{
                          "(" +
                            childItem.option.desc.name +
                            ":" +
                            childItem.option_value.desc.name +
                            ") "
                        }}</a>
                      </a>
                    </el-option>
                  </el-select>
                  </el-form-item>
                </td>
                <td>
                  <el-input
                    placeholder="Số lượng"
                    type="number" min="0"
                    v-model="inputVariableCount[index]"
                    style="width: 150px;" @input="replaceNumber(index)"
                  ></el-input>
                </td>
                <td>
                  <el-input
                    placeholder="Giá"
                    type="number" min="0"
                    v-model="inputVariablePrice[index]"
                    style="width: 150px;"
                    @input="replacePrice(index)"
                  ></el-input>
                </td>
                <td>
                  <a
                    href="javascript:;"
                    @click="clearKey(index, post.product_id)"
                    ><i class="el-icon-circle-close"></i
                  ></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div v-else>
          <el-alert
            class="margin-bt-20"
            title="warning alert"
            type="warning"
            description="Chưa có sản phẩm nào"
            show-icon
            center
          >
          </el-alert>
        </div>
        <div class="margin-bt-20">
          <el-form-item label="Loại hình" prop="typeOrder">
            <el-radio v-model="ruleForm.typeOrder" label="1"
              >Phiếu nhập</el-radio
            >
            <el-radio v-model="ruleForm.typeOrder" label="2"
              >Phiếu xuất</el-radio
            >
          </el-form-item>
        </div>
      </el-card>
      <span slot="footer" class="dialog-footer">
        <el-button @click="openDialogForm">Cancel</el-button>
        <el-button type="primary" @click="submitForm('ruleForm')"
          >Confirm</el-button
        >
      </span>
    </el-dialog>
  </el-form>
</template>
<style>
.box-card {
  margin-bottom: 20px;
}
.search {
  width: 90%;
}
.el-autocomplete .el-input{
    width: 100%;
}
.margin-bt-20 {
  margin-top: 20px;
  margin-bottom: 20px;
}
.el-dialog__headerbtn {
  display: none;
}
</style>

<script>
import numberFormat from '../../../mixins/numberFormat.js';
import { eventBus } from '../../../app.js';
import api from '../../../helpers/api';
export default {
  name: 'WarehouseOrder',
  mixins: [numberFormat],
  data() {
    return {
      ruleForm: {
        warehouseStore: '',
        typeOrder: '',
        choiceVariable: [],
      },
      dialogFormVisible: this.dialog,
      value: '',
      inputVariableCount: [],
      inputVariablePrice: [],
      inputVariableProductID: [],
      state: '',
      input: '',
      keyAdd: 0,
      rules: {
        warehouseStore: [
          { required: true, message: 'Hãy chọn kho', trigger: 'change' },
        ],
        typeOrder: [
          { required: true, message: 'Hãy chọn hình thức', trigger: 'change' },
        ],
      },
    };
  },
  components: {},
  computed: {
    warehouseStore() {
      return this.$store.state.a.warehouseStore;
    },
    dialog: {
      get() {
        return this.$store.state.b.dialogFormVisible;
      },
      set(value) {
        this.$store.dispatch('b/setDialogForm', true);
      },
    },
  },
  mounted() {},
  methods: {
    replaceNumber(index) {
      this.inputVariableCount[index] = this.inputVariableCount[index].replace(/[^0-9]/g, '');
    },
    replacePrice(index) {
      this.inputVariablePrice[index] = this.inputVariablePrice[index].replace(/[^0-9]/g, '');
    },
    addKey(index, prd_id) {
      this.inputVariableProductID[index] = prd_id;
    },
    clearKey(index) {
      this.inputVariableProductID.splice(index, 1);
      this.inputVariablePrice.splice(index, 1);
      this.inputVariableCount.splice(index, 1);
      this.$store.dispatch('b/deleteProductData', index);
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    },
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.makeOrder();
          this.openSuccess('Tạo thành công');
          this.functionFiredModal();
        } else {
          this.openError('Có lỗi xảy ra');
          return false;
        }
      });
    },
    openError(msg) {
      this.$message.error(msg);
    },
    openSuccess(msg) {
      this.$message({
        message: msg,
        type: 'success',
      });
    },
    openDialogForm() {
      this.$store.dispatch('b/setDialogForm', false);
    },

    async makeOrder() {
      const url = 'ajax/warehouse/controller/createWarehouseOrder';
      const data = {
        choiceVariable: this.ruleForm.choiceVariable,
        inputVariableCount: this.inputVariableCount,
        inputVariablePrice: this.inputVariablePrice,
        inputVariableProductID: this.inputVariableProductID,
        productData: this.$store.state.b.productData,
        ruleForm: this.ruleForm,
      };
      const order = await api.request('POST', url, { data });
      if (order) {
        this.openDialogForm();
      }
    },
    functionFiredModal() {
      eventBus.$emit('fireMethod');
    },
    async addCollection(item) {
      this.$store.dispatch('b/collectionData', item.data);
    },
    async querySearchAsync(queryString, cb) {
      const url = 'ajax/warehouse/controller/searchProductVariants';
      const cate = await api.request('POST', url, { queryString });
      const collectionData = [];
      Array.from(cate.data.data).forEach((child) => {
        if (child.product != null) {
          collectionData.push({
            value: child.name,
            id: child.id,
            data: child,
          });
        }
      });
      clearTimeout(this.timeout);
      cb(collectionData);
    },
    async addProduct(item) {
      this.$store.dispatch('b/productData', item.data);
    },
  },
};
</script>
