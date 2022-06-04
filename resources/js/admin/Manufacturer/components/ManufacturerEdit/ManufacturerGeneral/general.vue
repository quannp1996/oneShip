<template>
  <el-form label-width="120px">
    <el-form-item label="Tên thương hiệu">
      <el-input v-model="name"></el-input>
    </el-form-item>
    <el-form-item label="Thứ tự">
      <el-input v-model="sort_order"></el-input>
    </el-form-item>
  </el-form>
</template>

<style></style>
<script>
import api from '../../../helpers/api';
import numberFormat from '../../../mixins/numberFormat.js';

export default {
  name: 'General',
  mixins: [numberFormat],
  components: {},
  data() {
    return {};
  },
  computed: {
    name: {
      get() {
        return this.$store.state.b.content.name;
      },
      set(value) {
        this.$store.dispatch('b/setName', value);
      },
    },
    sort_order: {
      // eslint-disable-next-line vue/return-in-computed-property
      get() {
        if (typeof this.$store.state.b.content.sort_order !== 'undefined') {
          const priceOrigin = this.$store.state.b.content.sort_order;
          return priceOrigin;
        }
      },
      set(value) {
        this.$store.dispatch('b/setSortOrder', value.replace(/[^0-9]/g, ''));
      },
    },
  },
  mounted() {},

  methods: {},
};
</script>

<style></style>