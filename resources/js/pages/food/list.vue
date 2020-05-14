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
    >
      <template slot-scope="scope">
        {{ scope.row.nangluong }}
      </template>
    </el-table-column>
    <el-table-column
      prop="chatbeo"
      label="Chất béo"
    >
      <template slot-scope="scope">
        {{ scope.row.chatbeo }} g
      </template>
    </el-table-column>
    <el-table-column
      prop="chatxo"
      label="Chất xơ"
    >
      <template slot-scope="scope">
        {{ scope.row.chatxo }} g
      </template>
    </el-table-column>
    <el-table-column
      prop="duong"
      label="Đường"
    >
      <template slot-scope="scope">
        {{ scope.row.duong }} g
      </template>
    </el-table-column>
    <el-table-column
      prop="suckhoe"
      label="Giá trị sức khỏe"
    >
      <template slot-scope="scope">
        <el-progress :text-inside="true" :stroke-width="26" :percentage="scope.row.suckhoe" status="success" />
      </template>
    </el-table-column>
    <el-table-column
      prop="giamcan"
      label="Giá trị giảm cân"
    >
      <template slot-scope="scope">
        <el-progress :text-inside="true" :stroke-width="24" :percentage="scope.row.giamcan" status="warning"/>
      </template>
    </el-table-column>
    <el-table-column
      prop="tangcan"
      label="Giá trị tăng cân"
    >
      <template slot-scope="scope">
        <el-progress :text-inside="true" :stroke-width="22" :percentage="scope.row.tangcan" status="exception"/>
      </template>
    </el-table-column>
    <el-table-column
      label="Thao tác">
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
