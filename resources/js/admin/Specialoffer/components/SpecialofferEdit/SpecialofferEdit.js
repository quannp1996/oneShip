// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../../helpers/api';
import general from './Specialoffer/general.vue';
import dataSpecialoffer from './Specialoffer/dataSpecialoffer.vue';
import pickProduct from './Specialoffer/pickProduct.vue';
import imageAvatar from './Specialoffer/image.vue';
export default {
    name: 'SpecialofferEdit',
    components: { dataSpecialoffer, imageAvatar, general, pickProduct },
    data() {
        return {
            activeTab: 'specialoffer_general',
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
        breadcrumbSetUp(cate = 'specialoffer', typeBr = 'Edit') {
            if (typeof this.$route.query.id == 'undefined') {
                typeBr = 'Thêm mới';
            }

            const herf = window.location.origin;
            const div = document.createElement('a');
            div.innerHTML = `
          <a href="${herf}/${cate}">Danh Sách Special Offer</a>
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
        async saveSpecialoffer() {
            const url = `admin/ajax/specialoffer/controller/${this.$route.query.id}/saveSpecialoffer`;
            const data = this.$store.state.b.content;
            data.all_desc = this.$store.state.c.content;
            const collectionPickProduct = this.$store.state.b.collection;
            const result = await api.request('POST', url, { data, collectionPickProduct });
            const herfVIP = window.location.origin;
            const typeVIP = 'specialoffer';
            if (!result.data.error) {
                this.openSuccess(result.data.msg);
                if (typeof this.$route.query.id === 'undefined') {
                    window.onbeforeunload = function() {
                        return null;
                    };
                    window.location.href = `${herfVIP}/${typeVIP}`;
                }
            } else {
                this.openError(result.data.msg);
            }
            // this.$store.dispatch('b/content', result.data.data);
        },

        async getData() {
            await this.getAllLangData();
            if (typeof this.$route.query.id !== 'undefined') {
                const url = `admin/ajax/specialoffer/controller/specialofferByID/${this.$route.query.id}`;
                const result = await api.request('GET', url);
                await this.$store.dispatch('b/content', result.data.data);
                // check data rỗng hay ko
                if (result.data.data.all_desc == 0) {
                    const desData = [];
                    Array.from(this.$store.state.c.langData).forEach((child) => {
                        desData[child.language_id] = {
                            language_id: child.language_id,
                            name: '',
                            link: '',
                            short_description: '',
                            description: '',
                            meta_title: '',
                            meta_description: '',
                            meta_keyword: '',
                        };
                    });
                    await this.$store.dispatch('c/content', desData);
                } else {
                    const desData = {};
                    Array.from(result.data.data.all_desc).forEach((child) => {
                        desData[child.language_id] = {
                            id: child.id,
                            language_id: child.language_id,
                            name: child.name,
                            short_description: child.short_description,
                            description: child.description,
                            meta_title: child.meta_title,
                            meta_description: child.meta_description,
                            meta_keyword: child.meta_keyword,
                            link: child.link,
                            special_offer_id: child.special_offer_id,
                        };
                    });
                    await this.$store.dispatch('c/content', desData);
                }
            } else {
                const desData = [];
                Array.from(this.$store.state.c.langData).forEach((child) => {
                    desData[child.language_id] = {
                        language_id: child.language_id,
                        name: '',
                        link: '',
                        short_description: '',
                        description: '',
                        meta_title: '',
                        meta_description: '',
                        meta_keyword: '',
                    };
                });
                await this.$store.dispatch('c/content', desData);
            }
            this.loading = false;
        },
        async getAllLangData() {
            const url = 'admin/ajax/products/controller/lang';
            const langData = await api.request('GET', url);
            if (langData) {
                // this.lang = langData.data.data;
                this.$store.dispatch('c/updateLangData', langData.data.data);
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
