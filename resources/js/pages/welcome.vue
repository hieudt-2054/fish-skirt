<template>
  <div>
    <div class="top-right links">
      <template v-if="authenticated">
        <el-button type="primary">
          <router-link :to="{ name: 'home' }" class="link-white">
            Quản lý
          </router-link>
        </el-button>
      </template>
      <template v-else>
        <el-button type="primary">
          <router-link :to="{ name: 'login' }" class="link-white">
            {{ $t('login') }}
          </router-link>
        </el-button>
        <el-button type="primary">
          <router-link :to="{ name: 'register' }" class="link-white">
            {{ $t('register') }}
          </router-link>
        </el-button>
      </template>
    </div>
    <br/> <br/> <br/>
    <div class="text-center">
      <div class="title mt-10 white-color">
        Fish-Skirt Project Version 0.0.1
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  layout: 'basic',

  metaInfo () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: window.config.appName
  }),

  computed: mapGetters({
    authenticated: 'auth/check'
  })
}
</script>

<style scoped>
.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}
.white-color {
  color: white;
}
</style>
