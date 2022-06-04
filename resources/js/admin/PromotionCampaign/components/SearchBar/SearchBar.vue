<template>
  <div class="search-bar">
    <div>
      <h1>Quản trị chiến dịch khuyến mãi</h1>
      <router-link to="/promotionCampaign/add"
        ><el-button
          size="small"
          type="primary"
          class="btnAdd"
          @click="clearData"
          ><i class="fa fa-plus"></i> Tạo mới</el-button
        ></router-link
      >
    </div>
    <el-card class="box-card">
      <div slot="header" class="clearfix">
        <div>
          <el-input placeholder="ID" v-model="idInput">
            <template slot="prepend"><i class="fa fa-hashtag"></i></template>
          </el-input>
          <el-input placeholder="Tiêu đề" v-model="inputName">
            <template slot="prepend"><i class="fa fa-bookmark-o"></i></template>
          </el-input>
        </div>
      </div>
      <div class="text item">
        <el-button size="small" type="primary" v-on:click="someComponent2Method"
          ><i class="fa fa-search"></i> Tìm kiếm</el-button
        >
      </div>
    </el-card>
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
// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../../helpers/api';
import { eventBus } from '../../app.js';

export default {
  name: 'SearchBar',
  components: {},
  // components: { ProductVariantAdd, ProductVariantList, ProductVariantInformation, ProductData, ProductImage, ProductAssociate, ProductTag},
  data() {
    return {
      title: '',
    };
  },
  computed: {
    idInput: {
      get() {
        return this.$store.state.a.searchFilter.id;
      },
      set(value) {
        this.$store.dispatch('a/filterID', value.replace(/[^\d]/g, ''));
      },
    },
    inputName: {
      // eslint-disable-next-line vue/return-in-computed-property
      get() {
        if (typeof this.$store.state.a.searchFilter !== 'undefined') {
          return this.$store.state.a.searchFilter.name;
        }
      },
      set(value) {
        this.$store.dispatch('a/filterName', value);
      },
    },
  },
  mounted() {
    this.$store.dispatch('a/filterID', this.$route.query.id);
    this.$store.dispatch('a/filterName', this.$route.query.name);
  },

  methods: {
    clearData() {
     const content = {
        image: '',
        status: 1,
        start_date: null,
        end_date: null,
        offer_discount_type: 'voucher_accessory',
        promote_percent: '',
        formating: 'normal',
        formatprice: 'normal',
        parity_price: '',
      };
      this.$store.dispatch('b/content', content);
      const desData = [];
        Array.from(this.$store.state.c.langData).forEach((child) => {
            desData[child.language_id] = {
                language_id: child.language_id,
                name: '',
                short_description: '',
                meta_title: '',
                meta_description: '',
                meta_keyword: '',
            };
        });
      this.$store.dispatch('c/content', desData);
    },
    someComponent2Method: function() {
      // your code here
      eventBus.$emit('fireMethod');
    },
  },
}; // End class
</script>