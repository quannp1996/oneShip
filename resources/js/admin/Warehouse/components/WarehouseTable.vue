<template>
  <el-card class="box-card">
    <div slot="header" class="clearfix">
      <i class="fa fa-align-justify"></i> Danh sách
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th  style="min-width: 20px">SKU</th>
            <th style="min-width: 300px">Sản phẩm</th>
            <th>Tổng nhập xuất</th>
            <th>Đã bán</th>
            <th>Khả dụng</th>
            <th width="55"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="post in laravelData.data" :key="post.id">
            <td><p v-if="post.product_variants[0]">{{  post.product_variants[0].sku }}</p></td>
            <td>
                  <div>
                      <a><img :src="post.product.image_url" style="width:60px;height:60px"> {{post.product.desc.name}}</a>
                      <a>
                          <div class="box-style" v-if="post.product_variants[0]">
                              <a v-for=" (childItem,index) in post.product_variants[0].product_option_values"  :key="index">
                                  <i v-if="childItem.option_value" >{{ '('+childItem.option.draft_name+':' + childItem.option_value.draft_name+ ') ' }}</i>
                                  </a>
                          </div>
                      </a>
                  </div>
            </td>
            <td class="text-center">{{ post.total_quantity }}</td>
            <td class="text-center">{{ post.quantity_used_by_sale }}</td>
            <td class="text-center">{{ post.quantity_still }}</td>
            <td>
              <el-button type="primary" @click="openDialogVisiblePrdVariant(post.product_variants_id)">Chi tiết các kho</el-button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <pagination :data="laravelData" @pagination-change-page="dataTable"></pagination>
    <!-- <pagination :data="laravelData" @pagination-change-page="dataTable"></pagination> -->
    <detailProductVariant></detailProductVariant>
  </el-card>
</template>
<style>
.boxColor {
  width: 40px;
  height: 40px;
}
.text-center{
  text-align: center;
}
</style>
<script>
import messageMixin from '../mixins/messageMixin.js';
import api from '../helpers/api';
import Vue from 'vue';
import { eventBus } from '../app.js';
import detailProductVariant from './Dialog/detailProductVariant.vue';
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);
Vue.component('pagination', require('laravel-vue-pagination'));
export default {
  mixins: [messageMixin],
  name: 'WarehouseTable',
  components: { detailProductVariant },
  data() {
    return {
      tableData: [],
      laravelData: {},
      herf: window.location.origin,
    };
  },
  computed: {},
  mounted() {
    this.dataTable(this.$route.query.page ?? 1);
    // this.dataTable(this.$route.query.page ?? 1);
  },
  created() {
    eventBus.$on('fireMethod', () => {
            this.dataTable();
    });
  },
  methods: {
   async openDialogVisiblePrdVariant(id, page = 1) {
      this.$store.dispatch('b/setDialogVisiblePrdVariantSet', true);
      const IdWarehouse = this.$store.state.a.dialogChoice.idWarehouse;
      const url = 'ajax/warehouse/controller/productWarehouseDetail?page='+ page;
      const result = await api.request('POST', url, { id, IdWarehouse });
      if (!result.data.error) {
        this.$store.dispatch('b/dataDetail', result.data.data);
        this.$store.dispatch('b/setLoading', false);
        this.$store.dispatch('b/choiceVariant', id);
      }
    },
    async dataDialogProductWarehouse(id) {
        this.$store.dispatch('a/setIdPrd', id);
        const IdWarehouse = this.$store.state.a.dialogChoice.idWarehouse;
        const url = 'ajax/warehouse/controller/productWarehouseList';
        const result = await api.request('POST', url, { id, IdWarehouse });
    },
    // async dataTable(page = 1) {
    //   const url = 'ajax/warehouse/controller/productList?page=' + page;
    //   const result = await api.request('POST', url);
    //   if (!result.data.error) {
    //     this.laravelData = result.data.data;
    //   }
    // },
    async dataTable(page = 1) {
      const search = this.$store.state.a.searchFilter;
      const url = 'ajax/warehouse/controller/ajaxWarehouseOrderItemData?page=' + page;
      const result = await api.request('POST', url, search);
      if (!result.data.error) {
        this.laravelData = result.data.data;
      }
    },
  },
}; // End class
</script>
