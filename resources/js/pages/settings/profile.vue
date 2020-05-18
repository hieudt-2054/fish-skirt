<template>
  <card :title="$t('your_info')">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" message="Dữ liệu cập nhật thành công" />

      <!-- Name -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Tên người dùng</label>
        <div class="col-md-7">
          <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
          <has-error :form="form" field="name" />
        </div>
      </div>

      <!-- Email -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
        <div class="col-md-7">
          <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
          <has-error :form="form" field="email" />
        </div>
      </div>

      <!-- Cân nặng gốc -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Cân nặng gốc</label>
        <div class="col-md-7">
          <input v-model="form.cannang_from" :class="{ 'is-invalid': form.errors.has('cannang_from') }" class="form-control" type="number" name="cannang_from">
          <has-error :form="form" field="cannang_from" />
        </div>
      </div>

      <!-- Cân nặng gốc -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Cân nặng mong muốn</label>
        <div class="col-md-7">
          <input v-model="form.cannang_to" :class="{ 'is-invalid': form.errors.has('cannang_to') }" class="form-control" type="number" name="cannang_to">
          <has-error :form="form" field="cannang_to" />
        </div>
      </div>

      <!-- calo on day -->
      <div class="form-group row">
        <label class="col-md-3 col-form-label text-md-right">Số calo cần thiết 1 ngày</label>
        <div class="col-md-7">
          <input v-model="form.caloonday" :class="{ 'is-invalid': form.errors.has('caloonday') }" class="form-control" type="number" name="caloonday">
          <has-error :form="form" field="caloonday" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <v-button :loading="form.busy" type="success">
            Cập nhật
          </v-button>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      cannang_from: '',
      cannang_to: '',
      caloonday: '',
    })
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]
    })
  },

  methods: {
    async update () {
      const { data } = await this.form.patch('/api/settings/profile')

      this.$store.dispatch('auth/updateUser', { user: data })
    }
  }
}
</script>
