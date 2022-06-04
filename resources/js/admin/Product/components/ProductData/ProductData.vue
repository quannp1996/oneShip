<template>
    <el-form label-width="150px">
        <el-form-item label="SKU">
            <el-input v-model="code"></el-input>
        </el-form-item>
        <el-form-item label="Nhúng video">
            <el-input type="textarea" v-model="video_link" :rows="3"></el-input>
        </el-form-item>
        <!--<el-form-item label="Giá gạch">
            <el-input v-model="global_price"></el-input>
        </el-form-item> -->
        <el-form-item label="Giá bán">
            <el-input v-model="price"></el-input>
        </el-form-item>
        <el-form-item label="Đơn vị">
            <el-input v-model="donvi"></el-input>
        </el-form-item>
        <el-form-item label="Số lượng">
            <el-input v-model="stock"></el-input>
        </el-form-item>
<!--        <el-form-item label="Thương hiệu">-->
<!--            <el-select v-model="manufacturer_id" placeholder="Select">-->
<!--                <el-option v-for="item in manufacturer" :key="item.manufacturer_id" :label="item.name" :value="item.manufacturer_id"></el-option>-->
<!--            </el-select>-->
<!--        </el-form-item>-->

<!--         <el-form-item label="Trạng thái kho">-->
<!--           <el-select v-model="stock_status_id" placeholder="Select" >-->
<!--             <el-option-->
<!--                 v-for="(item) in stock"-->
<!--                 :key="item.stock_status_id"-->
<!--                 :label="item.name"-->
<!--                 :value="item.stock_status_id">-->
<!--             </el-option>-->
<!--           </el-select>-->
<!--       </el-form-item>-->

    <!--    <el-form-item label="Trọng lượng">
         <el-input type='number' v-model="weight"></el-input>
       </el-form-item>-->
       <el-form-item label="Khuyễn mãi">
            <el-select v-model="is_promotion" placeholder="--Chọn--">
                <el-option
                        v-for="item in optionsPromotion"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                </el-option>
            </el-select>
        </el-form-item>

       <el-form-item label="Thời gian khuyến mãi" v-if="is_promotion == 1">
            <el-date-picker
                v-model="promotion_from"
                type="date"
                format="yyyy/MM/dd"
                value-format="yyyy-MM-dd"
                placeholder="Thời gian bắt đầu"
            >
            </el-date-picker>
            <el-date-picker
                v-model="promotion_to"
                type="date"
                format="yyyy/MM/dd"
                value-format="yyyy-MM-dd"
                placeholder="Thời gian kết thúc"
            >
            </el-date-picker>
        </el-form-item>
        <el-form-item label="Tỉ lệ khuyễn mãi" v-if="is_promotion == 1">
            <el-input v-model="percent"></el-input>
        </el-form-item>
        <el-form-item label="Tình trạng">
            <el-select v-model="status" placeholder="Select">
                <el-option
                        v-for="item in optionsStatus"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                </el-option>
            </el-select>
        </el-form-item>

        <el-form-item label="Sản phẩm mới">
            <el-select v-model="new_old" placeholder="Select">
                <el-option
                    v-for="item in optionNewOld"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
                </el-option>
            </el-select>
        </el-form-item>

        <el-form-item label="Trạng thái">
            <el-select v-model="data_status" placeholder="Select">
                <el-option
                    v-for="item in optionsDataStatus"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
                </el-option>
            </el-select>
        </el-form-item>

        <el-form-item label="Hiển thị ở trang chủ">
            <el-select v-model="is_home" placeholder="Select">
                <el-option
                    v-for="item in optionIsHome"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
                </el-option>
            </el-select>
        </el-form-item>

        <el-form-item label="Sản phẩm hot">
            <el-select v-model="hot" placeholder="Select">
                <el-option
                    v-for="item in optionHot"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
                </el-option>
            </el-select>
        </el-form-item>

        <el-form-item label="Thứ tự">
            <el-input v-model="sort_order"></el-input>
        </el-form-item>

