<template>
  <el-card class="box-card">
    <el-select v-model="tabType" placeholder="Loại phiếu" @change="functionFired">
      <el-option key="All" label="-Tất cả-" value="All" selected></el-option>
      <el-option key="Out" label="Phiếu xuất" value="Out"></el-option>
      <el-option key="In" label="Phiếu nhập" value="In"></el-option>
    </el-select>
    <div class="table-responsive" v-if="this.$store.state.a.content.total > 0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th width="55">ID</th>
            <th width="100">SKU</th>
            <th style="min-width:400px;">Kho</th>
            <th>Tổng</th>
            <th>Loại phiếu</th>
            <th>Ngày tạo</th>
            <th width="120"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="post in this.$store.state.a.content.data" :key="post.id">
            <td>{{ post.id }}</td>
            <td>{{ post.code }}</td>
            <td>
              <a v-for="items in warehouse" :key="items.id">
                <a v-if="post.warehouse_id == items.id">{{ items.name }}</a>
              </a>
            </td>
            <td>{{ post.quantity }}</td>
            <td>{{ post.type }}</td>
            <td>{{ format_date(post.created) }}</td>
            <td>
              <div>
                <el-button
                  type="primary"
                  size="mini"
                  @click="openDialog(post.id)"
                  style="float: right; width: 110px;margin-bottom:5px"
                  >Xử lý phiếu</el-button
                >
                <!-- <el-button type="danger" size="mini" style="float: right;width: 110px;">Hủy</el-button> -->
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-else>
      <el-alert
        title="warning alert"
        type="warning"
        description="Không có dữ liệu"
        show-icon
        center
      >
      </el-alert>
    </div>
    <pagination
      :data="this.$store.state.a.content"
      @pagination-change-page="dataTable"
    ></pagination>
    <detail></detail>
  </el-card>
</template>
<style>
.boxColor {
  width: 40px;
  height: 40px;
}
</style>
<script>
// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../helpers/api';
import Vue from 'vue';
import moment from 'moment';
import { eventBus } from '../app.js';
import VueSweetalert2 from 'vue-sweetalert2';
import Detail from './DetailOrder/detail.vue';

Vue.use(VueSweetalert2);
Vue.component('pagination', require('laravel-vue-pagination'));
export default {
  name: 'WarehouseTable',
  components: { Detail },
  data() {
    return {
      tableData: [],
      herf: window.location.origin,
    };
  },

  mounted() {
    // this.dataTable(this.$route.query.page ?? 1);
    // this.dataTable(this.$route.query.page ?? 1);
  },
  computed: {
    warehouse() {
      return this.$store.state.a.warehouseStore;
    },
    tabType: {
      set(value) {
        this.$store.state.a.tabType = value;
      },
      get() {
        return this.$store.state.a.tabType;
      },
    },
  },
  created() {
    // eventBus.$on('fireMethod', () => {
    //         this.dataTable();
    // })
  },
  methods: {
    functionFired() {
      eventBus.$emit('fireMethod');
    },
    openDialog(id) {
      this.$store.dispatch('a/setDialogTable', true);
      this.$store.dispatch('a/setOrderChosen', id);
      this.$store.dispatch('a/loadingOrderDetail', true);
      this.detailOrder(id);
    },
    format_date(value) {
      if (value) {
        return moment(value * 1000).format('MM/DD/YYYY hh:mm');
      }
    },
    async detailOrder(id) {
      const url = `ajax/warehouse/controller/warehouseItemsDetail?id=${id}`;
      const result = await api.request('GET', url);
      if (result.data) {
        this.$store.dispatch('a/detailOrder', result.data.data);
        this.$store.dispatch('a/loadingOrderDetail', false);
      }
    },
    async dataTable(page = 1) {
      const tab = this.$store.state.a.tabName;
      const url = `ajax/warehouse/controller/warehouseList?page=${page}&&tap=${tab}`;

      const result = await api.request('POST', url);
      if (result.data) {
        this.$store.dispatch('a/content', result.data.data);
      }
    },
  },
};
</script>
