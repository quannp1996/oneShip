// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../../helpers/api';
import general from './CollectionGeneral/general.vue';
import collectionImage from './CollectionGeneral/CollectionImage.vue';
import dataCollection from './CollectionGeneral/dataCollection.vue';
import detailCollection from './CollectionDetail/CollectionDetail.vue';
import tagCollection from './CollectionTag/CollectionTag.vue';
// import imageAvatar from './CollectionGeneral/image.vue';
export default {
    name: 'CollectionEdit',
    components: { general, collectionImage, dataCollection, detailCollection, tagCollection },
    data() {
        // editId:  Number(window.tag_id),
        return {
            editId: Number(this.$route.query.id),
            activeTab: 'collection_data',
            loading: true,
        };
    },
    computed: {
        // result () {
        //   return this.$store.state.result
        // }
    },
    mounted() {
        this.getData();
        this.breadcrumbSetUp();
    },

    methods: {
        async saveCollection() {
          ;
            const url = 'admin/ajax/collection/controller/collectionSave';
            const collection = this.$store.state.b.collection;
            const content = this.$store.state.b.content;
            const fileList = this.$store.state.c.fileList;
            const collectionTags = this.$store.state.b.tagsContent;
            // eslint-disable-next-line camelcase
            const object_id = this.$route.query.id;
            const general = this.$store.state.b.general;
            const result = await api.request('POST', url,
             { collection, content, fileList, collectionTags, object_id, general 
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
        
           
            if (!result.data.error) {
                this.openSuccess(result.data.msg);
                if (typeof this.$route.query.id === 'undefined') {
                    this.$router.push({ name: 'Home' });
                }
            } else {
               
                this.openError(result.data.msg);
            }
            // this.$store.dispatch('b/content', result.data.data);
        },

        async getAllLangData() {
            const url = 'admin/ajax/products/controller/lang';
            const langData = await api.request('GET', url);
            if (langData) {
                this.lang = langData.data.data;
                this.$store.dispatch('b/updateLangData', langData.data.data);
            }
        },

        async getData() {
            await this.getAllLangData();
            if (typeof this.$route.query.id !== 'undefined') {
                const url = `admin/ajax/collection/controller/collectionByID/${this.$route.query.id}`;
                const result = await api.request('GET', url);
                await this.$store.dispatch('b/content', result.data.data);
                // check data rỗng hay ko
                await this.$store.dispatch('b/general', result.data.data);
                if (result.data.error || result.data.data.length === 0) {
                  this.openError(result.data.msg);
                  this.$router.push({ name: 'Home' });
                }
                if (result.data.data.all_desc == null) {
                    const desData = [];
                    Array.from(this.$store.state.b.langData).forEach((child) => {
                        desData[child.language_id] = {
                            language_id: child.language_id,
                            name: '',
                            short_description: '',
                            description: '',
                            meta_title: '',
                            meta_description: '',
                            meta_keyword: '',
                        };
                    });
                    await this.$store.dispatch('b/content', desData);
                } else {
                    await this.$store.dispatch('b/content', result.data.data.all_desc);
                }
            } else {
                const desData = [];
                Array.from(this.$store.state.b.langData).forEach((child) => {
                    desData[child.language_id] = {
                        language_id: child.language_id,
                        name: '',
                        short_description: '',
                        description: '',
                        meta_title: '',
                        meta_description: '',
                        meta_keyword: '',
                    };
                });
                await this.$store.dispatch('b/content', desData);
            }
            this.loading = false;
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
        breadcrumbSetUp(cate = 'collection', typeBr = 'Edit') {
            if (typeof this.$route.query.id == 'undefined') {
                typeBr = 'Thêm mới';
            }

            const herf = window.location.origin;
            const div = document.createElement('a');
            div.innerHTML = `
                <a href="${herf}/${cate}">Bộ sưu tập</a>
            `;
            const element = document.getElementsByClassName('breadcrumb-item');
            if (typeof element !== 'undefined') {
                element[1].classList.remove('active');
                element[1].innerHTML = '';
                element[1].appendChild(div);
                // create breadcrumb 2
                const divEdit = document.createElement('li');
                divEdit.classList.add('breadcrumb-item');
                divEdit.classList.add('active');
                divEdit.classList.add('breadcrumbAdd');
                const elementParent = document.getElementsByClassName('breadcrumb border-0 m-0');
                elementParent[0].appendChild(divEdit);
                const div2 = document.createElement('a');
                div2.innerHTML = `
                        ${typeBr}
                    `;
                const elementEdit = document.getElementsByClassName('breadcrumb-item active');
                if (typeof element !== 'undefined') {
                    elementEdit[0].appendChild(div2);
                }
            }
        },
    },
}; // End class
