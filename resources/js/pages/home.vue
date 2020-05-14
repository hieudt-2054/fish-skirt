<template>
  <el-card class="box-card">
    <el-row :gutter="20">
      <el-col :span="6">
        <el-badge value="Loading" class="item" type="success">
          <el-button size="small">Cân nặng dự đoán sẽ giảm trong 7 ngày tới</el-button>
        </el-badge>
      </el-col>
      <el-col :span="6">
        <el-badge value="Loading" class="item">
          <el-button size="small">Số lượng thực phẩm đang có trên hệ thống</el-button>
        </el-badge>
      </el-col>
      <el-col :span="6">
        <el-badge value="Loading" class="item">
          <el-button size="small">Mức lượng calo hấp thụ trong ngày</el-button>
        </el-badge>
      </el-col>
      <el-col :span="6">
        <el-badge value="Loading" class="item">
          <el-button size="small">Mức lượng calo hấp thụ trong tuần</el-button>
        </el-badge>
      </el-col>
    </el-row>
  </el-card>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
