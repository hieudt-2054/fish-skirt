<template>
  <el-card class="box-card">
    <div class="row">
      <div class="col-sm">
        <h3>Số calo hấp thụ trong ngày <span class="badge badge-success">{{ fixedNumber(dashboard.soCalo) || 0 }}</span></h3>
      </div>
      <div class="col-sm">
        <h3>Số sản phẩm trong hệ thống <span class="badge badge-secondary">{{ dashboard.soSanpham || 0 }}</span></h3>
      </div>
      <!-- <div class="col-sm">
        <h3>Example heading <span class="badge badge-secondary">New</span></h3>
      </div>
      <div class="col-sm">
        <h3>Example heading <span class="badge badge-secondary">New</span></h3>
      </div> -->
    </div>
  </el-card>
</template>

<script>
import axios from 'axios'

export default {
  middleware: 'auth',
  data () {
    return {
      dashboard: [],
    }
  },
  metaInfo () {
    return { title: this.$t('home') }
  },
  async created () {
    await axios.get('/api/dashboard')
      .then((response) => {
        this.dashboard = response.data.data
      })
  },
  methods: {
    fixedNumber(num) {
      if (num) {
        return num.toFixed(2);
      }

      return num;
    }
  }
}
</script>
