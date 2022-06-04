<template>
  <el-dropdown-item icon="el-icon-delete">
    <el-button type="text" @click="open">Xóa biến thể</el-button>
  </el-dropdown-item>
</template>

<script>
import api from '../../helpers/api.js';
import messageMixin from '../../mixins/messageMixin.js';
import { eventBus } from '../../app.js';

export default {
  mixins: [messageMixin],
  props: ['productVariant'],

  methods: {
    someComponent2Method: function() {
            // your code here
                eventBus.$emit('fireMethod');
    },
    open() {
      this.$confirm('Xóa biến thể sản phẩm. Tiếp tục?', 'Warning', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Hủy',
        type: 'warning',
      }).then(() => {
        return this.deleteProductVariant();
      });
    },

    async deleteProductVariant() {
      const url = `admin/ajax/products/${this.productVariant.product_id}/variants/${this.productVariant.product_variant_id}`;
      const result = await api.request('DELETE', url);
      if (result.data.success) {
        this.showMessage(result.data.message, 'success');
        // this.$bus.emit('deleteProductVariant', this.productVariant);
        this.$store.dispatch('b/deleteArrIDVariantAdd', this.productVariant.product_variant_id);
        this.someComponent2Method();
      }
    },
  },
};
</script>