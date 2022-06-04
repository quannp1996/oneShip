<template>
    <el-dialog
    title="Cảnh báo"
    :visible.sync="checkPrdDialogVisible"
    width="30%"
    center>
    <div v-if="Object.keys(checkDuplicate).length > 0" class='text-danger' style="text-align: center; word-break: break-word">Có sản phẩm bị trùng trong chiến dịch khác ( nhấn (x) để xóa khỏi danh sách khuyến mãi này hoặc ấn <i>"Đồng bộ và Lưu"</i> để chấp nhận sản phẩm trong danh sách trên và xóa chúng ở chiến dịch bị trùng):</div>
    <div v-else>Đã hết sản phẩm bị trùng vui lòng ấn <i>Thoát</i></div>
    <div v-for="(items, index) in checkDuplicate" :key="index">
          <span> -
            {{collection[index].name}}
          </span>
          <a href="javascript:void(0)"><i class="el-icon-error" style="margin-left:4px" @click="removeElement(index)"></i></a>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="checkPrdDialogVisible = false">Thoát</el-button>
      <el-button v-if="Object.keys(checkDuplicate).length > 0"  type="primary" @click="syncPromotionCampaign">Đồng bộ và Lưu</el-button>
    </span>
  </el-dialog>
</template>

<script>
  import api from '../../../../helpers/api';
  import messageMixin from '../../../../mixins/messageMixin.js';
  import { eventBus } from '../../../../app.js';
  export default {
    mixins: [messageMixin],
    data() {
      return {
      };
    },
    computed: {
      checkPrdDialogVisible: {
        set(value) {
          this.$store.state.b.checkPrdDialogVisible = value;
        },
        get() {
           return this.$store.state.b.checkPrdDialogVisible;
        },
      },
      checkDuplicate() {
        return this.$store.state.b.checkDuplicate;
      },
      collection() {
        return this.$store.state.b.collection;
      },
    },
    methods: {
      save() {
        eventBus.$emit('fireMethod2');
      },
      async syncPromotionCampaign() {
        const prdSync = this.$store.state.b.checkDuplicate;
        const url = `admin/ajax/promotionCampaign/controller/${this.$route.query.id}/syncPromotionCampaign`;
        const collection = await api.request('POST', url, { prdSync });
        if (!collection.data.error) {
           this.checkPrdDialogVisible = false;
           this.save();
        } else {
           this.showMessage( collection.data.msg, 'error');
        }
      },
      removeElement(index) {
        const conf = confirm('Bạn có chắc muốn bỏ sản phẩm này khỏi danh sách');
        if (conf == true) {
           this.$store.dispatch('b/removeElement', index);
            this.$store.dispatch('b/removeCheckDuplicate', index);
        }
      },
    },
  };
</script>
