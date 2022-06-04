import ProductVariantAdd from './ProductVariant/ProductVariantAdd.vue';
import ProductVariantList from './ProductVariant/ProductVariantList.vue';
import ProductVariantInformation from './ProductVariant/ProductVariantInformation.vue';
import ProductData from './ProductData/ProductData.vue';
import ProductImage from './ProductImage/ProductImage.vue';
import ProductAssociate from './ProductAssociate/ProductAssociate.vue';
import ProductCollection from './ProductCollection/ProductCollection.vue';
import ProductFilter from './ProductFilter/ProductFilter.vue';
import ProductTag from './ProductTag/ProductTag.vue';
import api from '../helpers/api';

export default {
    name: 'ProductEdit',
    components: {
        ProductVariantAdd,
        ProductVariantList,
        ProductVariantInformation,
        ProductData,
        ProductImage,
        ProductAssociate,
        ProductCollection,
        ProductTag,
        ProductFilter
    },
    data() {
        return {
            productId: Number(window.product_id),
            activeTab: 'product_general',

            // Mảng check thứ tự thuộc tính
            numberOfAttrGroup: [
                {t: 123},
            ],
            // productsDesc:null,
            productInfo: [],
            options: [],
            options_value: [],
            choice: {
                optionIds: [],
                optionValueIds: [],
            },
            edit_thread: {
                body: '',
            },
            optionValueByOptionId: [],

            canCreateVariant: false,
        };
    },
    computed: {
        // result () {
        //   return this.$store.state.result
        // }
    },
    mounted() {
    },
    // created() {
    //     window.onbeforeunload = function() {
    //            return null;
    //     };
    // },
    methods: {
        backToHome() {
            const herfVIP = window.location.origin;
            const typeVIP = 'products';
            window.location.href = `${herfVIP}/${typeVIP}`;
        },
        async saveProduct() {
            const product_description = this.$store.state.a.content;
            const product_data = this.$store.state.b.content;
            const product_category = this.$store.state.d.cateContent;
            const product_collection = this.$store.state.g.collectionContent;
            const product_filter = this.$store.state.f.filterContent;
            const product_tags = this.$store.state.e.tagsContent;
            const product_labels = this.$store.state.e.labelsContent;
            const arrID_variants_add = this.$store.state.b.arrID_variants_add;
            const fileList = this.$store.state.c.fileList;
            const url = `admin/ajax/products/${this.productId}/controller/save`;
            const result = await api.request('POST', url, {
                product_description,
                product_data,
                fileList,
                product_category,
                product_collection,
                product_tags,
                product_filter,
                product_labels,
                arrID_variants_add,

            }).then().catch((err) => {
                if (err.response.status === 422) {
                    const logErr = err.response.data.errors;
                    let text = '';
                    Object.values(logErr).forEach((log,key) => {
                        if(key == 0){
                            text += log;
                        }
                    });
                    this.openError(text);
                } else {
                    this.openError(err.message);
                }
            });
            const herfVIP = window.location.origin;
            const typeVIP = 'products';
            if (!result.data.error) {
                this.openSuccess(result.data.msg);
                if (isNaN(this.productId)) {
                    window.location.href = `${herfVIP}/${typeVIP}`;
                }
            } else {
                this.openError(result.data.msg);
            }
        },
        openSuccess(msg) {
            this.$message({
                message: msg,
                type: 'success',
            });
        },
        openError(msg) {
            this.$message.error(msg);
        },
    },
}; // End class
