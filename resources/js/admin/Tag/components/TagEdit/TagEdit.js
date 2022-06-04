// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../../helpers/api';
import general from './TabGeneral/general.vue';
import dataTag from './TabGeneral/dataTag.vue';
import tagFilter from './TabGeneral/tagFilter.vue';
import associate from './TabGeneral/associate.vue';
import imageAvatar from './TabGeneral/image.vue';
export default {
    name: 'TagEdit',
    components: { dataTag, imageAvatar, general, tagFilter, associate },
    data() {
        return {
            editId: Number(window.tag_id),
            activeTab: 'tag_data',
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
        breadcrumbSetUp(cate = 'tags', typeBr = 'Edit') {
            if (typeof this.$route.query.id == 'undefined') {
                typeBr = 'Thêm mới';
            }

            const herf = window.location.origin;
            const div = document.createElement('a');
            div.innerHTML = `
          <a href="${herf}/${cate}">Danh Sách Tag</a>
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
        async saveTag() {
            const url = `admin/ajax/tags/controller/${this.$route.query.id}/tagSave`;
            const data = this.$store.state.b.content;
            data.all_desc = this.$store.state.c.content;
            data.tag_filter = this.$store.state.d.filterContent;
            data.tag_category = this.$store.state.f.cateContent;
            const result = await api.request('POST', url, { data });
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
                this.$store.dispatch('c/updateLangData', langData.data.data);
            }
        },

        async getData() {
            await this.getAllLangData();
            if (typeof this.$route.query.id !== 'undefined') {
                const url = `admin/ajax/tags/controller/tagByID/${this.$route.query.id}`;
                const result = await api.request('GET', url);
                await this.$store.dispatch('b/content', result.data.data);
                // check data rỗng hay ko
                if (result.data.error) {
                  this.openError(result.data.msg);
                  this.$router.push({ name: 'Home' });
                }
                if (result.data.data.all_desc == 0) {
                    var desData = [];
                    Array.from(this.$store.state.c.langData).forEach((child) => {
                        desData[child.language_id] = {
                            language_id: child.language_id,
                            name: '',
                            short_description: '',
                            meta_title: '',
                            meta_description: '',
                            meta_keyword: '',
                        };
                    });
                    await this.$store.dispatch('c/content', desData);
                } else {
                    await this.$store.dispatch('c/content', result.data.data.all_desc);
                }
            } else {
                var desData = [];
                Array.from(this.$store.state.c.langData).forEach((child) => {
                    desData[child.language_id] = {
                        language_id: child.language_id,
                        name: '',
                        short_description: '',
                        meta_title: '',
                        meta_description: '',
                        meta_keyword: '',
                    };
                });
                await this.$store.dispatch('c/content', desData);
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
