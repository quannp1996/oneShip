<template>
  <div>
    <!-- <v-row class="d-flex pa-md-4" dense  v-if="this.loading">
      <v-col>
        <v-skeleton-loader type="card-avatar"></v-skeleton-loader>
      </v-col>

       <v-col>
        <v-skeleton-loader type="card"></v-skeleton-loader>
      </v-col>

       <v-col>
        <v-skeleton-loader type="card"></v-skeleton-loader>
      </v-col>

       <v-col>
        <v-skeleton-loader type="card"></v-skeleton-loader>
      </v-col>
    </v-row> -->

    <v-row class="d-flex pa-md-4" dense>
      <v-col>
        <v-card dark color="green">
          <v-card-title>Đơn hàng</v-card-title>
          <v-card-subtitle class="py-0">
            <b>{{ statistic.data.total_order_paid }}</b> Đã thanh toán
          </v-card-subtitle>

          <v-card-subtitle class="py-2">
            <b>{{ statistic.data.total_order_unpaid }}</b> Chưa thanh toán
          </v-card-subtitle>
        </v-card>
      </v-col>

      <v-col>
        <v-card dark color="blue">
          <v-card-title>Khách hàng</v-card-title>
          <v-card-subtitle class="py-0">
            <b>{{ statistic.data.total_customer_active }}</b> Active
          </v-card-subtitle>
          <v-card-subtitle class="py-2">
            <b>{{ statistic.data.total_customer_unactive }}</b> Chưa active
          </v-card-subtitle>
        </v-card>
      </v-col>

      <v-col>
        <v-card dark color="orange">
          <v-card-title>Doanh số</v-card-title>
          <v-card-subtitle class="py-0">
            <b>{{ statistic.data.total_order_revenue_success_txt }}</b> Thành công
          </v-card-subtitle>
          <v-card-subtitle class="py-2">
            <b>{{ statistic.data.total_order_revenue_expect_txt }}</b> Dự kiến
          </v-card-subtitle>
        </v-card>
      </v-col>

      <v-col>
        <v-card dark color="purple">
          <v-card-title>Đăng ký mới</v-card-title>
          <v-card-subtitle class="py-0">
            <b>{{ statistic.data.total_new_register }}</b> Đăng ký
          </v-card-subtitle>

          <v-card-subtitle class="py-2">&nbsp;</v-card-subtitle>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import api from "../helpers/api";

export default {
  name: "Dashboard",
  data() {
    return {
      statistic: {
        data: {
          total_order_paid: 0,
          total_order_unpaid: 0,
          total_customer_active: 0,
          total_customer_unactive: 0,
          total_order_revenue_success_txt: 0,
          total_order_revenue_expect_txt: 0,
          total_new_register: 0,
        },
      },

      loading: false,
    };
  },

  mounted() {
    this.getDashboardStatistic();
  },

  methods: {
    async getDashboardStatistic() {
      this.loading = true;
      let result = await api.request("GET", "dashboard/orders-statistic");
      this.statistic = result.data;
      this.loading = false;
    },

    redirectRouting(url = "") {
      window.location.href = url;
    },
  },
};
</script>
