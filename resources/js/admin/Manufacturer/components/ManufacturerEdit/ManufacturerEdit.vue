<template>
    <div class="manufacturer-edit" id="manufacturerEdit">
        <el-tabs type="border-card" v-model="activeTab" style="margin-bottom:20px">
            <el-tab-pane label="Thông tin chung" name="manufacturer_general">
                <general></general>
            </el-tab-pane>
            <el-tab-pane label="Danh mục ngành hàng" name="manufacturer_associate">
                <associate></associate>
            </el-tab-pane>
            <!--<el-tab-pane label="Hình ảnh">
                <imageAvatar></imageAvatar>
            </el-tab-pane>-->
        </el-tabs>
        <el-row style="position: fixed; bottom: 10px; right: 10px; z-index: 99;">
            <el-button type="success" @click="saveManufacturer()">Lưu</el-button>
            <router-link :to="'/manufacturer'">
                <el-button type="danger">Hủy</el-button>
            </router-link>
        </el-row>
    </div><!-- /.product-edit -->
</template>
<script src="./ManufacturerEdit.js"></script>