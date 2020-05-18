<template>
  <div>
    <el-card class="box-card">
      <div class="row">
        <div class="col-md-3">
          <h5>Số calo hấp thụ trong ngày <span class="badge badge-success">{{ fixedNumber(dashboard.soCalo) || 0 }}</span></h5>
        </div>
        <div class="col-md-3">
          <h5>Số calo còn lại trong ngày <span class="badge badge-warning">{{ fixedNumber(dashboard.soCaloConLai) || 0 }}</span></h5>
        </div>
        <div class="col-md-3">
          <h5>Số sản phẩm trong hệ thống <span class="badge badge-secondary">{{ dashboard.soSanpham || 0 }}</span></h5>
        </div>
        <div class="col-md-3">
          <h5>Tr bình số cân giảm 7 ngày qua <span class="badge badge-danger">0</span></h5>
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
        return num.toFixed(0);
      }

      return num;
    }
  }
}
</script>
