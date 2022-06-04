import { Bar, mixins } from 'vue-chartjs';

export default {
  extends: Bar,
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
