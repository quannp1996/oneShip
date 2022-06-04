<template>
  <div class="search-bar">
    <div>
        <h1>Quản trị Kho</h1>
        <el-button size="small" type="primary" class='btnAdd'  @click="openDialog"><i class="fa fa-plus"></i> Tạo phiếu </el-button>
    </div>
    <el-card class="box-card">
      <div slot="header" class="clearfix">
           <el-input placeholder="Mã đơn"  v-model="searchID" >
            <template slot="prepend"><i class="fa fa-hashtag"></i></template>
          </el-input>
          <el-select v-model="searchIdWarehouse" placeholder="Select">
            <el-option key="" label="Tất cả các kho" value=""></el-option>
            <el-option
              v-for="item in this.$store.state.a.warehouseStore"
              :key="item.id"
              :label="item.name"
              :value="item.id">
            </el-option>
          </el-select>
      </div>
      <div  class="text item">
            <el-button size="small" type="primary" v-on:click='someComponent2Method'><i class="fa fa-search"></i> Tìm kiếm</el-button>
      </div>
    </el-card>
    <warehouse-order></warehouse-order>
  </div>
</template>

<style>
  h1, .h1 {
  font-size: 2.1875rem !important;
}
.el-input {
    width: 310px;
  }
.search-bar{
  margin-bottom: 20px;
}
.btnAdd {
  position: absolute;
  right: 30px;
  top: 140px;
}
</style>
<script>
// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../../helpers/api';
import { eventBus } from '../../app.js';
import WarehouseOrder from './Modal/WarehouseOrder.vue';

export default {
  name: 'SearchBar',
  components: { WarehouseOrder },

  data() {
    return {
      value: '',
      warehouseData: '',
      formLabelWidth: '120px',
    };
  },
  computed: {
    searchID: {
       get() {
          return this.$store.state.a.search.idWarehouseOrder;
        },
        set(value) {
          this.$store.dispatch('a/setIdWarehouseOrder', value.replace(/[^\d]/g, ''));
        },
    },
     searchIdWarehouse: {
       get() {
          return this.$store.state.a.search.idWarehouse;
        },
        set(value) {
          this.$store.dispatch('a/setIdWarehouse', value);
        },
    },
    // idInput:{
    //     get(){
    //       return this.$store.state.a.searchFilter.id;
    //     },
    //     set(value){
    //       this.$store.dispatch('a/filterID',value.replace(/[^\d]/g,''))
    //     }
    // },
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
    openDialog() {
      this.$store.dispatch('b/setDialogForm', true);
    },
     someComponent2Method: function() {
     // your code here
        eventBus.$emit('fireMethod');
    },

    async listWarehouse() {
      const url = 'ajax/warehouse/controller/warehouseData';
      const warehouseData = await api.request('GET', url);
      if (warehouseData) {
         this.$store.dispatch('a/dataWarehouseStore', warehouseData.data.data);
      }
    },
  },
}; // End class

</script>
