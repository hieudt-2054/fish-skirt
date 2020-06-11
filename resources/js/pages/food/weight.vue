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
						<el-input v-model="form.socan" @change="removeError(index)" placeholder="Số Cân" :class="{ 'form-er': err[index] }">
							<template slot="prepend">
                  KG
              </template>
						</el-input>
            <div class="el-form-item__error" v-if="err[index]">
             {{ err[index][0] }}
            </div>
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
import { alpha, required, email, decimal, minLength } from 'vuelidate/lib/validators'

export default {
  data () {
    return {
      state: '',
      product: [],
    forms: [],
    err: [],
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
          this.$router.push({ name: 'home' })
        })
        .catch((err) => {
          this.err = this.convertObjToArr(err.response.data.errors)
          this.$notify.error({
            title: 'Error',
            message: err.response.data.msg || 'Có lỗi xảy ra mất rồi'
          })
        })
    },
    formReset () {
      this.forms = []
      this.err = []
    },
    createForm () {
        this.forms.push({
            socan: null,
            ngay: moment().subtract(0, 'days').format('DD/MM/YYYY')
        });
		},
		removeForm(index) {
			this.forms.splice(index, 1);
    },
    removeError(index) {
      this.err.splice(index, 1);
    },
    convertObjToArr(errors) {
      var result = [];
      for (var key in errors) {
          // skip loop if the property is from prototype
          if (!errors.hasOwnProperty(key)) continue;

          var index = key.split('.')[0];
          result[index] = errors[key];

      }
      return result;
    }
  },
  	validations() {
		return {
			forms : {
				socan: {
					required,
					decimal
				}
			}
		}
	}
}
</script>
