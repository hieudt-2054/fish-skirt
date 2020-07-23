<template>
    <div>
        <el-row>
            <el-button type="primary" @click="dialogVisible = true">Tạo yêu cầu đổi thẻ</el-button>
        </el-row><br/>
        <el-row>
            <el-table
                v-loading="loading"
                :data="tableData.filter(data => !search || data.card.toLowerCase().includes(search.toLowerCase()))"
                height="900"
                border
                style="width: 100%"
            >
                <el-table-column
                prop="card"
                label="Loại Thẻ"
                sortable
                >
                </el-table-column>
                <el-table-column
                prop="value_card"
                label="Giá trị thẻ"
                sortable
                >
                </el-table-column>
                <el-table-column
                prop="status"
                label="Trạng thái thẻ"
                width="150"
                sortable
                >
                  <template slot-scope="scope">
                     <el-alert
                     v-if="scope.row.status === 1"
                      title="Đã duyệt"
                      type="success"
                      :closable="false"
                      show-icon>
                    </el-alert>
                    <el-alert
                    v-if="scope.row.status === 0"
                      title="Chờ duyệt"
                      :closable="false"
                      type="warning"
                      show-icon>
                    </el-alert>
                    <el-alert
                    v-if="scope.row.status === 2"
                      title="Từ chối"
                      :closable="false"
                      type="error"
                      show-icon>
                    </el-alert>
                  </template>
                </el-table-column>
                <el-table-column
                prop="created_at"
                label="Ngày tạo"
                sortable
                >
                </el-table-column>
                <el-table-column
                label="Thao tác"
                fixed="right"
                width="200">
                <template slot-scope="scope">
                    <el-button
                    size="mini"
                    @click="open(scope.row.answer)"
                    >
                    Xem phản hồi
                    </el-button>
                </template>
                </el-table-column>
            </el-table>
        </el-row>
        <el-dialog
        title="Yêu cầu đổi thẻ"
        :visible.sync="dialogVisible"
        width="30%">
        <el-form>
            <el-form-item>
                <el-alert
                    title="Tỉ lệ chuyển đổi : 1 Điểm thưởng = 1.000 VNĐ"
                    type="info"
                    show-icon>
                </el-alert>
            </el-form-item>
          <el-form-item label="Loại thẻ" :label-width="formLabelWidth">
            <el-select v-model="typeCard" placeholder="Chọn loại">
                <el-option
                v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value">
                </el-option>
            </el-select>
          </el-form-item>
          <el-form-item label="Giá trị thẻ" :label-width="formLabelWidth">
            <el-select v-model="valueCard" placeholder="Chọn giá trị">
                <el-option
                v-for="item in optionsValue"
                :key="item.value"
                :label="item.label"
                :value="item.value">
                </el-option>
            </el-select>
          </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="dialogVisible = false">Hủy</el-button>
            <el-button type="primary" @click="addRequest()">Tạo yêu cầu</el-button>
        </span>
        </el-dialog>
    </div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'

export default {
  data () {
    return {
      formLabelWidth: '120px',
        nameCategory: null,
        options: [{
          value: 'VIETTEL',
          label: 'VIETTEL'
        }, {
          value: 'VINAPHONE',
          label: 'VINAPHONE'
        }, {
          value: 'MOBIFONE',
          label: 'MOBIFONE'
        }, {
          value: 'Vietnammobile',
          label: 'Vietnammobile'
        }],
        optionsValue: [{
          value: 10000,
          label: '10.000 VNĐ'
        }, {
          value: 20000,
          label: '20.000 VNĐ'
        }, {
          value: 50000,
          label: '50.000 VNĐ'
        }, {
          value: 100000,
          label: '100.000 VNĐ'
        }],
        typeCard: null,
        valueCard: null,
      tableData: [],
      loading: true,
      search: '',
      dialogVisible: false,
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  mounted () {
    this.fetchPoints();
  },
  methods: {
    open(msg) {
        this.$alert(msg, 'Thông tin yêu cầu', {
          confirmButtonText: 'OK',
        });
      },
    async fetchPoints() {
      await axios.get(`/api/points`)
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
    pushRoter () {
        this.$router.push({ name: 'addPost'});
    },
    async addRequest() {
      if (!this.typeCard || !this.valueCard) {
        this.$notify.error({
              title: 'Error',
              message: 'Vui lòng chọn đủ dữ liệu'
            })
            return
      }
        if ((this.user.diemthuong * 1000) < this.valueCard) {
          this.$notify.error({
              title: 'Error',
              message: 'Điểm thưởng của bạn không đủ hoặc bạn vui lòng tải lại trang'
            })
          return
        }
        await axios.post('/api/points', {
            card: this.typeCard,
            value_card: this.valueCard,
        })
        .then((response) => {
            this.$notify.success({
                title: 'Success',
                message: `Đã thêm mới yêu cầu vui lòng đợi phản hồi`
            })
            this.fetchPoints()
            this.$store.dispatch('auth/fetchUser')
            this.dialogVisible = false
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
