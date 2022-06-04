<template>
  <div class="promotionCampaign-edit" id="promotionCampaignEdit">
    <el-tabs type="border-card" v-model="activeTab" style="margin-bottom:20px">
      <el-tab-pane label="Thông tin chung" name="promotionCampaign_general">
        <general  v-loading="loading"></general>
      </el-tab-pane>
      <el-tab-pane label="Thông tin chi tiết" name="promotionCampaign_data">
          <dataPromotionCampaign></dataPromotionCampaign>
      </el-tab-pane>
      <el-tab-pane label="Danh sách sản phẩm" name="promotionCampaign_pickProduct">
        <pickProduct></pickProduct>
      </el-tab-pane>
      <el-tab-pane label="Danh mục ngành hàng" name="promotionCampaign_associate">
        <associate></associate>
      </el-tab-pane>
      <el-tab-pane label="Hình ảnh">
        <imageAvatar></imageAvatar>
      </el-tab-pane>
    </el-tabs>
    <el-row style="position: fixed; bottom: 0px; right: 0px; z-index: 99; ">
            <el-button type="success" @click="savePromotionCampaign()">Lưu</el-button>
            <router-link :to="'/promotionCampaign'"  ><el-button type="danger">Hủy</el-button></router-link>
    </el-row>
    <checkIssetPrd></checkIssetPrd>
  </div><!-- /.product-edit -->
</template>
<script src="./PromotionCampaignEdit.js"></script>
