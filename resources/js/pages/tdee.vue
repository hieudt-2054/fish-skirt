<template>
  <div>
    <el-alert
    title="VUI LÒNG DÀNH 1 CHÚT THỜI GIAN ĐỂ KHỞI TẠO DỮ LIỆU ĐẦU VÀO CỦA HỆ THỐNG"
    type="info"
    show-icon>
  </el-alert><br/>
    <el-card class="box-card" >
        <el-steps :active="active" align-center finish-status="success">
            <el-step title="Bước 1"></el-step>
            <el-step title="Bước 2"></el-step>
            <el-step title="Bước 3"></el-step>
        </el-steps>
        <el-row type="flex" class="row-bg" justify="center">
          <el-col :span="10" v-if="active == 0">
            <el-card  shadow="always">
                <el-form>
                  <el-form-item label="Giới tính" label-width="120px" >
                    <el-select v-model="gender" placeholder="Giới tính">
                      <el-option label="Nam" value="0"></el-option>
                      <el-option label="Nữ" value="1"></el-option>
                    </el-select>
                  </el-form-item>
                  <el-form-item label="Tuổi" label-width="120px">
                    <el-input v-model="age"></el-input>
                  </el-form-item>
                  <el-form-item label="Chiều cao" label-width="120px">
                    <el-input v-model="height">
                      <template slot="append">cm</template>
                    </el-input>
                  </el-form-item>
                  <el-form-item label="Cân nặng" label-width="120px">
                    <el-input v-model="form.cannang_from">
                      <template slot="append">kg</template>
                    </el-input>
                  </el-form-item>
                </el-form>
            </el-card>
          </el-col>
          <el-col :span="10" v-if="active == 1">
            <el-card v-show="active == 1" shadow="always">
                <el-form>
                  <el-form-item label="Cường độ luyện tập" label-width="150px" >
                    <el-select v-model="hoatdong" placeholder="Vui lòng chọn" class="rem25">
                      <el-option label="Ít vận động (Không tập luyện)" value="0"></el-option>
                      <el-option label="Vận động nhẹ (Tập luyện 1-3 lần / tuần)" value="1"></el-option>
                      <el-option label="Vận động vừa (Tập luyện 3-5 ngày / tuần)" value="2"></el-option>
                      <el-option label="Vận động nhiều (Tập luyện 6-7 ngày / tuần)" value="3"></el-option>
                      <el-option label="Hoạt động cực nhiều (Ngày tập 2 lần / Là vận động viên)" value="4"></el-option>
                    </el-select>
                  </el-form-item>
                </el-form>
            </el-card>
          </el-col>
          <el-col :span="10" v-if="active == 2">
            <el-card v-show="active == 2" shadow="always">
                <el-form>
                  <el-form-item label="Mục tiêu cân nặng bạn muốn giảm" label-width="232px" >
                    <el-input v-model="form.cannang_to">
                      <template slot="append">kg</template>
                    </el-input>
                  </el-form-item>
                </el-form>
            </el-card>
          </el-col>
          <el-col :span="10" v-if="active == 3" v-loading.lock="fullscreenLoading">
            <el-card v-show="active == 3" shadow="always">
                Để giảm cân hãy duy trì : <el-tag type="success">{{ tdee }}</el-tag> Calo / Ngày
            </el-card>
          </el-col>
        </el-row>
        <el-row type="flex" class="row-bg" justify="center">
        <el-button v-show="active > 0 && active < 3" style="margin-top: 12px;" @click="prev">Quay lại</el-button>
        <el-button v-show="active < 3" style="margin-top: 12px;" @click="next">Tiếp theo</el-button>
        <el-button v-show="active == 3" style="margin-top: 12px;" @click="goHome">Về trang chủ</el-button>
        </el-row>
    </el-card>
  </div>
</template>
<script>
import Form from 'vform'

export default {
  middleware: 'auth',
  data () {
    return {
      fullscreenLoading: false,
      loaded: false,
      active: 0,
      gender: '',
      age: null,
      height: null,
      weight: null,
      hoatdong: null,
      cannang_to: null,
      tdee: null,
      form: new Form({
        cannang_from: '',
        cannang_to: '',
        caloonday: '',
        tdee_guide: 1,
      })
    }
  },
  metaInfo () {
    return { title: this.$t('home') }
  },
  mounted () {
  },
  
  watch: {
    active(newVal) {
      if (newVal === 3) {
        this.loadActiveEnd();
        this.calculator();
      }
    }
  },
  async created () {
    // this.loaded = false
    // await axios.get('/api/dashboard')
    //   .then((response) => {
    //     this.dashboard = response.data.data
    //   })
    // this.loaded = true
  },
  methods: {
      loadActiveEnd(){
        this.fullscreenLoading = true;
        setTimeout(() => {
          this.fullscreenLoading = false;
        }, 2000);
      },
      next() {
        if (this.active++ > 4) this.active = 4;
      },
      prev() {
          if (this.active-- < 0) this.active = 0;
      },
      calculator() {
        var K = this.gender === 0 ? 5 : -161;
        var bmr = (9.99 * this.form.cannang_from) + (6.25 * this.height) - (4.92 * this.age) + K;
        var R = null;
        if (this.hoatdong == 0) R = 1.2
        if (this.hoatdong == 1) R = 1.375
        if (this.hoatdong == 2) R = 1.55
        if (this.hoatdong == 3) R = 1.725
        if (this.hoatdong == 4) R = 1.9
        var tdee = bmr * R;
        this.form.caloonday = parseFloat(tdee).toFixed(2) - 200;
        this.tdee = parseFloat(tdee).toFixed(2) - 200;
      },
      async goHome () {
        const { data } = await this.form.patch('/api/settings/profile')

        this.$store.dispatch('auth/updateUser', { user: data })
        this.$router.push({ name: 'home'})
      },
  }
}
</script>
<style scoped>
.rem25 {
  width: 25rem;
}
</style>