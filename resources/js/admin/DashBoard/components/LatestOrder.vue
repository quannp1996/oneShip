<template>
  <v-col cols="6">
    <v-card class="mx-auto text-center" color="orange" dark>
      <v-card-title>Đơn hàng mới nhất</v-card-title>
      <v-card-text>
          <v-sparkline
            :value="value"
            color="rgba(255, 255, 255, .7)"
            height="100"
            padding="24"
            stroke-linecap="round"
            smooth
          >
            <template v-slot:label="item"> ${{ item.value }} </template>
          </v-sparkline>
      </v-card-text>
    </v-card>
  </v-col>
</template>

<script>
import api from "../helpers/api";
export default {
  name: "Dashboard",
  data() {
    return {
      value: [423, 446, 675, 510, 590, 610, 760],
      loading: false,
    };
  },

  mounted() {
    console.log("Revenue chart");
  },

  methods: {
    async getRevenue() {
      this.loading = true;
      let result = await api.request("GET", "dashboard/orders-statistic");
      this.statistic = result.data;
      this.loading = false;
    },
  },
};
</script>
