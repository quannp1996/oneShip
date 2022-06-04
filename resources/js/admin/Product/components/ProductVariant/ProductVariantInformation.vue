<template>
  <el-tabs v-model="activeName" @tab-click="handleClick">
    <el-tab-pane v-for="(items, index) in lang" v-bind:label="items.name" :tabID="items.language_id" :name="'tab'+index" :key="index">
        <product-general  v-bind:lang="items.language_id" :label="items.name" :image="items.image"></product-general>
    </el-tab-pane>
  </el-tabs>
</template>

<script>
import ProductGeneral from '../ProductGeneral/ProductGeneral.vue';
import api from '../../helpers/api';
export default {
  components: { ProductGeneral },
  data() {
      return {
        activeName: 'tab0',
        // lang: [],
      };
  },

  created() {
    // this.$bus.on('storeNewProductVariant', productVariant => {
    //   this.listProductVariants.data.unshift(productVariant.data);
    // });

    // this.$bus.on('deleteProductVariant', productVariant => {
    //   let position = this.listProductVariants.data.indexOf(productVariant);
    //   this.listProductVariants.data.splice(position, 1);
    // });
  },

  computed: {
    lang: {
      set() {
        return this.$store.state.a.lang;
      },
      get() {
         return this.$store.state.a.lang;
      },
    },
  },

  mounted() {
    this.getAllLangData();
  },

  methods: {
    updateLangID(content) {
      this.$store.dispatch('a/updateLangID', content);
    },
    async getAllLangData() {
      const url = 'admin/ajax/products/controller/lang';
      const langData = await api.request('GET', url);
      if (langData) {
         this.lang = langData.data.data;
         this.$store.dispatch('a/setLangData', langData.data.data);
      }
    },
    handleClick(tab, event) {
        this.updateLangID(tab.$attrs.tabID);
    },
  },
};
</script>