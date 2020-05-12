<template>
  <div class="main-layout">
    <navbar />

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

export default {
  name: 'MainLayout',

  components: {
    Navbar
  }
}
</script>
