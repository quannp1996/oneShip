<template>
    <div>
        <el-transfer
            v-loading="loading"
            filterable
            :titles="['Bộ sưu tập có', 'Bộ sưu tập đã chọn']"
            v-model="collection"
            :data="data"
        >
       <span slot-scope="{ option }" data-toggle="collapse" :href="'#collapse'+option.key" aria-expanded="false" :aria-controls="'collapse'+option.key">{{ option.key }}:{{ option.label }}
         <div>
            <div class="small text-danger" v-html="option.description"></div>
             <!-- <el-radio v-model="primaryCategoryId" :label="option.key"><span class="text-success small">Click vào đây nếu là Danh mục chính</span></el-radio>-->
         </div>
        </span>
        </el-transfer>
        <!-- <el-button class="transfer-footer" slot="left-footer" size="small"
            >Operation</el-button
          >
          <el-button class="transfer-footer" slot="right-footer" size="small"
            >Operation</el-button
          > -->
    </div>
</template>
<style>
    @import "../../css/style.css";
</style>
<script>
    import api from '../../helpers/api';

    export default {
        name: 'ProductAssociate',
        data: function() {
            return {
                productId: Number(window.product_id),
                input: '',
                state: '',
                data: [],
                radio: '',
                loading: true,
                filterMethod(query, item) {
                    return item.initial.toLowerCase().indexOf(query.toLowerCase()) > -1;
                },
            };
        },
        mounted() {
            // this.cateDataByID();
            this.querySearchAsync();
        },
        computed: {
            // primary_category_id() {
            //   return this.$store.state.d.cateContent;
            // },
            collection: {
                get() {
                    return this.$store.state.g.collectionContent;
                },
                set(value) {
                    this.$store.dispatch('g/cateGetData', value);
                },
            },
        },
        methods: {
            deleteCate(key) {
                this.$store.dispatch('g/cateDelete', key);
            },
            addCate(item) {
                const cateData = [];
                cateData.push({
                    value: item.value,
                    id: item.id,
                });
                this.$store.dispatch('g/cateSet', cateData);
            },

            async querySearchAsync(queryString, cb) {
                const url = 'admin/ajax/collection/controller/getCollection';
                const cate = await api.request('GET', url, { queryString });
                const cateData = [];
                Array.from(cate.data.data).forEach((child) => {
                    cateData.push({
                        label: child.desc.name,
                        key: child.id,
                        description: child.desc.short_description,
                    });
                });
                this.data = cateData;
                await this.cateDataByID().then(() => {
                    this.loading = false;
                });
                // var results = queryString ? links.filter(this.createFilter(queryString)) : links;
                // clearTimeout(this.timeout);
                // cb(cateData);
            },
            handleChange(value, direction, movedKeys) {
                console.log(value, direction, movedKeys);
            },
            createFilter(queryString) {
                return (link) => {
                    return (
                        link.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0
                    );
                };
            },
            getAndSetData(content) {
                this.$store.dispatch('g/cateGetData', content);
            },
            async cateDataByID() {
                const url = `admin/ajax/collection/${this.productId}/controller/collectionData`;
                const products = await api.request('GET', url);

                if (products) {
                    this.getAndSetData(products.data.data);
                }
            },
        },
    };
</script>
