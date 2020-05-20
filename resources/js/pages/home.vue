<template>
  <div>
    <el-card class="box-card">
      <div class="row" v-if="loaded">
        <div class="col-md-3">
          <h5>Số calo hấp thụ trong ngày <span class="badge badge-success">{{ fixedNumber(dashboard.soCalo.calo) || 0 }}</span></h5>
        </div>
        <div class="col-md-3">
          <h5>Số calo còn lại trong ngày <span class="badge badge-warning">{{ fixedNumber(dashboard.soCaloConLai) || 0 }}</span></h5>
        </div>
        <div class="col-md-3">
          <h5>Số sản phẩm trong hệ thống <span class="badge badge-secondary">{{ dashboard.soSanpham || 0 }}</span></h5>
        </div>
        <div class="col-md-3">
          <h5>Lần cân nhỏ nhất 7 ngày qua <span class="badge badge-danger">{{ Math.min.apply(null, dashboard.weight7Day) }} KG</span></h5>
        </div>
      </div>
    </el-card>
    <div class="row mt-3">
      <div class="col-md-6">
        <el-card class="box-card">
          <area-chart v-if="loaded" :type=1 :label="'Lượng calo hấp thụ trong 7 ngày gần đây'" :dataSet="dashboard.calo7Day"/>
        </el-card>
      </div>
      <div class="col-md-6" v-if="loaded">
        <div class="card scroll">
          <div class="card-body" v-if="dashboard.soCalo.history && dashboard.soCalo.history.length > 0">
            <h5 v-for="(item, index) in dashboard.soCalo.history">
              Bạn đã hấp thụ <span class="badge badge-success">{{ fixedNumber(item.calo) }} calo</span> từ 
              <span class="badge badge-secondary">{{ item.name }}</span>
            </h5>
          </div>
          <div class="card-body" v-else>
              Chưa có dữ liệu ăn uống ngày hôm nay
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-6">
        <el-card class="box-card">
          <area-chart v-if="loaded" :label="'Chỉ số cân thấp nhất trong 7 ngày gần đây'" :dataSet="dashboard.weight7Day"/>
        </el-card>
      </div>
      <div class="col-md-6" v-if="loaded">
        <div class="card scroll">
          <div class="card-body" v-if="dashboard.weightInDay && dashboard.weightInDay.length > 0">
            <h5 v-for="(item, index) in dashboard.weightInDay">
              Bạn vừa cân được <span class="badge badge-success">{{ fixedNumber(item, 2) }} Kg</span>
            </h5>
          </div>
          <div class="card-body" v-else>
              Chưa có dữ liệu ăn uống ngày hôm nay
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AreaChart from '../components/AreaChart.vue'
import axios from 'axios'

export default {
  middleware: 'auth',
  data () {
    return {
      loaded: false,
      dashboard: [],
      datacollection: null,
    }
  },
  components: {
    AreaChart
  },
  metaInfo () {
    return { title: this.$t('home') }
  },
  mounted () {
    this.fillData()
  },
  async created () {
    this.loaded = false
    await axios.get('/api/dashboard')
      .then((response) => {
        this.dashboard = response.data.data
      })
    this.loaded = true
  },
  methods: {
    fixedNumber(num, point = 0) {
      if (num) {
        return num.toFixed(point);
      }

      return num;
    },
    fillData () {
      this.datacollection = {
        labels: [this.getRandomInt(), this.getRandomInt()],
        datasets: [
          {
            label: 'Data One',
            backgroundColor: 'white',
            data: [this.getRandomInt(), this.getRandomInt()]
          }, {
            label: 'Data One',
            backgroundColor: '#f87979',
            data: [this.getRandomInt(), this.getRandomInt()]
          }
        ]
      }
    },
    getRandomInt () {
      return Math.floor(Math.random() * (50 - 5 + 1)) + 5
    }
  }
}
</script>
