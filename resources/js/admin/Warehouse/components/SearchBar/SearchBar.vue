<template>
  <div class="search-bar">
    <div>
      <h1>Quản trị Kho</h1>
    </div>
    <el-card class="box-card">
      <div slot="header" class="clearfix">
        <el-select v-model="warehouseID" placeholder="Select">
          <el-option key="" label="Tất cả các kho" value=""></el-option>
          <el-option
            v-for="item in warehouseData"
            :key="item.id"
            :label="item.name"
            :value="item.id"
          >
          </el-option>
        </el-select>
      </div>
      <div class="text item">
        <el-button size="small" type="primary" v-on:click="someComponent2Method"
          ><i class="fa fa-search"></i> Tìm kiếm</el-button
        >
        <el-button size="small" type="primary" v-if="warehouseID != ''" v-on:click="deleteWarehouse"
          ><i class="fa fa-minus"></i> Xóa</el-button
        >
        <el-button size="small" type="primary" v-if="warehouseID != ''" v-on:click="openDialogEdit"
          ><i class="fa fa-edit"></i> Sửa</el-button
        >
        <el-button size="small" type="primary" @click="openDialogAdd"
          ><i class="fa fa-plus"></i> Tạo kho mới</el-button
        >
      </div>
    </el-card>
    <detailAdd></detailAdd>
    <detailEdit></detailEdit>
  </div>
</template>

<style>
h1,
.h1 {
  font-size: 2.1875rem !important;
}
.el-input {
  width: 310px;
}
.search-bar {
  margin-bottom: 20px;
}
.btnAdd {
  position: absolute;
  right: 30px;
  top: 140px;
}
</style>
<script>
import detailAdd from '../Dialog/detailAdd.vue';
import detailEdit from '../Dialog/detailEdit.vue';
import api from '../../helpers/api';
import messageMixin from '../../helpers/messageMixin';
import { eventBus } from '../../app.js';

export default {
  name: 'SearchBar',
  mixins: [messageMixin],
  components: { detailAdd, detailEdit },
  // components: {detail},
  data() {
    return {
      value: '',
      warehouseData: '',
    };
  },
  computed: {
    warehouseID: {
      get() {
        return this.$store.state.a.searchFilter.idWarehouse;
      },
      set(value) {
        this.$store.dispatch('a/searchWarehouseID', value);
      },
    },
    inputTitle: {
      // eslint-disable-next-line vue/return-in-computed-property
      get() {
        if (typeof this.$store.state.a.searchFilter !== 'undefined') {
          return this.$store.state.a.searchFilter.title;
        }
      },
      set(value) {
        this.$store.dispatch('a/filterTitle', value);
      },
    },
  },
  mounted() {
    // this.$store.dispatch('a/filterID',this.$route.query.id);
    // this.$store.dispatch('a/filterTitle',this.$route.query.title);
    this.listWarehouse();
  },

  methods: {
    async editWarehouse() {
      const url = `ajax/warehouse/controller/${this.warehouseID}/warehouseEdit`;
      const warehouseData = await api.request('GET', url);
    },
    async deleteWarehouse() {
      const url = `ajax/warehouse/controller/${this.warehouseID}/warehouseDelete`;
      const warehouseData = await api.request('GET', url);
      if (!warehouseData.data.error) {
        this.listWarehouse();
        this.warehouseID = '';
        this.showMessage( warehouseData.data.msg, 'success');
      } else {
        this.showMessage( warehouseData.data.msg, 'error');
      }
    },
    openDialogAdd() {
      this.$store.dispatch('b/dialogVisible', true);
    },
    openDialogEdit() {
      this.$store.dispatch('b/dialogEditVisible', true);
    },
    someComponent2Method: function() {
      // your code here
      eventBus.$emit('fireMethod');
    },
    async listWarehouse() {
      const url = 'ajax/warehouse/controller/warehouseData';
      const warehouseData = await api.request('GET', url);
      if (warehouseData) {
        this.warehouseData = warehouseData.data.data;
        this.$store.dispatch('a/warehouseData', warehouseData.data.data);
      }
    },
  },
}; // End class
</script>
