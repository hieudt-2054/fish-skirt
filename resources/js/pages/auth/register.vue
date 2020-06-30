<template>
  <div class="row">
    <div class="col-lg-8 m-auto">
      <card v-if="mustVerifyEmail" :title="$t('register')">
        <div class="alert alert-success" role="alert">
          {{ $t('verify_email_address') }}
        </div>
      </card>
      <card v-else :title="$t('register')">
        <form @submit.prevent="register" @keydown="form.onKeydown($event)">
          <!-- Name -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{ $t('name') }}</label>
            <div class="col-md-7">
              <input v-model.trim="$v.form.name.$model" :class="{ 'is-invalid': form.errors.has('name') || ($v.form.name.$anyDirty && $v.form.name.$invalid) }" class="form-control" type="text" name="name">
              <has-error :form="form" field="name" />
              <div class="help-block invalid-feedback" v-if="$v.form.name.$anyDirty && !$v.form.name.alpha">Trường tên không được chứa ký tự đặc biệt</div>
              <div class="help-block invalid-feedback" v-if="$v.form.name.$anyDirty && !$v.form.name.required">Trường tên bắt buộc điền</div>
              <div class="help-block invalid-feedback" v-if="$v.form.name.$anyDirty && !$v.form.name.minLength">Trường tên tối thiểu 6 ký tự</div>
            </div>
          </div>

          <!-- Email -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
            <div class="col-md-7">
              <input v-model.trim="$v.form.email.$model" :class="{ 'is-invalid': form.errors.has('email') || ($v.form.email.$anyDirty && $v.form.email.$invalid) }" class="form-control" type="email" name="email">
              <has-error :form="form" field="email" />
              <div class="help-block invalid-feedback" v-if="$v.form.email.$anyDirty && !$v.form.email.required">Trường email bắt buộc điền</div>
              <div class="help-block invalid-feedback" v-if="$v.form.email.$anyDirty && !$v.form.email.email">Định dạng email không hợp lệ</div>
            </div>
          </div>

          <!-- Password -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{ $t('password') }}</label>
            <div class="col-md-7">
              <input v-model.trim="$v.form.password.$model" :class="{ 'is-invalid': form.errors.has('password') || ($v.form.password.$anyDirty && $v.form.password.$invalid) }" class="form-control" type="password" name="password">
              <has-error :form="form" field="password" />
              <div class="help-block invalid-feedback" v-if="$v.form.password.$anyDirty && !$v.form.password.required">Trường mật khẩu bắt buộc điền</div>
              <div class="help-block invalid-feedback" v-if="$v.form.password.$anyDirty && !$v.form.password.minLength">Trường mật khẩu tối thiểu 6 ký tự</div>
            </div>
          </div>

          <!-- Password Confirmation -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{ $t('confirm_password') }}</label>
            <div class="col-md-7">
              <input v-model.trim="$v.form.password_confirmation.$model" :class="{ 'is-invalid': form.errors.has('password_confirmation') || ($v.form.password_confirmation.$anyDirty && $v.form.password_confirmation.$invalid) }" class="form-control" type="password" name="password_confirmation">
              <has-error :form="form" field="password_confirmation" />
              <div class="help-block invalid-feedback" v-if="$v.form.password_confirmation.$anyDirty && !$v.form.password_confirmation.required">Trường xác nhận mật khẩu bắt buộc điền</div>
              <div class="help-block invalid-feedback" v-if="$v.form.password_confirmation.$anyDirty && !$v.form.password_confirmation.minLength">Trường xác nhận mật khẩu nhỏ nhất 6 ký tự</div>
              <div class="help-block invalid-feedback" v-if="$v.form.password_confirmation.$anyDirty && !$v.form.password_confirmation.sameAs">Trường xác nhận mật khẩu không khớp</div>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- Submit Button -->
              <v-button :loading="form.busy" :disabled="$v.$invalid">
                {{ $t('register') }}
              </v-button>
              <router-link :to="{ name: 'login' }" class="ml-2 btn btn-success">
                Đăng nhập
              </router-link>

              <!-- GitHub Register Button -->
              <login-with-github />
            </div>
          </div>
        </form>
      </card>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/LoginWithGithub'
import { alpha, required, email, sameAs, minLength } from 'vuelidate/lib/validators'

export default {
  middleware: 'guest',

  components: {
    LoginWithGithub
  },

  metaInfo () {
    return { title: this.$t('register') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }),
    mustVerifyEmail: false
  }),
  validations() {
    return {
      form: {
        name: {
          alpha,
          required,
          minLength: minLength(6)
        },
        email: {
          required,
          email
        },
        password: {
          required,
          minLength: minLength(6)
        },
        password_confirmation: {
          required,
          sameAsPassword: sameAs('password'),
          minLength: minLength(6)
        }
      }
    }
  },

  methods: {
    async register () {
      // Register the user.
      const { data } = await this.form.post('/api/register')

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true
      } else {
        // Log in the user.
        const { data: { token } } = await this.form.post('/api/login')

        // Save the token.
        this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: data })

        // Redirect home.
        this.$router.push({ name: 'tdee' })
      }
    }
  }
}
</script>
