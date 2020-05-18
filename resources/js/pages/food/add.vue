<template>
  <el-card class="box-card">
    <el-form ref="form" :model="form">
      <el-form-item>
        <el-input v-model="urlImport" placeholder="Nhập link sản phẩm để tạo dữ liệu tự động (VD: http://www.thehinhonline.com.vn/food/nutrition/bananas-nutrition-fact)">
          <template slot="prepend">
            Auto
          </template>
        </el-input>
      </el-form-item>
      <el-form-item>
        <el-col :span="4">
          <el-input v-model="form.tensp" placeholder="Tên SP" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
          <el-input v-model="form.giamcan" placeholder="Giá trị giảm cân" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
          <el-input v-model="form.suckhoe" placeholder="Giá trị sức khoẻ" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
          <el-input v-model="form.tangcan" placeholder="Giá trị tăng cân" />
        </el-col>
      </el-form-item>
      <el-form-item>
        <el-col :span="4">
          <el-input v-model="form.nangluong" placeholder="Năng lượng" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
          <el-input v-model="form.chatbeo" placeholder="Chất béo" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
          <el-input v-model="form.chatxo" placeholder="Chất xơ" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
          <el-input v-model="form.duong" placeholder="Đường" />
        </el-col>
      </el-form-item>
      <el-form-item>
        <el-col :span="4">
          <el-input v-model="form.vitamina" placeholder="Vitamin A" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
          <el-input v-model="form.vitaminc" placeholder="Vitamin C" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
          <el-input v-model="form.canxi" placeholder="Canxi" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
          <el-input v-model="form.sat" placeholder="Sắt" />
        </el-col>
      </el-form-item>
      <el-form-item>
        <el-col :span="4">
          <el-input v-model="form.caloriefromprotein" placeholder="Calories từ protein" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
          <el-input v-model="form.caloriefromcarb" placeholder="Calories từ carb" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
          <el-input v-model="form.caloriefromfat" placeholder="Calories từ Fat" />
        </el-col>
      </el-form-item>
      <el-form-item>
        <el-col :span="10">
          <el-input v-model="form.uudiem" type="textarea" placeholder="Ưu điểm" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="10">
          <el-input v-model="form.khuyetdiem" type="textarea" placeholder="Khuyết điểm" />
        </el-col>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onSubmit">
          Tạo
        </el-button>
        <el-button @click="formReset">Xoá Form</el-button>
      </el-form-item>
    </el-form>
  </el-card>
</template>

<script>
import cheerio from 'cheerio'
import axios from 'axios'

export default {
  data () {
    return {
      urlImport: null,
      form: {
        tensp: null,
        nangluong: null,
        chatbeo: null,
        chatxo: null,
        duong: null,
        vitamina: null,
        vitaminc: null,
        canxi: null,
        sat: null,
        giamcan: null,
        suckhoe: null,
        tangcan: null,
        caloriefromprotein: null,
        caloriefromcarb: null,
        caloriefromfat: null,
        uudiem: null,
        khuyetdiem: null
      }
    }
  },
  watch: {
    async urlImport (newVal) {
      if (newVal === null || newVal === '') {
        return;
      }
      let loading = this.$loading({
        lock: true,
        text: 'Loading',
        spinner: 'el-icon-loading',
        background: 'rgba(0, 0, 0, 0.7)'
      })
      var el = null
      await axios.post(`/api/fetch/`, {
        url: newVal
      })
        .then((response) => {
          el = cheerio.load(response.data.data)
          loading.close()
        }).catch((err) => {
          loading.close()
          this.$notify.error({
            title: 'Error',
            message: 'Có lỗi xảy ra mất rồi'
          })
        })
      this.form.tensp = this.ucwords(el('h1.pull-left').text().replace('Giá trị dinh dưỡng của ', ''))
      this.form.giamcan = parseFloat(el('.panel-body p strong').slice(0).eq(0).text().replace('%', ''))
      this.form.suckhoe = parseFloat(el('.panel-body p strong').slice(1).eq(0).text().replace('%', ''))
      this.form.tangcan = parseFloat(el('.panel-body p strong').slice(2).eq(0).text().replace('%', ''))
      this.form.nangluong = parseFloat(el('tbody tr td').slice(0).eq(0).text().replace('Năng lượng ', ''))
      this.form.chatbeo = parseFloat(el('tbody tr td').slice(2).eq(0).text().replace('Chất béo ', '').replace('g', '').replace(',', '.'))
      this.form.chatxo = parseFloat(el('tbody tr td').slice(12).eq(0).text().replace('- Chất xơ ', '').replace(',', '.'))
      this.form.duong = parseFloat(el('tbody tr td').slice(14).eq(0).text().replace('- Đường ', '').replace(',', '.'))
      this.form.vitamina = parseFloat(el('tbody tr td').slice(18).eq(0).text().replace('Vitamin A', '').replace('%', ''))
      this.form.vitaminc = parseFloat(el('tbody tr td').slice(19).eq(0).text().replace('Vitamin C', '').replace('%', ''))
      this.form.canxi = parseFloat(el('tbody tr td').slice(20).eq(0).text().replace('Canxi', '').replace('%', ''))
      this.form.sat = parseFloat(el('tbody tr td').slice(21).eq(0).text().replace('Sắt', '').replace('%', ''))
      this.form.caloriefromprotein = parseFloat(el('.progress-bar-success').slice(1).eq(0).attr('aria-valuenow'))
      this.form.caloriefromcarb = parseFloat(el('.progress-bar-warning').slice(1).eq(0).attr('aria-valuenow'))
      this.form.caloriefromfat = parseFloat(el('.progress-bar-danger').slice(1).eq(0).attr('aria-valuenow'))
      this.form.uudiem = el('.panel-body p').slice(3).eq(0).text().replace('Ưu điểm: ', '')
      this.form.khuyetdiem = el('.panel-body p').slice(4).eq(0).text().replace('Khuyết điểm: ', '')
    }
  },
  methods: {
    ucwords (str) {
      return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase()
      })
    },
    onSubmit () {
      var s = this.form
      Object.keys(s).forEach(function(key) {
          if(s[key] === null) {
              s[key] = 0;
          }
      })

      axios.post('/api/thucpham/', this.form)
        .then(() => {
          this.$notify({
            title: 'Success',
            message: 'Thêm mới sản phẩm thành công',
            type: 'success'
          })
          this.formReset()
        })
        .catch((err) => {
          this.$notify.error({
            title: 'Error',
            message: err.response.data.msg || 'Có lỗi xảy ra mất rồi'
          })
        })
    },
    formReset () {
      let setAll = (obj, val) => Object.keys(obj).forEach(k => obj[k] = val)
      let setNull = obj => setAll(obj, null)
      setNull(this.form)
      this.urlImport = null
    }
  }
}
</script>
