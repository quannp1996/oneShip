<template>
  <v-col cols="6">
    <v-card light >
      <v-card-title color="orange">Biểu đồ doanh số</v-card-title>
      <v-card-text>
          <bar-chart :chart-data="datacollection" :options="options"></bar-chart>
      </v-card-text>
    </v-card>
  </v-col>
</template>

<script>
import api from '../helpers/api.js'
import LineChart from "./charts/LineChart.js";
import BarChart from "./charts/BarChart.js";

export default {
  components: {
    LineChart,
    BarChart,
  },

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
        tooltips: {
          callbacks: {
            label(tooltipItem, data) {
              let index = tooltipItem.index;
              return 'Doanh số: ' + data.revenue_txt[index];
            }
          }
        },

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
    this.getRevenueByRangeDate();
  },

  methods: {
    async getRevenueByRangeDate() {
      let revenueDash = await api.request('GET', 'dashboard/revenue');
      let revenueDashData = revenueDash.data;
      this.datacollection = revenueDashData.data;
    },
  },
};
</script>

<style>

</style>
