<template>
  <el-table
    v-loading="loading"
    :data="tableData"
    border
    style="width: 100%"
  >
    <el-table-column
      prop="tensp"
      label="Tên sản phẩm"
    />
    <el-table-column
      prop="nangluong"
      label="Calories"
    />
    <el-table-column
      prop="chatbeo"
      label="Chất béo"
    />
    <el-table-column
      prop="chatxo"
      label="Chất xơ"
    />
    <el-table-column
      prop="duong"
      label="Đường"
    />
    <el-table-column
      prop="suckhoe"
      label="Giá trị sức khỏe"
    />
    <el-table-column
      prop="giamcan"
      label="Giá trị giảm cân"
    />
    <el-table-column
      prop="tangcan"
      label="Giá trị tăng cân"
    />
  </el-table>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    return {
      tableData: [],
      loading: true
    }
  },
  async mounted () {
    await axios.get(`/api/thucpham`)
      .then((response) => {
        this.tableData = response.data
        this.loading = false
      })
      .catch(() => {
        this.$notify.error({
          title: 'Error',
          message: 'Có lỗi xảy ra mất rồi'
        })
        this.loading = false
      })
  }
}
</script>
