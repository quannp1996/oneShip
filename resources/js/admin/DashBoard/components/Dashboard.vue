<template>
  <v-app class="overflow-hidden"
    style="position: relative;">
    <overview></overview>
    <v-row dense class="d-flex pa-md-4">
      <revenue-chart></revenue-chart>
      <order></order>
    </v-row>

    <v-row dense class="d-flex pa-md-4">
      <coupon></coupon>
      <top-products @showDrawer="showDialog=!showDialog"></top-products>
    </v-row>

    <v-row dense class="d-flex pa-md-4">
      <!-- <latest-order></latest-order>
      <customer-activity></customer-activity> -->
    </v-row>

     <v-bottom-sheet v-model="showDialog">
      <v-sheet
        class="text-center"
        height="500px"
      >
        <v-btn
          class="mt-6"
          text
          color="red"
          @click="sheet = !sheet"
        >
          close
        </v-btn>
        <div class="py-3">
          This is a bottom sheet using the controlled by v-model instead of activator
        </div>
      </v-sheet>
    </v-bottom-sheet>
  </v-app>
</template>

<script>
import api from "../helpers/api";
import Overview from './Overview.vue'
import RevenueChart from './RevenueChart.vue'
import TopProducts from './TopProducts.vue'
import Order from './Order.vue'
import Coupon from './Coupon.vue'
import LatestOrder from './LatestOrder'
import CustomerActivity from './CustomerActivity'
export default {
  name: "Dashboard",
  components: {
    Overview,
    RevenueChart,
    TopProducts,
    Order,
    Coupon,
    LatestOrder,
    CustomerActivity,

  },
  data() {
    return {
      showDialog: false
    };
  },

  mounted() {

  },

  methods: {

  },
};
</script>
