<template>
    <div class="ml-2 ml-auto">
        <el-dropdown-item icon="el-icon-edit">
            <el-button type="text" @click="centerDialogVisible = true"
            >Sửa biến thể sản phẩm
            </el-button
            >
        </el-dropdown-item>
        <el-dialog
                title="Sửa biến thể sản phẩm"
                :visible.sync="centerDialogVisible"
                :append-to-body="true"
                width="80%"
                center
                @opened="openedHook"
                @close="loading = true"
        >
            <el-form ref="form" :model="form" label-width="130px" v-loading="loading">
                <el-form-item label="Thuộc tính">
                    <span slot="label">
                        Thuộc tính <br/>
                        <el-button type="text" class="mt-2" @click="addAttrGroup"
                        >+Thêm thuộc tính</el-button
                        >
                    </span>
                    <div class="row">
                        <div
                                class="col-4 mag-bot-10"
                                v-for="(item, index) in numberOfAttrGroup"
                                :key="index"
                        >
                            <el-card
                                    class="box-card"
                                    v-if="numberOfAttrGroup[index]['t']"
                                    :body-style="{ padding: '0px' }"
                            >
                                <div class="text item">
                                    <el-form-item label="Thuộc tính" class="mt-2 mr-2">
                                        <el-select
                                                placeholder="Màu sắc, Kích thước, v.v..."
                                                class="w-100"
                                                v-model="choice.optionIds[index]"
                                                @change="filterOptionValueByOptionId($event, index)"
                                        >
                                            <el-option
                                                    v-for="opt in options.data"
                                                    :key="opt.id"
                                                    :label="opt.desc.name !=null ? opt.desc.name : 'Trống tên: Mã '+opt.id"
                                                    :value="opt.id"
                                            >
                                                <p v-if="opt.desc.name !=null && opt.desc.short_description !=null">
                                                    {{opt.desc.name + ' (' + opt.desc.short_description + ')'}}</p>
                                                <p v-if="opt.desc.name ==null && opt.desc.short_description == null">
                                                    {{'Trống tên: Mã '+opt.id }}</p>
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                    <el-form-item label="Giá trị" class="mr-2">
                                        <el-select
                                                placeholder="Vàng, XXL, v.v..."
                                                class="w-100"
                                                v-model="choice.optionValueIds[index]"
                                                filterable
                                                allow-create
                                                remote
                                        >
                                            <el-option
                                                    v-for="optVal in optionValueByOptionId[index]"
                                                    :key="optVal.desc.name"
                                                    :label="optVal.desc.name !=null ? optVal.desc.name : 'Trống tên: Mã '+optVal.id"
                                                    :value="optVal.id"
                                            ></el-option>
                                        </el-select>
                                    </el-form-item>
                                    <el-button
                                            class="p-2 card-close-btn"
                                            type="primary"
                                            @click="removeAttrGroup(index)"
                                    >
                                        <i class="el-icon-close"></i>
                                    </el-button>
                                </div>
                                <!-- text item -->
                            </el-card>
                        </div>
                    </div>
                </el-form-item>
                <el-form-item label="Mã SKU *">
                    <el-input v-model="form.sku"></el-input>
                </el-form-item>
                <el-form-item class="dialog-footer">
                    <el-button @click="centerDialogVisible = false">Đóng</el-button>
                    <el-button
                            type="primary"
                            @click="updateProductVariant"
                            v-show="canCreateVariant"
                    >Lưu biến thể
                    </el-button
                    >
                </el-form-item>
            </el-form>
        </el-dialog>
    </div>
</template>
<script src="../ProductVariant/ProductVariantEdit.js"></script>
<style lang="css" scope>
    .card-close-btn {
        float: right;
        position: absolute;
        top: -10px;
        right: 0;
        border: 1px solid;
        border-radius: 22px;
    }

    .mag-bot-10 {
        margin-bottom: 10px;
    }
</style>