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
      width="300"
      sortable
    />
    <el-table-column
      prop="user.name"
      label="Người dùng"
      sortable
      width="150"
    >
      <template slot-scope="scope">
        {{ scope.row.user.name }}
      </template>
    </el-table-column>
     <el-table-column type="expand" label="Chỉ số">
      <template slot-scope="props">
        <p>Calories: {{ props.row.nangluong }}</p>
        <p>Chất xơ: {{ props.row.chatxo }}</p>
        <p>Đường: {{ props.row.duong }}</p>
        <p>Chất béo: {{ props.row.chatbeo }}</p>
        <p>Vitamin A: {{ props.row.vitamina }} %</p>
        <p>Vitamin C: {{ props.row.vitaminc }} %</p>
        <p>Canxi: {{ props.row.canxi }} %</p>
        <p>Sắt: {{ props.row.sat }} %</p>
        <p>Ghi chú: {{ props.row.note }}</p>
      </template>
    </el-table-column>
    <el-table-column
      prop="suckhoe"
      label="Giá trị sức khỏe"
      sortable
    >
      <template slot-scope="scope">
        <el-progress :text-inside="true" :stroke-width="26" :percentage="scope.row.suckhoe" status="success" />
      </template>
    </el-table-column>
    <el-table-column
      prop="giamcan"
      label="Giá trị giảm cân"
      sortable
    >
      <template slot-scope="scope">
        <el-progress :text-inside="true" :stroke-width="24" :percentage="scope.row.giamcan" status="warning"/>
      </template>
    </el-table-column>
    <el-table-column
      prop="tangcan"
      label="Giá trị tăng cân"
      sortable
    >
      <template slot-scope="scope">
        <el-progress :text-inside="true" :stroke-width="22" :percentage="scope.row.tangcan" status="exception"/>
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
        <el-button type="success" @click="approvedProduct(scope.row.id)" icon="el-icon-check" circle></el-button>
        <el-button type="danger" icon="el-icon-delete" circle @click.native.prevent="deleteRow(scope.row.id, scope.row.tensp, scope.$index, tableData)"></el-button>
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
    await axios.get(`/api/thucpham-request`)
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
    async deleteRow (id, tensp, index, rows) {
      this.loading = true
      await axios.get(`/api/xoatp/${id}`)
        .then((response) => {
          this.loading = false
          // rows.splice(index, 1)
          this.$notify.success({
            title: 'Success',
            message: `Đã xóa ${tensp}`
          })
          this.search = ''
          axios.get(`/api/thucpham-request`)
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
        })
        .catch(() => {
          this.$notify.error({
            title: 'Error',
            message: 'Có lỗi xảy ra mất rồi'
          })
          this.loading = false
        })
    },

    async approvedProduct (id) {
      this.loading = true
      await axios.get(`/api/approved/${id}`)
        .then((response) => {
          this.loading = false
          this.$notify.success({
            title: 'Success',
            message: `Đã approved`
          })
          this.search = ''
          axios.get(`/api/thucpham-request`)
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
