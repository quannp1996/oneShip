<template>
  <div>
    <el-dialog
      title="Chi tiết kho sản phẩm"
      :visible.sync="dialogVisible"
      width="70%"
      :before-close="handleClose"
    >
      <div class="block">
        <el-select
          v-model="value"
          placeholder="Select"
          style="margin-bottom:10px"
        >
          <el-option key="" label="Tất cả" value=""></el-option>
          <el-option
            v-for="item in warehouseData"
            :key="item.id"
            :label="item.name"
            :value="item.id"
          >
          </el-option>
        </el-select>
      </div>
      <div class="block">
        <el-input
          v-model="choiceSku"
          placeholder="SKU"
          size="normal"
          clearable
        ></el-input>
      </div>
        <div class="block">
            <span class="demonstration"></span>
            <el-date-picker
            v-model="timePicker"
            type="daterange"
            start-placeholder="Start Date"
            end-placeholder="End Date"
            value-format="yyyy-MM-dd"
            format="dd-MM-yyyy">
            </el-date-picker>
        </div>
      <el-button
        type="primary"
        @click="openDialogVisiblePrdVariant(choiceVariant, choiceSku , timePicker)"
        ><i class="fa fa-search"></i> Tìm kiếm</el-button
      >

      <div class="table-responsive" v-loading="loading">
        <table class="table table-striped">
          <thead>
            <tr>
              <th width="75">ID</th>
              <th width="75">SKU</th>
              <th width="95" class="text-center">Loại</th>
              <th width="105" class="text-center">Số lượng</th>
              <th width="205" class="text-center">Giá/sản phẩm</th>
              <th class="text-center">Kho</th>
              <th width="160">Thời gian</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="post in dataDetail.data" :key="post.id">
              <td>{{ post.id }}</td>
              <td>{{ post.code }}</td>
              <td class="text-center">{{ post.type }}</td>
              <td class="text-center">{{ post.quantity }}</td>
              <td class="text-center">{{ numberFormat(post.price) }}</td>
              <td class="text-center">{{ post.name_warehouse }}</td>
              <td>{{ format_date(post.created) }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <pagination
        :data="dataDetail"
        @pagination-change-page="openDialogVisiblePrdVariant"
      ></pagination>
      <span slot="footer" class="dialog-footer">
        <el-button @click="handleClose">Cancel</el-button>
        <!-- <el-button type="primary" @click="handleClose">Confirm</el-button> -->
      </span>
    </el-dialog>
  </div>
</template>
<style>
.block {
  float: left;
  margin-right: 5px;
}
.el-select .el-input {
    width: 200px;
}
</style>

<script>
import numberFormat from '../../mixins/numberFormat.js';
import dateFormat from '../../mixins/dateFormat.js';
import api from '../../helpers/api';
import moment from 'moment';

export default {
  mixins: [numberFormat, dateFormat],
  data() {
    return {
      value: '',
      choiceSku: '',
      timePicker: '',
    };
  },
  mounted() {},
  computed: {
    loading() {
      return this.$store.state.b.loading;
    },
    warehouseData() {
      return this.$store.state.a.warehouseData;
    },
    choiceVariant() {
      return this.$store.state.b.choiceVariant;
    },
    dialogVisible: {
      get() {
        return this.$store.state.b.dialogVisiblePrdVariantSet;
      },
      set(value) {
        this.$store.dispatch('b/setDialogVisiblePrdVariantSet', value);
      },
    },
    dataDetail() {
      return this.$store.state.b.dataDetail;
      // get() {
      //     return this.$store.state.b.dataDetail;
      // },
      // set(value) {
      //     this.$store.dispatch('b/setDialogVisiblePrdVariantSet', value);
      // },
    },
  },
  methods: {
    handleClose() {
      this.$store.dispatch('b/setDialogVisiblePrdVariantSet', false);
      this.$store.dispatch('b/setLoading', true);
    },
    async openDialogVisiblePrdVariant(id, sku, timePicker, page = 1) {
      this.$store.dispatch('b/setDialogVisiblePrdVariantSet', true);
      const IdWarehouse = this.value;
      const url =
        'ajax/warehouse/controller/productWarehouseDetail?page=' + page;
      const result = await api.request('POST', url, { id, sku, timePicker, IdWarehouse });
      if (!result.data.error) {
        this.$store.dispatch('b/dataDetail', result.data.data);
        this.$store.dispatch('b/setLoading', false);
      }
    },
  },
};
</script>
