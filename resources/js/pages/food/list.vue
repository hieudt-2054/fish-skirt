<template>
  <el-table
    v-loading="loading"
    :data="tableData.filter(data => !search || data.tensp.toLowerCase().includes(search.toLowerCase()))"
    height="700"
    border
    style="width: 100%"
  >
    <el-table-column
      prop="tensp"
      label="Tên sản phẩm"
      fixed
      width="200"
      sortable
    />
    <el-table-column
      prop="nangluong"
      label="Calories"
      sortable
      width="120"
    >
      <template slot-scope="scope">
        {{ scope.row.nangluong }}
      </template>
    </el-table-column>
    <el-table-column
      prop="chatbeo"
      sortable
      width="120"
      label="Chất béo"
    >
      <template slot-scope="scope">
        {{ scope.row.chatbeo }} g
      </template>
    </el-table-column>
    <el-table-column
      prop="chatxo"
      sortable
      width="120"
      label="Chất xơ"
    >
      <template slot-scope="scope">
        {{ scope.row.chatxo }} g
      </template>
    </el-table-column>
    <el-table-column
      prop="duong"
      width="100"
      label="Đường"
      sortable
    >
      <template slot-scope="scope">
        {{ scope.row.duong }} g
      </template>
    </el-table-column>
    <el-table-column
      prop="suckhoe"
      label="Giá trị sức khỏe"
      sortable
      width="160"
    >
      <template slot-scope="scope">
        <el-progress :text-inside="true" :stroke-width="26" :percentage="scope.row.suckhoe" status="success" />
      </template>
    </el-table-column>
    <el-table-column
      prop="giamcan"
      label="Giá trị giảm cân"
      sortable
      width="160"
    >
      <template slot-scope="scope">
        <el-progress :text-inside="true" :stroke-width="24" :percentage="scope.row.giamcan" status="warning"/>
      </template>
    </el-table-column>
    <el-table-column
      prop="tangcan"
      label="Giá trị tăng cân"
      sortable
      width="160"
    >
      <template slot-scope="scope">
        <el-progress :text-inside="true" :stroke-width="22" :percentage="scope.row.tangcan" status="exception"/>
      </template>
    </el-table-column>
    <el-table-column
      prop="vitamina"
      label="Vitamin A"
      sortable
      width="130"
    >
      <template slot-scope="scope">
        {{ scope.row.vitamina }} %
      </template>
    </el-table-column>
    <el-table-column
      prop="vitamic"
      label="Vitamin C"
      sortable
      width="130"
    >
      <template slot-scope="scope">
        {{ scope.row.vitaminc }} %
      </template>
    </el-table-column>
    <el-table-column
      prop="canxi"
      sortable
      label="Canxi"
      width="110"
    >
      <template slot-scope="scope">
        {{ scope.row.canxi }} %
      </template>
    </el-table-column>
    <el-table-column
      prop="sat"
      sortable
      label="Sắt"
      width="110"
    >
      <template slot-scope="scope">
        {{ scope.row.sat }} %
      </template>
    </el-table-column>
    <el-table-column
      label="Thao tác"
      fixed="right"
      width="200">
      <template slot="header" slot-scope="scope">
        <el-input
          v-model="search"
          size="mini"
          placeholder="Tìm kiếm tên SP"/>
      </template>
      <template slot-scope="scope">
        <el-button
          size="mini"
          disabled
        >
          Sửa
        </el-button>
        <el-button
          size="mini"
          type="danger"
          @click.native.prevent="deleteRow(scope.$index, tableData)"
        >
          Xóa
        </el-button>
      </template>
    </el-table-column>
  </el-table>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    return {
      tableData: [],
      loading: true,
      search: '',
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
  },
  methods: {
    async deleteRow (index, rows) {
      var id = rows[index].id
      this.loading = true
      await axios.get(`/api/xoatp/${id}`)
        .then((response) => {
          this.loading = false
          rows.splice(index, 1)
          this.$notify.success({
            title: 'Success',
            message: `Đã xóa ${rows[index].tensp}`
          })
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
}
</script>
<style scoped>

</style>
