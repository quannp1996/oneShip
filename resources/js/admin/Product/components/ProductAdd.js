import api from '../helpers/api';
import arrayMixin from '../mixins/arrayMixin.js';
import messageMixin from '../mixins/messageMixin.js';
import axios from 'axios';
import {eventBus} from '../app.js';
import numberFormat from '../mixins/numberFormat.js';

export default {
    mixins: [arrayMixin, messageMixin, numberFormat],
    name: 'ProductVariantAdd',
    data() {
        return {
            centerDialogVisible: false,
            form: {
                price: 0,
                global_price: 0,
                sku: '',
                stock: 1997,
                optionIds: '',
                optionValueIds: '',
                status: '1',
            },

            productId: isNaN(Number(window.product_id)) ? 0 : Number(window.product_id),

            // Mảng check thứ tự thuộc tính
            numberOfAttrGroup: [
                {t: 123},
            ],
            disabled: false,
            options: [],
            options_value: [],
            choice: {
                optionIds: [],
                optionValueIds: [],
            },
            imageVarials: [],
            optionValueByOptionId: [],
            indexImageOption: '',
            canCreateVariant: false,
            herf: window.location.origin,
            type: 'product',
            optionCanAddImg: this.$store.state.c.optionCanAddImg,
        };
    },

    mounted() {
        this.getAllOption();
        this.getAllOptionsValue();
    },
    computed: {
        price: {
            get() {
                return this.numberFormat(this.form.price);
            },
            set(value) {
                this.form.price = value.replace(/[^0-9]/g, '');
            },
        },
        priceGlobal: {
            get() {
                return this.numberFormat(this.form.global_price);
            },
            set(value) {
                this.form.global_price = value.replace(/[^0-9]/g, '');
            },
        },
    },
    methods: {
        handleRemove(file) {
            // const data = this.$store.state.c.imageVarials[file.sort];
            this.$store.dispatch('c/deleteImageVarials', file);
            this.imageVarials = this.$store.state.c.imageVarials;
        },
        someComponent2Method: function () {
            // your code here
            eventBus.$emit('fireMethod');
        },
        async getAllOption() {
            const url = 'admin/ajax/option/all';
            const option = await api.request('GET', url);
            const dataCheck = {};
            if (option.data.success) {
                option.data.data.forEach((element) => {
                    if (element.show_image > 0) {
                        dataCheck[element.id] = element.id;
                    }
                });
                this.$store.dispatch('c/optionCanAddImg', dataCheck);
                this.optionCanAddImg = dataCheck;
            }
        },
        loadImageVarials() {
            const data = [];
            // this.productVariant.product_option_values.forEach((element, index) => {
            //     data[index] = JSON.parse(element.images) ?? [];
            // });
            this.$store.dispatch('c/setImageVarialsAdd', data);
            this.imageVarials = this.$store.state.c.imageVarials;
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
        openedHook() {
            this.loadImageVarials();
            this.getAllOptions();
            this.getAllOptionsValue();
        },
        detectIndexImage(index) {
            this.indexImageOption = index;
        },
        async storeProductVariant() {
            if (this.validate()) {
                const form = {
                    price: this.form.price,
                    global_price: this.form.global_price,
                    sku: this.form.sku,
                    video_link: this.form.video_link,
                    stock: this.form.stock,
                    optionIds: this.form.optionIds,
                    optionValueIds: this.form.optionValueIds,
                    status: this.form.status,
                    imageVarials: this.$store.state.c.imageVarials,
                    choice: this.choice,
                };
                const url = `admin/ajax/products/${this.productId}/variants/store`;
                await api.request('POST', url, form).then((response) => {
                    if (response.data.success) {
                        if (response.data.data != 'Error') {
                            this.showMessage(response.data.message, 'success');
                        } else {
                            this.showMessage(response.data.message, 'error');
                        }
                        this.$store.dispatch('b/addVariantID', response.data.data);
                        this.someComponent2Method();
                        this.centerDialogVisible = false;
                        this.imageVarials = [];
                        this.choice.optionIds = [];
                        this.choice.optionValueIds = [];
                        this.form.sku = '';
                        this.form.video_link = '';
                        this.form.price = '';
                        this.form.global_price = '';
                    } else {
                        let error = '';
                        response.data.errors.forEach((element) => {
                            error = '<p>' + error + element[0] + '</p>';
                        });
                        console.log(error);
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
            }
        },

        validate() {
            const countBy = this.countBy(this.choice.optionIds);
            for (const tanSuatXuatHien of Object.values(countBy)) {
                if (tanSuatXuatHien > 1) {
                    this.showMessage('Thuộc tính sản phẩm đang bị trùng', 'error');
                    return false;
                }
            }

            this.choice.optionValueIds.forEach((optionValueId, index) => {
                const currentOptionValue = this.options_value.data.filter((optionValue) => {
                    return optionValue.id == optionValueId;
                });

                if (currentOptionValue[0].option_id != this.choice.optionIds[index]) {
                    this.showMessage('Thuộc tính và giá trị đang không khớp với nhau', 'error');
                    return false;
                }
            });

            return true;
        },

        addAttrGroup() {
            if (
                this.choice.optionIds.includes(null) ||
                this.choice.optionValueIds.includes(null) ||
                this.choice.optionIds.length == 0 ||
                this.choice.optionValueIds.length == 0 ||
                this.choice.optionIds.length != this.numberOfAttrGroup.length ||
                this.choice.optionValueIds.length != this.numberOfAttrGroup.length
            ) {
                this.canCreateVariant = false;
                return this.showMessage('Bạn cần chọn đầy đủ thông tin thuộc tính & giá trị thuộc tính trước đã.', 'error');
            } else {
                this.numberOfAttrGroup.push({t: 123});
            }
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
        addVariantPrd() {
            this.centerDialogVisible = true;
        },
        alertPrd() {
            return this.showMessage('Bạn cần tạo sản phẩm xong thì mới sử dụng được tính năng này.', 'error');
        },
        async getAllOptions() {
            const options = await api.request('GET', 'admin/ajax/option/all');
            this.options = options.data;
        },

        async getAllOptionsValue() {
            const optionsValue = await api.request('GET', 'admin/ajax/option-value/all');
            this.options_value = optionsValue.data;
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

        listingOptionValueData(optionValueDataFromApi, optionId = null) {
            if (!optionId) {
                return optionValueDataFromApi;
            }
            return optionValueDataFromApi.data.filter((optionValue) => {
                return optionValue.option_id == optionId;
            });
        },
    },

    watch: {
        choice: {
            handler(newVal) {
                if (
                    newVal.optionIds.length == newVal.optionValueIds.length &&
                    !newVal.optionIds.includes(null) &&
                    !newVal.optionValueIds.includes(null) &&
                    newVal.optionIds.length > 0 &&
                    newVal.optionValueIds.length > 0 &&
                    newVal.optionValueIds.length == this.numberOfAttrGroup.length

                ) {
                    this.canCreateVariant = true;
                } else {
                    this.canCreateVariant = false;
                }
            },
            deep: true,
        },

        numberOfAttrGroup(newVal) {
            if (
                this.choice.optionIds.length == this.choice.optionValueIds.length &&
                !this.choice.optionIds.includes(null) &&
                !this.choice.optionValueIds.includes(null) &&
                this.choice.optionIds.length > 0 &&
                this.choice.optionValueIds.length > 0 &&
                this.choice.optionValueIds.length == newVal.length
            ) {
                this.canCreateVariant = true;
            } else {
                this.canCreateVariant = false;
            }
        },
    },
};