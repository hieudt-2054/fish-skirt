<template>
  <div class="main-layout">
    <navbar v-if="user" />

    <div class="mt-4">
      <el-container>
        <el-main>
          <child />
        </el-main>
      </el-container>
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'
import { mapGetters } from 'vuex'

export default {
  name: 'MainLayout',

  components: {
    Navbar
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
}
</script>
