import api from '../../helpers/api.js';
import axios from 'axios';
import arrayMixin from '../../mixins/arrayMixin.js';
import messageMixin from '../../mixins/messageMixin.js';
import {eventBus} from '../../app.js';
import numberFormat from '../../mixins/numberFormat.js';

export default {
    mixins: [arrayMixin, messageMixin, numberFormat],
    name: 'ProductVariantEdit',
    props: {
        productVariant: Object,
    },

    data() {
        return {
            centerDialogVisible: false,
            form: {
                price: 0,
                global_price: 0,
                sku: '',
                stock: 0,
                optionIds: this.optionIds,
                optionValueIds: this.optionValueIds,
                status: '1',
            },

            productId: isNaN(Number(window.product_id)) ? 0 : Number(window.product_id),

            // Mảng check thứ tự thuộc tính
            numberOfAttrGroup: [],
            disabled: false,
            options: [],
            options_value: [],
            choice: {
                optionIds: [],
                optionValueIds: [],
            },
            optionValueByOptionId: [],

            canCreateVariant: true,
            indexImageOption: '',
            herf: window.location.origin,
            type: 'product',
            checkRun: 0,
            loading: true,
        };
    },

    mounted() {
        // this.getAllOptionsValue();
    },
    computed: {
        imageVarials() {
            return this.$store.state.c.imageVarials;
        },
        optionCanAddImg() {
            return this.$store.state.c.optionCanAddImg;
        },
        price: {
            get() {
                return this.numberFormat(this.form.price);
            },
            set(value) {
                return this.form.price = value.replace(/[^0-9]/g, '');
            },
        },
        priceGlobal: {
            get() {
                return this.numberFormat(this.form.global_price);
            },
            set(value) {
                return this.form.global_price = value.replace(/[^0-9]/g, '');
            },
        },
    },
    methods: {
        setDefaultImgVariable() {
            this.$store.dispatch('c/setImageVarialsAdd', []);
        },
        handleRemove(file) {
            console.log(file);
            // const data = this.$store.state.c.imageVarials[file.sort];
            this.$store.dispatch('c/deleteImageVarials', file);
        },
        async loadImageVarials() {
            const data = [];
            this.productVariant.product_option_values.forEach((element, index) => {
                data[index] = typeof element.images !== 'undefined' && element.images != '' ? JSON.parse(element.images) : [];
            });
            this.$store.dispatch('c/setImageVarials', data);
        },
        detectIndexImage(index) {
            this.indexImageOption = index;
        },
        openedHook() {
            this.setDefaultImgVariable();
            this.getAllOptions().then((res) => {
                this.getAllOptionsValue().then((res) => {
                    this.fillForm();
                });
            });
        },
        async uploadFiles(req) {
            const formdata = new FormData();
            formdata.append('Filedata', req.raw);
            // formdata.append('object_id', this.productId);
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .content,
                },
            };
            axios
                .post('/admin/ajax/products/controller/imgUpload', formdata, config)
                .then((res) => {
                    this.$store.dispatch('c/imageVarials', [res.data.data.fileName, this.indexImageOption]);
                    this.imageVarials = this.$store.state.c.imageVarials;
                    console.log('image upload succeed.');
                    this.canCreateVariant = true;
                })
                .catch((err) => {
                    console.log(err.message);
                });
        },
        async fillForm() {
            // this.numberOfAttrGroup = [];
            this.form = {
                price: this.productVariant.price,
                global_price: this.productVariant.global_price,
                sku: this.productVariant.sku,
                stock: this.productVariant.stock,
                status: this.productVariant.status,
            };

            await this.loadImageVarials();
            this.choice.optionIds = [];
            this.choice.optionValueIds = [];
            await this.productVariant.product_option_values.forEach((productVariantItem, index) => {
                this.numberOfAttrGroup[index] = {t: 123};
                this.choice.optionIds.push(productVariantItem.option_id);
                this.choice.optionValueIds.push(productVariantItem.option_value_id);
                const optionValuesFollowByOptionId = this.options_value.data.filter((optionValue) => {
                    return optionValue.option_id == productVariantItem.option_id;
                });
                this.optionValueByOptionId[index] = optionValuesFollowByOptionId;
                this.loading = false;
            });
            this.loading = false;
        },

        async updateProductVariant() {
            const form = {
                price: this.form.price,
                global_price: this.form.global_price,
                sku: this.form.sku,
                stock: this.form.stock,
                optionIds: this.form.optionIds,
                optionValueIds: this.form.optionValueIds,
                status: this.form.status,
                imageVarials: this.$store.state.c.imageVarials,
                choice: this.choice,
                product_variant_id: this.productVariant.product_variant_id,
                old_product_option_values: this.productVariant.product_option_values,
            };
            const url = `admin/ajax/products/${this.productId}/variants/storeUpdate`;
            await api.request('POST', url, form).then((response) => {
                if (response.data.success) {
                    if (response.data.data != 'Error') {
                        this.showMessage(response.data.message, 'success');
                    } else {
                        this.showMessage(response.data.message, 'error');
                    }
                    this.centerDialogVisible = false;
                    this.someComponent2Method();
                } else {
                    let error = '';
                    response.data.errors.forEach((element) => {
                        error = '<p>' + error + element[0] + '</p>';
                    });
                    this.showMessage(error, 'error');
                }
            }).catch((err) => {
                let msg = '';
                Object.values(err.response.data.errors).forEach((element) => {
                    if (typeof element[0] !== 'undefined') {
                        msg = msg + '<p>' + element[0] + '</p>';
                    }
                });
                this.showMessage(msg, 'error');
            });
        },
        someComponent2Method: function () {
            // your code here
            eventBus.$emit('fireMethod');
        },
        addAttrGroup() {
            // if (
            //     this.choice.optionIds.includes(null) ||
            //     this.choice.optionValueIds.includes(null) ||
            //     this.choice.optionIds.length == 0 ||
            //     this.choice.optionValueIds.length == 0 ||
            //     this.choice.optionIds.length != this.numberOfAttrGroup.length ||
            //     this.choice.optionValueIds.length != this.numberOfAttrGroup.length
            // ) {
            //     this.canCreateVariant = false;
            //     return this.showMessage('Bạn cần chọn đầy đủ thông tin thuộc tính & giá trị thuộc tính trước đã.', 'error');
            // } else {
            this.numberOfAttrGroup.push({t: Date.now()});
            // }
        },

        removeAttrGroup(index) {
            // Lấy current optionId đang được chọn nếu có
            if (this.numberOfAttrGroup.length > 1) {
                this.$delete(this.choice.optionIds, index);
                this.$delete(this.choice.optionValueIds, index);
                this.$delete(this.numberOfAttrGroup, index);
            } else {
                return this.showMessage('Sản phẩm bắt buộc phải có thuộc tính', 'error');
            }
        },


        async getAllOptions() {
            const options = await api.request('GET', 'admin/ajax/option/all');
            this.options = options.data;
        },

        async getAllOptionsValue() {
            const optionsValue = await api.request('GET', 'admin/ajax/option-value/all');
            this.options_value = optionsValue.data;
            return this.options_value;
        },

        filterOptionValueByOptionId(optionId, position) {
            const displayTime = this.choice.optionIds.filter((optionIdItem) => {
                return optionIdItem == optionId;
            }).length;
            if (displayTime <= 1) {
                const optionValueByPosition = this.options_value.data.filter((optionValue) => {
                    return optionValue.option_id == optionId;
                });

                return this.optionValueByOptionId[position] = optionValueByPosition;
            } else {
                return this.$message({
                    showClose: true,
                    message: 'Thuộc tính này đã được chọn, hoặc đã xảy ra lỗi khi vận hành',
                    type: 'error',
                    duration: 10000,
                });
            }
        },
    },
}; // End class
