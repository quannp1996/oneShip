<template>
  <v-col cols="6">
    <v-card class="mx-auto text-center" light>
      <v-card-title>Biểu đồ thể hiện sức mua</v-card-title>
      <v-card-text>
          <line-chart :chart-data="datacollection" :options="options"></line-chart>
      </v-card-text>
    </v-card>
  </v-col>
</template>

<script>
import api from "../helpers/api";
import LineChart from './charts/LineChart.js'
export default {
  name: "Order",
  components: { LineChart },
  data() {
    return {
      datacollection: {
        labels: [],
        datasets: [
          {
            label: '# Doanh số',
            data: []
          }
        ]
      },
      options: {
        // tooltips: {
        //   callbacks: {
        //     label(tooltipItem, data) {
        //       let index = tooltipItem.index;
        //       return 'Doanh số: ' + data.revenue_txt[index];
        //     }
        //   }
        // },

        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
              },
            },
          ],
        },
      },
    };
  },

  mounted() {
    this.getOrderPurchasedAbilityStatistic();
  },

  methods: {
    async getOrderPurchasedAbilityStatistic() {
      let result = await api.request('GET', 'dashboard/purchased-ability');
      let result_data = result.data;
      this.datacollection = result_data.data;
    },
  },
};
</script>
