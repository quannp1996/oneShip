<template>
  <el-form label-width="140px">
    <!-- <el-form-item label="Tên Specialoffer">
      <el-input v-model="name"></el-input>
    </el-form-item> -->
    <el-form-item label="Giá trị khuyến mãi">
      <el-input v-model="offerDiscountValue"></el-input>
    </el-form-item>
    <el-form-item label="Trạng thái">
      <el-select v-model="status" placeholder="Select">
        <el-option
          v-for="item in optionsStatus"
          :key="item.value"
          :label="item.label"
          :value="item.value"
        >
        </el-option>
      </el-select>
    </el-form-item>
    <el-form-item label="Loại Specialoffer">
      <el-select style='width:300px'
        v-model="type"
        value-key=""
        placeholder=""
        clearable
        filterable
      >
        <el-option
          v-for="(item,index) in typeList"
          :key="index"
          :label="item"
          :value="index"
        >
        </el-option>
      </el-select>
    </el-form-item>
    <el-form-item label="Thời gian">
      <div class="block">
        <el-date-picker
          v-model="timepicker"
          type="datetimerange"
          start-placeholder="Thời gian bắt đầu"
          end-placeholder="Thời gian kết thúc"
          size="mini"
          value-format="timestamp"
        >
        </el-date-picker>
      </div>
    </el-form-item>
  </el-form>
</template>

<style>
.el-input {
  width: auto;
}
</style>
<script>
import api from '../../../helpers/api';
import numberFormat from '../../../mixins/numberFormat.js';

export default {
  name: 'General',
  mixins: [numberFormat],
  components: {},
  data() {
    return {
      optionsStatus: [{
        value: 1,
        label: 'Ẩn',
        }, {
        value: 2,
        label: 'Hiển thị',
      }],
        // timepicker: [],
    };
  },
  computed: {
    status: {
      get() {
        return this.$store.state.b.content.status;
      },
      set(value) {
        this.$store.dispatch('b/setStatus', value);
      },
    },
    timepicker: {
      get() {
        if (this.$store.state.b.content.offer_time_start === null && this.$store.state.b.content.offer_time_end === null) {
          return [];
        } else {
        return [this.$store.state.b.content.offer_time_start, this.$store.state.b.content.offer_time_end];
        }
      },
      set(value) {
          // console.log(value);
          if (value!=null) {
            this.$store.dispatch('b/setTimeStart', value[0]);
            this.$store.dispatch('b/setTimeEnd', value[1]);
          } else {
            this.$store.dispatch('b/setTimeStart', null);
            this.$store.dispatch('b/setTimeEnd', null);
          }
      },
    },
    // timepicker() {
    //   return [this.timepicker1, this.timepicker2];
    // },
    timepicker1() {
        return this.$store.state.b.content.offer_time_start;
    },
    timepicker2() {
        return this.$store.state.b.content.offer_time_end;
    },
    offerDiscountValue: {
      // eslint-disable-next-line vue/return-in-computed-property
      get() {
        if (typeof this.$store.state.b.content.offer_discount_value !== 'undefined') {
            const priceOrigin = this.$store.state.b.content.offer_discount_value;
            return this.numberFormat(priceOrigin);
        }
      },
      set(value) {
        this.$store.dispatch('b/setPriceDiscount', value.replace(/[^0-9]/g, ''));
      },
    },
    typeList() {
      return this.$store.state.b.type;
    },

    type: {
      get() {
        return this.$store.state.b.content.offer_discount_type;
      },
      set(value) {
        this.$store.dispatch('b/setTypeDiscount', value);
      },
    },
  },
  mounted() {
    this.gettypeList();
  },

  methods: {
    setTime() {
      this.$store.dispatch('b/setTimeStart', this.timepicker[0]);
      this.$store.dispatch('b/setTimeEnd', this.timepicker[1]);
    },
    async gettypeList() {
      const url = 'admin/ajax/specialoffer/controller/getTypeList';
      const type = await api.request('GET', url);
      this.$store.dispatch('b/setType', type.data.data);
    },
  },
};
</script>

<style></style>