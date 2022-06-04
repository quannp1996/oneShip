<template>
    <el-form>
        <div class="form-group">
            <label>
                Tên sản phẩm <span class="small text-danger">({{this.label}})</span>
            </label>
            <el-input placeholder="" v-model="title">
                <template slot="prepend"><img :src="'/admin/img/lang/'+this.image" :title="this.label"></template>
            </el-input>
        </div>
        <div class="form-group">
            <label>
                Slug <span class="small text-danger">({{this.label}})</span>
            </label>
            <el-input placeholder="" v-model="slug">
                <template slot="prepend"><img :src="'/admin/img/lang/'+this.image" :title="this.label"></template>
            </el-input>
        </div>
        <hr>
        <div class="form-group">
            <label>
                Thông tin chi tiết sản phẩm <span class="small text-danger">({{this.label}}) <img :src="'/admin/img/lang/'+this.image" :title="this.label"></span>
            </label>
            <tinyMCEProductDescription></tinyMCEProductDescription>
        </div>
        <hr>
        <div class="form-group">
            <label>
                Thông số kỹ thuật <span class="small text-danger">({{this.label}}) <img :src="'/admin/img/lang/'+this.image" :title="this.label"></span>
            </label>
            <tinyMCETechnology></tinyMCETechnology>
        </div>
        <div class="form-group">
            <el-form-item label="Meta Tag Title" label-width="160px">
                <el-input placeholder="" v-model="meta_title">
                    <span class="small text-danger">({{this.label}})</span>
                    <template slot="prepend"><img :src="'/admin/img/lang/'+this.image" :title="this.label"></template>
                </el-input>
            </el-form-item>
        </div>
        <div class="form-group">
            <el-form-item label="Meta Tag Description" label-width="160px">
                <el-input placeholder="" v-model="meta_description">
                    <span class="small text-danger">({{this.label}})</span>
                    <template slot="prepend"><img :src="'/admin/img/lang/'+this.image" :title="this.label"></template>
                </el-input>
            </el-form-item>
        </div>
        <div class="form-group">
            <el-form-item label="Meta Tag Keywords" label-width="160px">
                <el-input placeholder="" v-model="meta_keyword">
                    <span class="small text-danger">({{this.label}})</span>
                    <template slot="prepend"><img :src="'/admin/img/lang/'+this.image" :title="this.label"></template>
                </el-input>
            </el-form-item>
        </div>
    </el-form>
</template>
<script>
    import api from '../../helpers/api';
    // import Editor from '@tinymce/tinymce-vue';
    import tinyMCEShortDescription from './tinyMCEShortDescription.vue';
    // import productParameters from './productParameters.vue';
    import tinyMCETechnology from './tinyMCETechnology.vue';
    import tinyMCEDocument from './tinyMCEDocument.vue';
    import tinyMCEProductDescription from './tinyMCEProductDescription.vue';

    export default {
        name: 'ProductGeneral',
        props: ['lang', 'label', 'image'],
        data: function () {
            return {
                langData: this.lang,
                productId: Number(window.product_id),
            };
        },
        components: {
            // Editor,
            // productParameters,
            // tinyMCEShortDescription,
            tinyMCETechnology,
            tinyMCEDocument,
            tinyMCEProductDescription,
        },
        mounted() {
            this.productByID();
        },
        computed: {
            title: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.a.content[this.langData] !== 'undefined') {
                        return this.$store.state.a.content[this.langData].name;
                    }
                },
                set(value) {
                    this.$store.dispatch('a/updateTitle', value);
                },
            },
            slug: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.a.content[this.langData] !== 'undefined') {
                        return this.$store.state.a.content[this.langData].slug;
                    }
                },
                set(value) {
                    this.$store.dispatch('a/updateSlug', value);
                },
            },
            short_description: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.a.content[this.langData] !== 'undefined') {
                        return this.$store.state.a.content[this.langData].short_description;
                    }
                },
                set(value) {
                    this.$store.dispatch('a/updateShort_description', value);
                },
            },
            document: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.a.content[this.langData] !== 'undefined') {
                        return this.$store.state.a.content[this.langData].document;
                    }
                },
                set(value) {
                    this.$store.dispatch('a/updateDocument', value);
                },
            },
            technology: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.a.content[this.langData] !== 'undefined') {
                        return this.$store.state.a.content[this.langData].technology;
                    }
                },
                set(value) {
                    this.$store.dispatch('a/updateTechnology', value);
                },
            },

            description: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.a.content[this.langData] !== 'undefined') {
                        return this.$store.state.a.content[this.langData].description;
                    }
                },
                set(value) {
                    this.$store.dispatch('a/updateDescription', value);
                },
            },
            product_description: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.a.content[this.langData] !== 'undefined') {
                        return this.$store.state.a.content[this.langData].product_description;
                    }
                },
                set(value) {
                    this.$store.dispatch('a/updateProduct_description', value);
                },
            },
            meta_title: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.a.content[this.langData] !== 'undefined') {
                        return this.$store.state.a.content[this.langData].meta_title;
                    }
                },
                set(value) {
                    this.$store.dispatch('a/updateMeta_title', value);
                },
            },
            meta_description: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.a.content[this.langData] !== 'undefined') {
                        return this.$store.state.a.content[this.langData].meta_description;
                    }
                },
                set(value) {
                    this.$store.dispatch('a/updateMeta_description', value);
                },
            },
            meta_keyword: {
                // eslint-disable-next-line vue/return-in-computed-property
                get() {
                    if (typeof this.$store.state.a.content[this.langData] !== 'undefined') {
                        return this.$store.state.a.content[this.langData].meta_keyword;
                    }
                },
                set(value) {
                    this.$store.dispatch('a/updateMeta_keyword', value);
                },
            },
        },
        methods: {
            // onSubmit() {
            //   console.log('submit!');
            // }
            getAndSetData(content) {
                this.$store.dispatch('a/contentGeneral', content);
            },
            async productByID() {
                if (!isNaN(this.productId)) {
                    const url = `admin/ajax/products/${this.productId}-${this.langData}/controller`;
                    const products = await api.request('GET', url);
                    if (!products.data.error) {
                        this.getAndSetData(products.data.data);
                    }
                }
            },

        },
    };
</script>
