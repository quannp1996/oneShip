<template>
    <div class="product-edit">
        <el-tabs type="border-card" v-model="activeTab" style="margin-bottom:20px">
            <el-tab-pane label="Thông tin chung" name="product_general">
                <product-variant-information v-model="edit_thread.body"></product-variant-information>
            </el-tab-pane>
            <el-tab-pane label="Thông tin chi tiết">
                <product-data></product-data>
            </el-tab-pane>
            <el-tab-pane label="Danh mục ngành hàng">
                <product-associate></product-associate>
            </el-tab-pane>
            <el-tab-pane label="Bộ lọc">
                <product-filter></product-filter>
            </el-tab-pane>
            <el-tab-pane label="Biến thể sản phẩm" name="product_variant"
                         v-if="this.productId && !isNaN(this.productId)">
                <product-variant-add></product-variant-add>
                <product-variant-list class="mt-3"></product-variant-list>
            </el-tab-pane>
            <el-tab-pane label="Bộ sưu tập">
                <product-collection></product-collection>
            </el-tab-pane>
            <el-tab-pane label="Hình ảnh sản phẩm">
                <product-image></product-image>
            </el-tab-pane>
        </el-tabs>
        <el-row style="position: fixed; bottom: 10px; right: 10px; z-index: 99;">
            <el-button type="success" @click="saveProduct">Lưu</el-button>
            <el-button type="danger" @click="backToHome">Hủy</el-button>
        </el-row>
    </div><!-- /.product-edit -->
</template>

<script src="./ProductEdit.js"></script>
