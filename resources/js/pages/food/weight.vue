<template>
	<div>
		<el-card class="box-card mb-2">
			<el-button type="primary" @click="createForm">
					Thêm 1 dòng cân nặng<br/>
			</el-button>
		</el-card>
		<el-card class="box-card d-flex" v-if="forms.length > 0">
			<el-form :xs="24" :sm="24" :md="24" :lg="24" v-for="(form, index) in forms" v-bind:key="form.id">
				<el-form-item>
					<el-col :xs="24" :sm="24" :md="24" :lg="24">
						<el-input v-model="form.socan" placeholder="Số Cân">
							<template slot="prepend">
                                KG
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
    }
  },
  async mounted () {
	this.createForm();
  },
  methods: {
    onSubmit () {
      axios.post('/api/cannang/', this.forms)
        .then(() => {
          this.$notify({
            title: 'Success',
            message: 'Thêm mới cân nặng thành công',
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
            socan: null,
            ngay: moment().subtract(0, 'days').format('DD/MM/YYYY')
        });
		},
		removeForm(index) {
			this.forms.splice(index, 1);
		}
  }
}
</script>
