<template>
    <div class="tag-edit" id="tagEdit" v-loading="loading">
        <el-tabs type="border-card" v-model="activeTab" style="margin-bottom:20px">
            <el-tab-pane label="Thông tin chung" name="collection_data">
                <dataCollection></dataCollection>
            </el-tab-pane>
            <el-tab-pane label="Thông tin chi tiết" name="collection_detail">
                <detailCollection></detailCollection>
            </el-tab-pane>
<!--            <el-tab-pane label="Danh sách sản phẩm" name="collection_general">-->
<!--                <general></general>-->
<!--            </el-tab-pane>-->
            <!--<el-tab-pane label="Tag" name="collection_tag">
                <tagCollection></tagCollection>
            </el-tab-pane>-->
            <el-tab-pane label="Hình ảnh">
                <collection-image></collection-image>
            </el-tab-pane>
        </el-tabs>
        <el-row style="position: fixed; bottom: 10px; right: 10px; z-index: 99;">
            <el-button type="success" @click="saveCollection()">Lưu</el-button>
            <router-link :to="'/collection'">
                <el-button type="danger">Hủy</el-button>
            </router-link>
        </el-row>
    </div><!-- /.product-edit -->
</template>
<style>
    .el-icon-error{
        margin-left: 10%;
    }
</style>
<script src="./CollectionEdit.js"></script>