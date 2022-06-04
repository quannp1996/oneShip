<template>
  <div>
    <el-dialog
      title="Tạo kho hàng"
      :visible.sync="dialogVisible"
      width="50%"
      :before-close="handleClose"
    >
      <el-form
        v-bind:model="ruleForm"
        v-bind:rules="rules"
        label-width="120px"
        ref="ruleForm"
      >
        <el-card class="box-card">
          <el-form-item label="Tên kho" prop="warehouseStoreName">
            <el-input v-model="ruleForm.warehouseStoreName"></el-input>
          </el-form-item>
          <el-form-item label="Địa chỉ" prop="warehouseAddress">
            <el-input  type="textarea" v-model="ruleForm.warehouseAddress"></el-input>
          </el-form-item>
          <el-form-item label="Tỉnh/Thành phố" prop="city">
            <el-select v-model="ruleForm.city" placeholder="Tỉnh/Thành phố" @change="getDistrict" no-data-text="Không có dữ liệu">
              <el-option
                v-for="(item, index) in cityList"
                :label="item.name"
                :value="item.id"
                :key="index"
                >{{ item.name }}</el-option
              >
            </el-select>
          </el-form-item>
          <el-form-item label="Quận/huyện" prop="district">
            <el-select v-model="ruleForm.district" placeholder="Quận/huyện" no-data-text="Không có dữ liệu">
              <el-option
                v-for="(item, index) in districtList"
                :label="item.name"
                :value="item.id"
                :key="index"
                >{{ item.name }}</el-option
              >
            </el-select>
          </el-form-item>
          <el-form-item label="Phone" prop="phone">
              <el-input v-model="phoneCom" type="phone" maxlength="11"></el-input>
          </el-form-item>
        </el-card>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button @click="closeDialogTableV">Cancel</el-button>
        <el-button type="primary" @click="submitForm('ruleForm')"
          >Confirm</el-button
        >
      </span>
    </el-dialog>
  </div>
</template>
<style lang="scss" scoped></style>
<script>
import api from '../../helpers/api';
import messageMixin from '../../mixins/messageMixin.js';
export default {
  mixins: [messageMixin],
  name: 'detailAdd',
  data() {
    const checkName = (rule, value, callback) => {
      if (!value) {
        return callback(new Error('Please input the age'));
      }
      setTimeout(() => {
        const url = 'ajax/warehouse/controller/checkNameIsset';
        api
          .request('POST', url, { value })
          .then(function(response) {
            if (response.data.error) {
              callback(new Error(response.data.msg));
            } else {
              callback();
            }
          })
          .catch((e) => {
            // console.log(e.response.data);
            // console.log(e.response.status);
            // console.log(e.response.headers);
            callback(new Error(e.response.data.errors.value[0]));
          });
      }, 100);
    };
    return {
      cityList: [],
      districtList: [],
      ruleForm: {
        warehouseStoreName: '',
        warehouseAddress: '',
        city: '',
        district: '',
        phone: '',
      },
      rules: {
        warehouseStoreName: [
          {
            required: true,
            message: 'Hãy nhập tên Kho',
            trigger: 'blur',
          },
          {
            validator: checkName,
            trigger: 'blur',
          },
        ],
        warehouseAddress: [
          {
            required: true,
            message: 'Hãy nhập địa chỉ chi tiết Kho',
            trigger: 'blur',
          },
        ],
        city: [{
            required: true,
            message: 'Hãy chọn tỉnh thành',
            trigger: 'blur',
        }],
        district: [{
            required: true,
            message: 'Hãy chọn quận huyện',
            trigger: 'blur',
        }],
        // phone: [{ type: 'number', message: 'Sdt phải là số' }],
      },
    };
  },

  computed: {
    phoneCom: {
      get() {
        return this.ruleForm.phone;
      },
      set(value) {
        this.ruleForm.phone = value.replace(/[^0-9]/g, '');
      },
    },
    dialogVisible: {
      get() {
        return this.$store.state.b.dialogVisible;
      },
      set(value) {
        this.$store.dispatch('b/dialogVisible', value);
      },
    },
  },

  mounted() {
    this.getCity();
  },

  methods: {
    async getCity() {
      const url = 'location/city/ajax';
      const result = await api.request('GET', url);
      if (!result.data.error) {
        this.cityList = result.data.data;
      }
    },
    async getDistrict() {
      const url = `location/district/ajax?province_id=${this.ruleForm.city}`;
      const result = await api.request('GET', url);
      if (result.data.success) {
        this.districtList = result.data.data.districts;
      }
    },
    closeDialogTableV() {
      this.$store.dispatch('b/dialogVisible', false);
    },
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          const warehouseStoreName = this.ruleForm.warehouseStoreName;
          const warehouseAddress = this.ruleForm.warehouseAddress;
          const city = this.ruleForm.city;
          const district = this.ruleForm.district;
          const phone = this.ruleForm.phone;
          const url = 'ajax/warehouse/controller/saveWarehouse';
          api.request('POST', url, { warehouseStoreName, warehouseAddress, city, district, phone }).then((response) => {
                this.closeDialogTableV();
               return this.showMessage('Thành công', 'success');
            })
            .catch((_) => {
              return this.showMessage('Có lỗi.', 'error');
            });
        } else {
          this.showMessage('Có lỗi.', 'error');
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
  },
};
</script>
