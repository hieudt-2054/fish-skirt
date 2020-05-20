<template>
  <div>
    <el-card class="box-card mb-2">
      <el-button type="primary" @click="pushRoter()">Thêm dòng chi tiêu</el-button>
    </el-card>
      <el-card class="box-card mt-2">
      <div class="row" v-if="loaded">
        <div class="col-md-3">
          <h5>Số tiền tiêu trong ngày <span class="badge badge-success">{{ dashboard.chi }}</span></h5>
        </div>
        <div class="col-md-3">
          <h5>Số tiền nhận trong ngày <span class="badge badge-warning">{{ dashboard.thu }}</span></h5>
        </div>
        <div class="col-md-3">
          <h5>Số tiền tiêu trong tháng <span class="badge badge-secondary">{{ 0 }}</span></h5>
        </div>
        <div class="col-md-3">
          <h5>Số tiền tiêu trong tháng <span class="badge badge-danger">{{ 0 }}</span></h5>
        </div>
      </div>
    </el-card>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  middleware: 'auth',
  data () {
    return {
        loaded: false,
        dashboard: [],
    }
  },
  metaInfo () {
    return { title: this.$t('home') }
  },
  mounted () {
  },
  async created () {
    this.loaded = false
    await axios.get('/api/dashboardspend')
      .then((response) => {
        this.dashboard = response.data.data
      })
    this.loaded = true
  },
  methods: {
    fixedNumber(num) {
      if (num) {
        return num.toFixed(0);
      }

      return num;
    },
    pushRoter () {
        this.$router.push({ name: 'spendAdd'});
    }
  }
}
</script>
