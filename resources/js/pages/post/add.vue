<template>
  <el-card class="box-card">
    <el-form ref="form" :model="form">
        <el-form-item label="Tiêu đề bài viết">
            <el-input v-model="form.title"></el-input>
        </el-form-item>
        <el-form-item label="URL Ảnh thumbnail">
            <el-input v-model="form.post_image_path"></el-input>
        </el-form-item>
        <el-form-item label="Xem trước">
        <el-col :span="4">
            <el-card :body-style="{ padding: '0px' }">
                <img :src="form.post_image_path" class="image">
            </el-card>
        </el-col>
        </el-form-item>
        <el-form-item label="Danh mục">
            <el-col>
                <el-select v-model="form.category_id" filterable placeholder="Chọn Danh mục">
                    <el-option
                    v-for="item in categories"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id">
                    </el-option>
                </el-select>
            </el-col>
        </el-form-item>
        <el-form-item>
            <el-col>
                <el-radio v-model="form.post_type" label="0">Bài viết</el-radio>
                <el-radio v-model="form.post_type" label="1">Video</el-radio>
            </el-col>
        </el-form-item>
        <ckeditor v-if="form.post_type == 0" v-model="form.editorData" :config="form.editorConfig"></ckeditor>
        <el-form-item v-if="form.post_type == 1">
            <el-input
                type="textarea"
                :autosize="{ minRows: 2, maxRows: 4}"
                placeholder="Chèn script youtube"
                v-model="form.youtubeScript">
                </el-input>
        </el-form-item>
        </br>
        <el-form-item>
            <el-button type="primary" @click="onSubmit">
                Thêm
            </el-button>
        </el-form-item>
    </el-form>
  </el-card>
</template>

<script>
import cheerio from 'cheerio'
import axios from 'axios'

export default {
  data () {
    return {
      categories: [],
      form: {
        post_type: "0",
        post_image_path: '',
        category_id: null,
        title: '',
        editorData: '<p>Nội dung bài viết.</p>',
        editorConfig: {
            language: 'vi',
        },
        youtubeScript: null,
      }
    }
  },
  async mounted () {
      await axios.get(`/api/categories`)
      .then((response) => {
        this.categories = response.data;
        this.loading = false
      })
      .catch((e) => {
          console.log(e);
        this.$notify.error({
          title: 'Error',
          message: 'Có lỗi xảy ra mất rồi'
        })
        this.loading = false
      })
  },
  methods: {
    onSubmit () {
      axios.post('/api/post/', this.form)
        .then(() => {
          this.$notify({
            title: 'Success',
            message: 'Thêm mới sản phẩm thành công',
            type: 'success'
          })
          this.formReset()
        })
        .catch((err) => {
          this.$notify.error({
            title: 'Error',
            message: err.response.data.msg || 'Có lỗi xảy ra mất rồi'
          })
        })
    },
  }
}
</script>