<!--        <el-form-item label="Mã sản phẩm">-->
<!--            <el-input v-model="code"></el-input>-->
<!--        </el-form-item>-->

<!--        <el-form-item label="Màu sắc">-->
<!--            <el-color-picker-->
<!--                v-model="color"-->
<!--                show-alpha-->
<!--                :predefine="predefineColors">-->
<!--            </el-color-picker>-->
<!--        </el-form-item>-->


        <!--<el-form-item label="Freeship">
            <el-radio-group v-model="freeship">
                <el-radio-button label="0">Bật</el-radio-button>
                <el-radio-button label="1">Tắt</el-radio-button>
            </el-radio-group>
        </el-form-item>-->
    </el-form>
</template>
<style lang="scss" scoped>
    .el-input {
        width: 310px;
    }
</style>
<script>
    import numberFormat from '../../mixins/numberFormat.js';
    import api from '../../helpers/api';

    export default {
        name: 'ProductData',
        // props:['lang','label','image'],
        mixins: [numberFormat],
        data: function () {
            return {
                // langData: this.lang,
                productId: Number(window.product_id),
                optionsPromotion: [{
                    value: 0,
                    label: 'Không',
                }, {
                    value: 1,
                    label: 'Có',
                }],
                optionsStatus: [{
                    value: 1,
                    label: 'Ẩn',
                }, {
                    value: 2,
                    label: 'Hiển thị',
                }],
                optionsDataStatus: [{
                    value: 1,
                    label: 'Hết hàng',
                }, {
                    value: 2,
                    label: 'Còn hàng',
                }],
                optionNewOld: [{
                    value: 0,
                    label: 'Ẩn',
                }, {
                    value: 1,
                    label: 'Mới',
                }],
                optionIsHome: [{
                    value: 0,
                    label: 'Không',
                }, {
                    value: 1,
                    label: 'Có',
                }],
                optionHot: [{
                    value: 0,
                    label: 'Không',
                }, {
                    value: 1,
                    label: 'Có',
                }],
                manufacturer: '',
                predefineColors: [
                    '#ff4500',
                    '#ff8c00',
                    '#ffd700',
                    '#90ee90',
                    '#00ced1',
                    '#1e90ff',
                    '#c71585',
                    'rgba(255, 69, 0, 0.68)',
                    'rgb(255, 120, 0)',
                    'hsv(51, 100, 98)',
                    'hsva(120, 40, 94, 0.5)',
                    'hsl(181, 100%, 37%)',
                    'hsla(209, 100%, 56%, 0.73)',
                    '#c7158577',
                    '#cf0c03fa'
                ],
                promotionTime: [
                    new Date(2021, 1, 1, 12, 0, 0),
                    new Date(2021, 2, 1, 12, 0, 0)
                ],
            };
        },
        mounted() {
            this.productDataByID();
            // this.stockData();
            // this.manufacturerData();
        },
        computed: {
            freeship: {
                get() {
                    return this.$store.state.b.content.shipping_required;
                },
                set(value) {
                    this.$store.dispatch('b/setFreeship', value);
                },
            },
            eshopID() {
                return this.$store.state.b.content.eshop_product_id;
            },
            sku: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.sku !== 'undefined') {
                        return this.$store.state.b.content.sku;
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updateSku', value);
                },
            },
            promotion_from: {
                get() {
                    if (typeof this.$store.state.b.content.promotion_from !== 'undefined') {
                        return this.$store.state.b.content.promotion_from;
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updatePromotionFrom', value);
                },
            },
            promotion_to: {
                get() {
                    if (typeof this.$store.state.b.content.promotion_to !== 'undefined') {
                        return this.$store.state.b.content.promotion_to;
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updatePromotionTo', value);
                },
            },
            video_link: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.video_link !== 'undefined') {
                        return this.$store.state.b.content.video_link;
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updateVideoLink', value);
                },
            },
            global_price: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.global_price !== 'undefined') {
                        const priceOrigin = this.$store.state.b.content.global_price;
                        return this.numberFormat(priceOrigin);
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updateGlobal_price', value.replace(/[^0-9]/g, ''));
                },
            },
            price: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.price !== 'undefined') {
                        const priceOrigin = this.$store.state.b.content.price;
                        return this.numberFormat(priceOrigin);
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updatePrice', value.replace(/[^0-9]/g, ''));
                },
            },
            stock: {
                get() {
                    if (typeof this.$store.state.b.content.stock !== 'undefined') {
                        const stockOrigin = this.$store.state.b.content.stock;
                        return this.numberFormat(stockOrigin);
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updateStock', value.replace(/[^0-9]/g, ''));
                },
            },
            data_status: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.data_status !== 'undefined') {
                        return this.$store.state.b.content.data_status;
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updateData_status', value);
                },
            },
            is_promotion: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.is_promotion !== 'undefined') {
                        return this.$store.state.b.content.is_promotion;
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updatePromotion', value);
                },
            },
            color: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.color !== 'undefined') {

                        return this.$store.state.b.content.color;
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updateColor', value);
                },
            },
            new_old: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.is_new !== 'undefined') {
                        return this.$store.state.b.content.is_new;
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updateNew_old', value);
                },
            },
            is_home: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.is_home !== 'undefined') {
                        return this.$store.state.b.content.is_home;
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updateIs_home', value);
                },
            },
            hot: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.hot !== 'undefined') {
                        return this.$store.state.b.content.hot;
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updateHot', value);
                },
            },
            sort_order: {
                set(value) {
                    this.$store.dispatch('b/setSort_order', value);
                },
                get() {
                    if (typeof this.$store.state.b.content.sort_order !== 'undefined') {
                        return this.$store.state.b.content.sort_order;
                    }
                },
            },
            code: {
                set(value) {
                    this.$store.dispatch('b/setCode', value);
                },
                get() {
                    if (typeof this.$store.state.b.content.code !== 'undefined') {
                        return this.$store.state.b.content.code;
                    }
                },
            },
            manufacturer_id: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.manufacturer_id !== 'undefined') {
                        return this.$store.state.b.content.manufacturer_id;
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updateManufacturer', value);
                },
            },
            status: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.status !== 'undefined') {
                        return this.$store.state.b.content.status;
                    }
                },
                set(value) {
                     this.$store.dispatch('b/updateStatus', value);
                },
            },
            weight: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.weight !== 'undefined') {
                        return this.$store.state.b.content.weight;
                    }
                },
                set(value) {
                    if (value >= 0) {
                        this.$store.dispatch('b/updateWeight', value);
                    }
                },
            },
            donvi: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.donvi !== 'undefined') {
                        return this.$store.state.b.content.donvi;
                    }
                },
                set(value) {
                    this.$store.dispatch('b/updateDonVi', value);
                },
            },
            percent: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.b.content.promotion_percent !== 'undefined') {
                        return this.$store.state.b.content.promotion_percent;
                    }
                },
                set(value) {
                    if (value >= 0) {
                        this.$store.dispatch('b/updatePromotionPercent', value);
                    }
                },
            },
        },
        methods: {
            getAndSetData(content) {
                this.$store.dispatch('b/contentData', content);
            },
            async productDataByID() {
                if (!Number.isNaN(this.productId)) {
                    const url = `admin/ajax/products/${this.productId}/controller/prdData`;
                    const products = await api.request('GET', url);
                    console.log('products',products.data.data);
                    if (products) {
                        this.getAndSetData(products.data.data);
                    }
                }
            },
            async stockData() {
                const url = 'admin/ajax/products/controller/getStock';
                const stock = await api.request('GET', url);
                this.$store.dispatch('b/setDataPrdOrigin', stock.data.data);
                this.stock = stock.data.data;
            },
            async manufacturerData() {
                const fillters = [];
                const noPagi = 1;
                const perPage = 50;
                const url = 'admin/ajax/manufacturer/controller/manufacturerList';
                const result = await api.request('POST', url, {fillters, noPagi, perPage});
                if (!result.data.error) {
                    this.manufacturer = result.data.data;
                }
            },
        },
    };
</script>
