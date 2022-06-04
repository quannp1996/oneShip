<template>
    <el-table :data="listProductVariants.data" border style="width: 100%" width="100%" empty-text="Không có dữ liệu">
        <el-table-column label="ID" width="60">
            <template slot-scope="scope">{{ scope.row.product_variant_id }}</template>
        </el-table-column>

        <el-table-column label="Biến thể" width="250">
            <template slot-scope="scope">
                <p v-for="prodOptValue in scope.row.product_option_values" :key="prodOptValue.product_option_value_id">
                <span v-if="prodOptValue.option && prodOptValue.option_value">
                  <b>{{ prodOptValue.option.desc.name  }}</b>:
                  {{ prodOptValue.option_value.desc.name  }}
                </span>
                </p>
            </template>
        </el-table-column>

        <el-table-column label="Mã SKU">
            <template slot-scope="scope">
                {{ scope.row.sku }}
            </template>
        </el-table-column>

        <el-table-column label="Root">
            <template slot-scope="scope">
                <i class="fa fa-check-circle" :class="'text-primary'" v-if="scope.row.is_root == 1" aria-hidden="true"></i>
                <i class="fa fa-times" @click="markIsRoot(scope.row.product_variant_id)" :class="'text-danger'" aria-hidden="true" v-else></i>
            </template>
        </el-table-column>

        <el-table-column label="Ngày tạo">
            <template slot-scope="scope">
        <span style="display: block;
                      word-break: break-word;">{{ scope.row.created_at }}</span>
            </template>
        </el-table-column>

        <el-table-column label="Ngày cập nhật">
            <template slot-scope="scope">
                <span style="display: block;
                      word-break: break-word;">{{ scope.row.updated_at }}</span>
            </template>
        </el-table-column>

        <el-table-column label="Thao tác">
            <template slot-scope="scope">
                <el-dropdown trigger="click">
          <span class="el-dropdown-link">
            Chọn<i class="el-icon-arrow-down el-icon--right"></i>
          </span>
                    <el-dropdown-menu slot="dropdown">
                        <product-variant-edit :product-variant="scope.row"></product-variant-edit>
                        <product-variant-delete :product-variant="scope.row"></product-variant-delete>
                    </el-dropdown-menu>
                </el-dropdown>
            </template>
        </el-table-column>
    </el-table>
</template>

<script>
    import api from '../../helpers/api';
    import ProductVariantDelete from '../ProductVariant/ProductVariantDelete.vue';
    import ProductVariantEdit from '../ProductVariant/ProductVariantEdit.vue';
    import {eventBus} from '../../app.js';

    export default {
        components: {ProductVariantDelete, ProductVariantEdit},
        data() {
            return {
                listProductVariants: [],
                productId: Number(window.product_id),
            };
        },

        created() {
            this.$bus.on('storeNewProductVariant', (productVariant) => {
                this.listProductVariants.data.unshift(productVariant.data);
            });

            this.$bus.on('deleteProductVariant', (productVariant) => {
                const position = this.listProductVariants.data.indexOf(productVariant);
                this.listProductVariants.data.splice(position, 1);
            });
            eventBus.$on('fireMethod', () => {
                this.getAllProductVariants();
            });
        },

        mounted() {
            this.getAllOption();
        },
        methods: {
            numberFormat(number) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND',
                }).format(number);
            },
            async getAllOption() {
                this.getAllProductVariants();
                const url = 'admin/ajax/option/all';
                const option = await api.request('GET', url);
                const dataCheck = {};
                if (option.data.success && this.checkRun == 0) {
                    option.data.data.forEach((element) => {
                        if (element.show_image > 0) {
                            dataCheck[element.id] = element.id;
                        }
                    });
                    this.$store.dispatch('c/optionCanAddImg', dataCheck);
                    this.optionCanAddImg = dataCheck;
                    this.checkRun++;
                }
            },
            async getAllProductVariants() {
                if (!isNaN(this.productId)) {
                    const url = `admin/ajax/products/${this.productId}/variants`;
                    const productsVariant = await api.request('GET', url);
                    this.listProductVariants = productsVariant.data;
                } else {
                    const prdID = 0;
                    const url = `admin/ajax/products/${prdID}/variantsByIDs`;
                    const ids = this.$store.state.b.arrID_variants_add;
                    const productsVariant = await api.request('POST', url, {ids});
                    this.listProductVariants = productsVariant.data;
                }
            },

            async markIsRoot(id){
                const variants = await api.request('POST', `admin/ajax/products/markRootVariant`, {
                    id: id,
                    productID: this.productId
                });
                this.listProductVariants = variants.data;
            }
        },
    };
</script>
