<template>
    <div>
        <el-row>
            <el-table
                v-loading="loading"
                :data="tableData.filter(data => !search || data.card.toLowerCase().includes(search.toLowerCase()))"
                height="900"
                border
                style="width: 100%"
            >
                <el-table-column
                prop="user_name"
                label="Người tạo"
                sortable
                />
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
                    <el-button type="success" @click="approvedRequest(scope.row.id)" icon="el-icon-check" circle></el-button>
                    <el-button type="danger" icon="el-icon-delete" circle @click="cancelRequest(scope.row.id)"></el-button>
                </template>
                </el-table-column>
            </el-table>
        </el-row>
        <el-dialog
        title="Duyệt yêu cầu đổi thẻ"
        :visible.sync="dialogVisible"
        width="50%">
        <el-form>
            <el-form-item>
                <el-alert
                    title="Vui lòng điền thông tin thẻ hoặc lý do từ chối ở bên dưới"
                    type="info"
                    show-icon>
                </el-alert>
            </el-form-item>
            <el-form-item>
                <el-input
                type="textarea"
                :rows="7"
                v-model="reason">
                </el-input>
            </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="dialogVisible = false">Hủy</el-button>
            <el-button type="primary" @click="addRequest()">Lưu</el-button>
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
      reason: null,
      idApproved: null,
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  mounted () {
    this.fetchPoints();
  },
  methods: {
    async fetchPoints() {
      await axios.get(`/api/getPoints`)
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
    approvedRequest (row) {
        this.idApproved = row;
        this.dialogVisible = true;
        this.status = 1
    },
    cancelRequest(row) {
      this.idApproved = row;
      this.dialogVisible = true;
      this.status = 2
    },
    async addRequest() {
        await axios.post('/api/progressPoints', {
            answer: this.reason,
            status: this.status,
            id: this.idApproved,
        })
        .then((response) => {
            this.$notify.success({
                title: 'Success',
                message: `Đã cập nhật trạng thái thẻ`
            })
            this.fetchPoints()
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
