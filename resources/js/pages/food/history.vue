<template>
	<div>
		<el-card class="box-card mb-2">
			<el-button type="primary" @click="createForm">
					Thêm 1 dòng ăn uống<br/>
			</el-button>
		</el-card>
		<el-card class="box-card d-flex" v-if="forms.length > 0">
			<el-form :xs="24" :sm="24" :md="24" :lg="24" v-for="(form, index) in forms" v-bind:key="form.id">
				<el-form-item>
					<el-col>
						<el-select v-model="form.thucpham_id" filterable placeholder="Chọn Sản Phẩm">
							<el-option
							v-for="item in product"
							:key="item.id"
							:label="item.value"
							:value="item.id">
							</el-option>
						</el-select>
					</el-col>
					</el-form-item>
				<el-form-item>
					<el-col :xs="24" :sm="24" :md="24" :lg="24">
						<el-input v-model="form.sogram" placeholder="Số Gram hoặc ML">
							<template slot="prepend">
            		g/ML
          		</template>
						</el-input>
					</el-col>
				</el-form-item>
				<el-form-item>
					<el-col :xs="24" :sm="24" :md="24" :lg="24">
						<el-date-picker
							v-model="form.ngay"
							type="date"
							placeholder="Chọn ngày"
							format="dd/MM/yyyy"
      				value-format="dd/MM/yyyy"
							>
						</el-date-picker>
						<el-button v-if="index != 0" type="danger" @click="removeForm(index)"><fa icon="trash" /></el-button>
					</el-col>
				</el-form-item>
				<hr/>
			</el-form>
			<el-button type="primary" v-if="forms.length > 0" @click="onSubmit">
				Tạo
			</el-button>
		</el-card>
	</div>
</template>

<script>
import axios from 'axios'
import moment from "moment";

export default {
  data () {
    return {
      state: '',
      product: [],
			forms: [],
			 pickerOptions: {
          shortcuts: [{
            text: 'Ngày hôm nay',
            onClick(picker) {
              picker.$emit('pick', new Date());
            }
          }]
        },
    }
  },
  async mounted () {
			this.createForm();
      await axios.get(`/api/thucpham`)
      .then((response) => {
        this.product = response.data.map(({id, tensp}) => ({ id, value: tensp }));
        this.loading = false
      })
      .catch((e) => {
          console.log(e);
        this.$notify.error({
          title: 'Error',
          message: 'Có lỗi xảy ra mất rồi'
        })
        this.loading = false
      })
  },
  methods: {
    onSubmit () {
      axios.post('/api/eating/', this.forms)
        .then(() => {
          this.$notify({
            title: 'Success',
            message: 'Thêm mới sản phẩm thành công',
            type: 'success'
          })
          this.formReset()
          this.$router.push({ name: 'home' })
        })
        .catch((err) => {
          this.$notify.error({
            title: 'Error',
            message: err.response.data.msg || 'Có lỗi xảy ra mất rồi'
          })
        })
    },
    formReset () {
      this.forms = []
    },
    createForm () {
        this.forms.push({
            thucpham_id: null,
            sogram: null,
            ngay: moment().subtract(0, 'days').format('DD/MM/YYYY')
        });
		},
		removeForm(index) {
			this.forms.splice(index, 1);
		}
  }
}
</script>
