import { Doughnut } from 'vue-chartjs';

export default {
  extends: Doughnut,
  props: ['chartData', 'options'],

  mounted() {
    this.renderChart(this.chartData, this.options)
  },

  
  watch: {
    chartData: {
      deep: true,
      handler() {
        this.renderChart(this.chartData, this.options);
      }
    }
  }
};
