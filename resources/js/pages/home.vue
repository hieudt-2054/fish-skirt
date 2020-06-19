<template>
  <div v-loading="!loaded">
    <el-card class="box-card" >
      <div class="row"  v-loading="loadedEat" v-if="dashboard.soCalo">
        <div class="col-md-3">
          <h5>Số calo hấp thụ trong ngày<br/> <span class="badge badge-success">{{ fixedNumber(dashboard.soCalo.calo) || 0 }}</span></h5>
        </div>
        <div class="col-md-3">
          <h5>Số calo còn lại trong ngày<br/> <span class="badge badge-warning">{{ fixedNumber(dashboard.soCaloConLai) || 0 }}</span></h5>
        </div>
        <div class="col-md-3">
          <h5>Số sản phẩm trong hệ thống<br/> <span class="badge badge-secondary">{{ dashboard.soSanpham || 0 }}</span></h5>
        </div>
        <div class="col-md-3">
          <h5>Lần cân nhỏ nhất 7 ngày qua<br/> <span class="badge badge-danger">{{ Math.min.apply(null, dashboard.weight7Day) }} KG</span></h5>
        </div>
      </div>
    </el-card>
    <div class="row mt-3" v-if="dashboard.calo7Day">
      <div class="col-md-6" v-loading="loadedChart2">
        <el-card class="box-card">
          <area-chart v-if="!rerender" :date="labelsDate" :type=1 :label="'Lượng calo hấp thụ trong 7 ngày gần đây'" :dataSet="dashboard.calo7Day"/>
        </el-card>
      </div>
      <div class="col-md-6">
        <div class="card scroll"  v-loading="loadedEat" v-if="dashboard.soCalo">
          <el-date-picker
            v-model="date"
            type="date"
            placeholder="Chọn ngày"
            format="dd/MM/yyyy"
      			value-format="yyyy-MM-dd"
            @change="refetchEat"
          >
          </el-date-picker>
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
    <div class="row mt-3" v-if="dashboard.weight7Day">
      <div class="col-md-6" v-loading="loadedChart1">
        <el-card class="box-card" v-if="labelsDate.length > 0">
          <area-chart v-if="!rerender" :date="labelsDate" :label="'Chỉ số cân thấp nhất trong 7 ngày gần đây'" :dataSet="dashboard.weight7Day"/>
        </el-card>
      </div>
      <div class="col-md-6" >
        <div class="card scroll" v-loading="loadedEat">
          <div class="card-body" v-if="dashboard.weightInDay && dashboard.weightInDay.length > 0">
            <h5 v-for="(item, index) in dashboard.weightInDay">
              Bạn vừa cân được <span class="badge badge-success">{{ fixedNumber(item, 2) }} Kg</span>
            </h5>
          </div>
          <div class="card-body" v-else>
              Chưa có dữ liệu cân nặng ngày hôm nay
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AreaChart from '../components/AreaChart.vue'
import axios from 'axios'
import moment from "moment";

export default {
  middleware: 'auth',
  data () {
    return {
      loaded: false,
      loadedEat: false,
      loadedChart1: false,
      loadedChart2: false,
      dashboard: [],
      rerender: false,
      datacollection: null,
      date: null,
      labelsDate: [
        moment().subtract(6, 'days').format('DD-MM-YYYY'),
        moment().subtract(5, 'days').format('DD-MM-YYYY'),
        moment().subtract(4, 'days').format('DD-MM-YYYY'),
        moment().subtract(3, 'days').format('DD-MM-YYYY'),
        moment().subtract(2, 'days').format('DD-MM-YYYY'),
        moment().subtract(1, 'days').format('DD-MM-YYYY'),
        moment().subtract(0, 'days').format('DD-MM-YYYY'),
      ],
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
    },
    async refetchEat (d) {
      this.rerender = true;
      this.labelsDate = [
          moment(d).subtract(6, 'days').format('DD-MM-YYYY'),
          moment(d).subtract(5, 'days').format('DD-MM-YYYY'),
          moment(d).subtract(4, 'days').format('DD-MM-YYYY'),
          moment(d).subtract(3, 'days').format('DD-MM-YYYY'),
          moment(d).subtract(2, 'days').format('DD-MM-YYYY'),
          moment(d).subtract(1, 'days').format('DD-MM-YYYY'),
          moment(d).subtract(0, 'days').format('DD-MM-YYYY'),
      ];
      this.loadedEat = true
      // this.loadedChart2 = true
      // this.loadedChart1 = true
      await axios.get('/api/dashboard', {
        params: {
          date: d
        }
      })
        .then((response) => {
          this.dashboard.soCalo = response.data.data.soCalo
          this.dashboard.weightInDay = response.data.data.weightInDay
          this.dashboard.soCaloConLai = response.data.data.soCaloConLai
          this.dashboard.weight7Day = response.data.data.weight7Day
          this.dashboard.calo7Day = response.data.data.calo7Day
        })
      this.loadedEat = false
      // this.loadedChart1 = false
      // this.loadedChart2 = false
      this.rerender = false;
    }
  }
}
</script>
