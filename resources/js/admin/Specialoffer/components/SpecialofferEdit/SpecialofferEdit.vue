<template>
  <div class="specialoffer-edit" id="specialofferEdit">
    <el-tabs type="border-card" v-model="activeTab" style="margin-bottom:20px">
      <el-tab-pane label="Thông tin chung" name="specialoffer_general">
        <general v-loading="loading"></general>
      </el-tab-pane>
      <el-tab-pane label="Thông tin chi tiết" name="specialoffer_data">
          <dataSpecialoffer></dataSpecialoffer>
      </el-tab-pane>
      <el-tab-pane label="Danh sách sản phẩm" name="specialoffer_pickProduct">
        <pickProduct></pickProduct>
      </el-tab-pane>
      <el-tab-pane label="Hình ảnh">
        <imageAvatar></imageAvatar>
      </el-tab-pane>
    </el-tabs>
    <el-row style="position: fixed; bottom: 0px; right: 0px; z-index: 99; ">
            <el-button type="success" @click="saveSpecialoffer()">Lưu</el-button>
            <router-link :to="'/specialoffer'"  ><el-button type="danger">Hủy</el-button></router-link>
    </el-row>
  </div><!-- /.product-edit -->
</template>
<script src="./SpecialofferEdit.js"></script>