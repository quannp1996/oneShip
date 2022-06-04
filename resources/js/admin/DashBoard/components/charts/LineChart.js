import { Line } from 'vue-chartjs'

export default {
  extends: Line,

  props: ['options', 'chartData'],

  mounted () {

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
}
