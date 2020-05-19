<script>
import { Line } from "vue-chartjs";
import moment from "moment";

export default {
  extends: Line,
  props: ['dataSet'],
  
  data() {
    return {
      dataCalo: this.dataSet,
      gradient: null,
      gradient2: null
    };
  },
  mounted() {
    let data = this.dataSet
    this.gradient = this.$refs.canvas
      .getContext("2d")
      .createLinearGradient(0, 0, 0, 450);
    this.gradient2 = this.$refs.canvas
      .getContext("2d")
      .createLinearGradient(0, 0, 0, 450);

    this.gradient.addColorStop(0, "rgba(255, 0,0, 0.5)");
    this.gradient.addColorStop(0.5, "rgba(255, 0, 0, 0.25)");
    this.gradient.addColorStop(1, "rgba(255, 0, 0, 0)");

    this.gradient2.addColorStop(0, "rgba(0, 231, 255, 0.9)");
    this.gradient2.addColorStop(0.5, "rgba(0, 231, 255, 0.25)");
    this.gradient2.addColorStop(1, "rgba(0, 231, 255, 0)");

    this.renderChart(
      {
        labels: [
          moment().subtract(6, 'days').format('DD-MM-YYYY'),
          moment().subtract(5, 'days').format('DD-MM-YYYY'),
          moment().subtract(4, 'days').format('DD-MM-YYYY'),
          moment().subtract(3, 'days').format('DD-MM-YYYY'),
          moment().subtract(2, 'days').format('DD-MM-YYYY'),
          moment().subtract(1, 'days').format('DD-MM-YYYY'),
          moment().subtract(0, 'days').format('DD-MM-YYYY'),
        ],
        datasets: [
          {
            label: "Lượng calo hấp thụ trong 7 ngày gần đây",
            borderColor: "#FC2525",
            pointBackgroundColor: "white",
            borderWidth: 1,
            pointBorderColor: "white",
            backgroundColor: this.gradient,
            data: this.dataSet
          },
        ]
      },
      { responsive: true, maintainAspectRatio: false }
    );
  }
};
</script>
