<template>
  <el-card class="box-card">
    <el-form ref="form" :model="form">
      <el-form-item>
        <el-col :span="4">
            <label>Tên SP</label>
          <el-input v-model="form.tensp" placeholder="Tên SP" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
             <label>Giá trị giảm cân</label>
          <el-input v-model="form.giamcan" placeholder="Giá trị giảm cân" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
             <label>Giá trị sức khỏe</label>
          <el-input v-model="form.suckhoe" placeholder="Giá trị sức khoẻ" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
             <label>Giá trị tăng cân</label>
          <el-input v-model="form.tangcan" placeholder="Giá trị tăng cân" />
        </el-col>
      </el-form-item>
      <el-form-item>
        <el-col :span="4">
             <label>Calories</label>
          <el-input v-model="form.nangluong" placeholder="Năng lượng" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
             <label>Chất béo</label>
          <el-input v-model="form.chatbeo" placeholder="Chất béo" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
             <label>Chất xơ</label>
          <el-input v-model="form.chatxo" placeholder="Chất xơ" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
             <label>Đường</label>
          <el-input v-model="form.duong" placeholder="Đường" />
        </el-col>
      </el-form-item>
      <el-form-item>
        <el-col :span="4">
             <label>Vitamin A</label>
          <el-input v-model="form.vitamina" placeholder="Vitamin A" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
             <label>Vitamin C</label>
          <el-input v-model="form.vitaminc" placeholder="Vitamin C" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
             <label>Canxi</label>
          <el-input v-model="form.canxi" placeholder="Canxi" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
             <label>Sắt</label>
          <el-input v-model="form.sat" placeholder="Sắt" />
        </el-col>
      </el-form-item>
      <el-form-item>
        <el-col :span="4">
             <label>Calo từ protein</label>
          <el-input v-model="form.caloriefromprotein" placeholder="Calories từ protein" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
             <label>Calo từ carb</label>
          <el-input v-model="form.caloriefromcarb" placeholder="Calories từ carb" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="4">
             <label>Calo từ Fat</label>
          <el-input v-model="form.caloriefromfat" placeholder="Calories từ Fat" />
        </el-col>
      </el-form-item>
      <el-form-item>
        <el-col :span="10">
             <label>Ưu điểm</label>
          <el-input v-model="form.uudiem" type="textarea" placeholder="Ưu điểm" />
        </el-col>
        <el-col class="line" :span="2">
  &nbsp;
        </el-col>
        <el-col :span="10">
             <label>Khuyết điểm</label>
          <el-input v-model="form.khuyetdiem" type="textarea" placeholder="Khuyết điểm" />
        </el-col>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onSubmit">
         <fa icon="check"/> Cập nhật
        </el-button>
        <el-button @click="formReset"><fa icon="trash"/> Xoá Form</el-button>
        <el-button type="info" @click="back">
          <fa icon="arrow-left"/> Quay lại
        </el-button>
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
  mounted () {
      this.getProduct()
  },
  watch: {
  },
  methods: {
    async getProduct () {
        await axios.get(`/api/thucpham/${this.$route.params.id}`)
        .then((res) => {
          this.form = res.data.data
        })
        .catch((err) => {
          this.$notify.error({
            title: 'Error',
            message: err.response.data.msg || 'Có lỗi xảy ra mất rồi'
          })
        })
    },
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

      axios.patch(`/api/thucpham/${this.$route.params.id}`, this.form)
        .then(() => {
          this.$notify({
            title: 'Success',
            message: 'Cập nhật sản phẩm thành công',
            type: 'success'
          })
          this.$router.push({ name: 'listFood'})
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
    },
    back() {
      this.$router.push({ name: 'listFood' })
    }
  }
}
</script>
