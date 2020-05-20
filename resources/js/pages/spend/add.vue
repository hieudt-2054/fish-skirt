<template>
  <div>
		<el-card class="box-card mb-2">
			<el-button type="primary" @click="createForm">
					Thêm 1 dòng chi tiêu<br/>
			</el-button>
			<el-button type="primary" @click="$router.push({ name: 'spendIndex'})">
					Tổng quan<br/>
			</el-button>
		</el-card>
		<el-card class="box-card d-flex" v-if="forms.length > 0">
			<el-form :xs="24" :sm="24" :md="24" :lg="24" v-for="(form, index) in forms" v-bind:key="form.id">
				<el-form-item>
					<el-col :xs="24" :sm="24" :md="24" :lg="24">
						<el-input v-model="form.sotien" placeholder="Số Tiền" />
					</el-col>
				</el-form-item>
				<el-form-item>
					<el-col>
						<el-select v-model="form.danhmuc" filterable placeholder="Chọn Danh Mục">
							<el-option
							v-for="item in danhmuc"
							:key="item.id"
							:label="item.value"
							:value="item.id">
							</el-option>
						</el-select>
					</el-col>
				</el-form-item>
				<el-form-item>
					<el-col>
						<el-select v-model="form.loai" filterable placeholder="Chọn Loại Tiền">
							<el-option
							v-for="item in loai"
							:key="item.id"
							:label="item.value"
							:value="item.id">
							</el-option>
						</el-select>
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
				<el-form-item>
					<el-col :xs="24" :sm="24" :md="24" :lg="24">
						<el-input v-model="form.mota" type="textarea" placeholder="Mô tả" />
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
import cheerio from 'cheerio'
import axios from 'axios'
import moment from 'moment'

export default {
  data () {
    return {
			loai: [
				{ id: 1, value: 'Thu Nhập' },
				{ id: 2, value: 'Chi Tiêu' }
			],
			danhmuc: null,
      forms: [],
    }
  },
  watch: {
	},
	created () {
	},
	async mounted () {
		await axios.get(`/api/spendcategory`)
      .then((response) => {
        this.danhmuc = response.data.map(({id, name}) => ({ id, value: name }));
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
		this.createForm()
	},
  methods: {
    onSubmit () {
      axios.post('/api/spend/', this.forms)
        .then(() => {
          this.$notify({
            title: 'Success',
            message: 'Thêm mới chi tiêu thành công',
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
      this.forms = []
    },
    createForm () {
        this.forms.push({
            sotien: null,
            loai: null,
            danhmuc: null,
            mota: null,
            ngay: moment().subtract(0, 'days').format('DD/MM/YYYY')
        });
		},
		removeForm(index) {
			this.forms.splice(index, 1);
		}
  }
}
</script>
