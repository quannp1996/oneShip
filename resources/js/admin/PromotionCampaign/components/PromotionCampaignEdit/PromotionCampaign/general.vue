<template>
  <el-form label-width="150px">
    <!-- <el-form-item label="Tên Specialoffer">
      <el-input v-model="name"></el-input>
    </el-form-item> -->
    <el-form-item label="Giá trị khuyến mãi %">
      <el-input v-model="offerDiscountValue"></el-input>
    </el-form-item>
     <el-form-item label="Giá trị đồng giá" v-if="formatPrice == 'parity'">
      <el-input v-model="offerParityPrice"></el-input>
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
    <el-form-item label="Loại chiến dịch">
      <el-select
        style="width:300px"
        v-model="format"
        value-key=""
        placeholder=""
        clearable
        filterable
      >
        <el-option
          v-for="(item, index) in formatList"
          :key="index"
          :label="item"
          :value="index"
        >
        </el-option>
      </el-select>
    </el-form-item>
    <el-form-item label="Loại giá sản phẩm">
      <el-select
        style="width:300px"
        v-model="formatPrice"
        value-key=""
        placeholder=""
        clearable
        filterable
      >
        <el-option
          v-for="(item, index) in formatPriceList"
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
    <el-form-item label="Timeline" v-if="format === 'flash'">
       <el-button  type="primary" @click="addTimeline"
          ><i class="fa fa-plus"></i></el-button>
        <el-time-select class='mg-left-10' v-for="(items,index) in timeline" :key="index" v-model="items.value" placeholder="Select timeline" @change="updateTimeline" :picker-options="{
            start: '00:00',
            step: '00:15',
            end: '24:00'
        }">
        </el-time-select>
    </el-form-item>
  </el-form>
</template>

<style>
@import "../../../css/general.css";
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
      optionsStatus: [
        {
          value: 1,
          label: 'Ẩn',
        },
        {
          value: 2,
          label: 'Hiển thị',
        },
      ],
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
    timeline() {
         return this.$store.state.b.timeline;
    },
    timepicker: {
      get() {
        if (
          this.$store.state.b.content.start_date === null &&
          this.$store.state.b.content.end_date === null
        ) {
          return [];
        } else if (
          this.$store.state.b.content.start_date === 0 &&
          this.$store.state.b.content.end_date === 0
        ) {
          return [];
        } else {
          return [
            this.$store.state.b.content.start_date,
            this.$store.state.b.content.end_date,
          ];
        }
      },
      set(value) {
        // console.log(value);
        if (value != null) {
          this.$store.dispatch('b/setTimeStart', value[0]);
          this.$store.dispatch('b/setTimeEnd', value[1]);
        } else {
          this.$store.dispatch('b/setTimeStart', null);
          this.$store.dispatch('b/setTimeEnd', null);
        }
      },
    },
    offerDiscountValue: {
      // eslint-disable-next-line vue/return-in-computed-property
      get() {
        if (
          typeof this.$store.state.b.content.promote_percent !== 'undefined'
        ) {
          // const priceOrigin = this.$store.state.b.content.promote_percent;
          // return this.numberFormat(priceOrigin);
          if (this.$store.state.b.content.promote_percent <= 100) {
            return this.$store.state.b.content.promote_percent;
          } else {
            return 100;
          }
        }
      },
      set(value) {
        this.$store.dispatch(
          'b/setPromotePercentDiscount',
          value.replace(/[^0-9]/g, ''),
        );
      },
    },
    offerParityPrice: {
       // eslint-disable-next-line vue/return-in-computed-property
      get() {
        if (
          typeof this.$store.state.b.content.parity_price !== 'undefined'
        ) {
          const priceOrigin = this.$store.state.b.content.parity_price;
          return this.numberFormat(priceOrigin);
        }
      },
      set(value) {
        this.$store.dispatch(
          'b/setParityPrice',
          value.replace(/[^0-9]/g, ''),
        );
      },
    },
    formatList() {
      return this.$store.state.b.formating;
    },
    formatPriceList() {
      return this.$store.state.b.formatprice;
    },
    format: {
      get() {
        return this.$store.state.b.content.formating;
      },
      set(value) {
        this.$store.dispatch('b/setFormatDiscount', value);
      },
    },
    formatPrice: {
      get() {
        return this.$store.state.b.content.formatprice;
      },
      set(value) {
        this.$store.dispatch('b/setFormatPrice', value);
      },
    },
  },
  mounted() {
    this.gettypeList();
    this.gettypePriceList();
  },

  methods: {
    addTimeline() {
        this.timeline.push({ value: '' });
    },
    updateTimeline() {
        this.$store.dispatch('b/updateTimeline', this.timeline);
    },

    setTime() {
      this.$store.dispatch('b/setTimeStart', this.timepicker[0]);
      this.$store.dispatch('b/setTimeEnd', this.timepicker[1]);
    },
    async gettypeList() {
      const url = 'admin/ajax/promotionCampaign/controller/getFormatList';
      const format = await api.request('GET', url);
      this.$store.dispatch('b/setFormat', format.data.data);
    },
    async gettypePriceList() {
      const url = 'admin/ajax/promotionCampaign/controller/getFormatPrice';
      const format = await api.request('GET', url);
      this.$store.dispatch('b/setFormatPriceList', format.data.data);
    },
  },
};
</script>
