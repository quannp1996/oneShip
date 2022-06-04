<template>
  <v-col cols="6">
    <v-card class="mx-auto text-center" light>

      <v-card-title>Mã giảm giá</v-card-title>
      <v-card-text>
        <donut-chart :chart-data="datacollection" :options="options"></donut-chart>
      </v-card-text>
    </v-card>
  </v-col>
</template>

<script>
import api from "../helpers/api";
import DonutChart from './charts/DonutChart.js'
export default {
  name: "Dashboard",
  components: { DonutChart },
  data() {
    return {
      datacollection: {
        labels: [],
        datasets: [
          {
            label: '# Lượt sử dụng',
            data: []
          }
        ]
      },
      options: {
        tooltips: {
          callbacks: {
            label(tooltipItem, data) {
              let itemIdex = tooltipItem.index;
              let itemDataSetIndex = tooltipItem.datasetIndex;
              return data['datasets'][itemDataSetIndex]['data'][itemIdex] + ' lượt sử dụng';
            }
          }
        },


      },
    };
  },

  mounted() {
    this.getCouponStatistic();
  },

  methods: {
    async getCouponStatistic() {
      let result = await api.request('GET', 'dashboard/code-statistic');
      let revenueDashData = result.data;
      this.datacollection = revenueDashData.data;
    },

    randomColor() {
      return '#'+(Math.random()*0xFFFFFF<<0).toString(16);
    }
  },
};
</script>
