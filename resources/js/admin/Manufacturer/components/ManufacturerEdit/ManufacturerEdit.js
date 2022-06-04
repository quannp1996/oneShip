// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../../helpers/api';
import general from './ManufacturerGeneral/general.vue';
import associate from './ManufacturerGeneral/associate.vue';
import dataManufacturer from './ManufacturerGeneral/dataManufacturer.vue';
import imageAvatar from './ManufacturerGeneral/image.vue';
export default {
    name: 'ManufacturerEdit',
    components: { dataManufacturer, imageAvatar, general, associate },
    data() {
        return {
            activeTab: 'manufacturer_general',
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
        breadcrumbSetUp(cate = 'manufacturer', typeBr = 'Edit') {
            if (typeof this.$route.query.id == 'undefined') {
                typeBr = 'Thêm mới';
            }

            const herf = window.location.origin;
            const div = document.createElement('a');
            div.innerHTML = `
          <a href="${herf}/${cate}">Danh Sách Thương hiệu</a>
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
        async saveManufacturer() {
            const url = `admin/ajax/manufacturer/controller/${this.$route.query.id}/manufacturerSave`;
            const data = this.$store.state.b.content;
            const manufacturerCategory = this.$store.state.d.cateContent;
            const result = await api.request('POST', url, { data, manufacturerCategory });
            const herfVIP = window.location.origin;
            const typeVIP = 'manufacturer';
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
            // await this.getAllLangData();
            if (typeof this.$route.query.id !== 'undefined') {
                const url = `admin/ajax/manufacturer/controller/manufacturerByID/${this.$route.query.id}`;
                const result = await api.request('GET', url);
                if ( result.data.data == null || result.data.error || result.data.data.length === 0) {
                  this.openError('Không tồn tại dữ liệu');
                  this.$router.push({ name: 'Home' });
                }
                await this.$store.dispatch('b/content', result.data.data);
                // check data rỗng hay ko
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
