<template>
  <el-menu class="el-menu-demo" v-if="user" mode="horizontal">
    <el-submenu index="2">
      <template slot="title">Menu</template>
      <el-menu-item index="2-1">
        <router-link :to="{ name: 'home' }" class="link">
          Trang tổng quan
        </router-link>
      </el-menu-item>
      <el-menu-item index="2-2">
        <router-link :to="{ name: 'addFood' }" class="link">
          Thêm thực phẩm
        </router-link>
      </el-menu-item>
      <el-menu-item index="2-3">
        <router-link :to="{ name: 'listFood' }" class="link">
          Danh sách thực phẩm
        </router-link>
      </el-menu-item>
      <el-menu-item index="2-4">
        <router-link :to="{ name: 'addHistory' }" class="link">
          Thêm lịch sử ăn
        </router-link>
      </el-menu-item>
      <el-menu-item index="2-5">
        <router-link :to="{ name: 'addWeight' }" class="link">
          Thêm lịch sử cân nặng
        </router-link>
      </el-menu-item>
      <!-- <el-menu-item index="2-6">
        <router-link :to="{ name: 'spendIndex' }" class="link">
          Quản lý chi tiêu
        </router-link>
      </el-menu-item> -->
      <el-menu-item index="2-7" v-if="user.roles == 1">
        <router-link :to="{ name: 'listPost' }" class="link">
          Quản lý bài viết
        </router-link>
      </el-menu-item>
    </el-submenu>
    <el-submenu index="3" v-if="user">
      <template slot="title"><img :src="user.photo_url" class="rounded-circle profile-photo mr-1 image"> {{ user.name }}</template>
      <el-menu-item index="3-1">
        <router-link :to="{ name: 'settings.profile' }" class="link">
          {{ $t('settings') }}
        </router-link>
      </el-menu-item>
      <el-menu-item index="3-2">
        <a href="#" class="link" @click.prevent="logout">
          {{ $t('logout') }}
        </a>
      </el-menu-item>
    </el-submenu>
    <el-menu-item index="4" v-if="user.roles == 1">
      <router-link :to="{ name: 'listFoodRequest' }" class="link">
      Sản phẩm chờ xử lý <span class="badge badge-danger">{{count}}</span>
      </router-link>
    </el-menu-item>
    <el-menu-item index="5" v-if="user.roles == 0">
      <router-link :to="{ name: 'listPoints' }" class="link">
      Điểm Thưởng: <span class="badge badge-success">{{user.diemthuong}}</span>
       </router-link>
    </el-menu-item>
    <el-menu-item index="6" v-if="user.roles == 1">
      <router-link :to="{ name: 'managePoints' }" class="link">
      Duyệt thẻ <span class="badge badge-danger">{{cardRequest}}</span>
      </router-link>
    </el-menu-item>
  </el-menu>
  <!-- <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <router-link :to="{ name: user ? 'home' : 'welcome' }" class="navbar-brand">
        {{ appName }}
      </router-link>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false">
        <span class="navbar-toggler-icon" />
      </button>

      <div id="navbarToggler" class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <locale-dropdown />
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          Authenticated
          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark"
               href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            >
              <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
              {{ user.name }}
            </a>
            <div class="dropdown-menu">
              <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3">
                <fa icon="cog" fixed-width />
                {{ $t('settings') }}
              </router-link>

              <div class="dropdown-divider" />
              <a href="#" class="dropdown-item pl-3" @click.prevent="logout">
                <fa icon="sign-out-alt" fixed-width />
                {{ $t('logout') }}
              </a>
            </div>
          </li>
          Guest
          <template v-else>
            <li class="nav-item">
              <router-link :to="{ name: 'login' }" class="nav-link" active-class="active">
                {{ $t('login') }}
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'register' }" class="nav-link" active-class="active">
                {{ $t('register') }}
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav> -->
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios'

export default {
  components: {
  },

  data: () => ({
    appName: window.config.appName,
    count: 0,
    cardRequest: 0,
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),
  mounted () {
    this.loadProductRequest()
  },
  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    },
    async loadProductRequest() {
      await axios.get('/api/prod-req')
      .then((res) => {
        this.count = res.data.count
        this.cardRequest = res.data.cardRequest
      });
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
