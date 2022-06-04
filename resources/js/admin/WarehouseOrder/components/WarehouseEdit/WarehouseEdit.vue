<template>
  <div class="tag-edit" id="tagEdit">
    <el-tabs type="border-card" v-model="activeTab" style="margin-bottom:20px">
      <el-tab-pane label="Thông tin chung" name="tag_general">
        <general></general>
      </el-tab-pane>
      <el-tab-pane label="Thông tin chi tiết" name="tag_data">
          <dataTag></dataTag>
      </el-tab-pane>
      <el-tab-pane label="Hình ảnh">
        <imageAvatar></imageAvatar>
      </el-tab-pane>
    </el-tabs>
    <el-row style="position: fixed; bottom: 0px; right: 0px; z-index: 99; ">
            <el-button type="success" @click="saveTag()">Lưu</el-button>
            <router-link :to="'/tags'"  ><el-button type="danger">Hủy</el-button></router-link>
    </el-row>
  </div><!-- /.product-edit -->
</template>
<script src="./TagEdit.js"></script>

