<template>
    <div>
        <el-row>
            <el-button type="primary" @click="pushRoter()">Thêm bài viết</el-button>
            <el-button type="primary" @click="dialogVisible = true">Thêm danh mục</el-button>
        </el-row><br/>
        <el-row>
            <el-table
                v-loading="loading"
                :data="tableData.filter(data => !search || data.title.toLowerCase().includes(search.toLowerCase()))"
                height="900"
                border
                style="width: 100%"
            >
                <el-table-column
                prop="title"
                label="Tên bài viết"
                sortable
                >
                    <template slot-scope="scope">
                        <a target="_blank" :href="'/p/' + scope.row.id">{{ scope.row.title }}</a>
                    </template>
                </el-table-column>
                <el-table-column
                prop="category"
                label="Danh mục"
                sortable
                >
                <template slot-scope="scope">
                    {{ scope.row.category.name }}
                </template>
                </el-table-column>
                <el-table-column
                prop="post_image_path"
                label="Hình ảnh Thumbnail"
                >
                <template slot-scope="scope">
                <img :src="scope.row.post_image_path" class="image">
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
                    placeholder="Tìm kiếm tên bài viết"/>
                </template>
                <template slot-scope="scope">
                    <router-link :to="{ name: 'editFood', params: { id: scope.row.id }}">
                    <el-button
                    size="mini"
                    >
                    Sửa
                    </el-button>
                    </router-link>
                    <el-button
                    size="mini"
                    type="danger"
                    @click.native.prevent="deleteRow(scope.row.id, scope.row.tensp, scope.$index, tableData)"
                    >
                    Xóa
                    </el-button>
                </template>
                </el-table-column>
            </el-table>
        </el-row>
        <el-dialog
        title="Thêm mới danh mục"
        :visible.sync="dialogVisible"
        width="30%"
        :before-close="handleClose">
        <el-form>
          <el-form-item label="Tên danh mục" :label-width="formLabelWidth">
            <el-col>
              <el-input v-model="nameCategory" autocomplete="off"></el-input>
            </el-col>
          </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="dialogVisible = false">Cancel</el-button>
            <el-button type="primary" @click="addCategory()">Thêm</el-button>
        </span>
        </el-dialog>
    </div>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    return {
    nameCategory: null,
      tableData: [],
      loading: true,
      search: '',
      dialogVisible: false,
    }
  },
  async mounted () {
    await axios.get(`/api/post`)
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
          axios.get(`/api/thucpham`)
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
    pushRoter () {
        this.$router.push({ name: 'addPost'});
    },
    async addCategory() {
        await axios.post('/api/categories', { name: this.nameCategory })
        .then((response) => {
            this.$notify.success({
                title: 'Success',
                message: `Đã thêm mới danh mục ${response.data.name}`
            })
            
        })
        .catch(() => {
            this.$notify.error({
            title: 'Error',
            message: 'Có lỗi xảy ra mất rồi'
            })
        })
    },
  }
}
</script>
<style scoped>
.image {
    width: 30%;
    height: 30%;
}
</style>
