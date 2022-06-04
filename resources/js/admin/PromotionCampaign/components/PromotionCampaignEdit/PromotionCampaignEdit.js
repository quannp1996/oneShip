// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../../helpers/api';
import general from './PromotionCampaign/general.vue';
import dataPromotionCampaign from './PromotionCampaign/dataPromotionCampaign.vue';
import pickProduct from './PromotionCampaign/pickProduct.vue';
import imageAvatar from './PromotionCampaign/image.vue';
import associate from './PromotionCampaign/associate.vue';
import checkIssetPrd from './PromotionCampaign/Popup/checkIssetPrd.vue';
import { eventBus } from '../../app.js';

export default {
    name: 'PromotionCampaignEdit',
    components: { dataPromotionCampaign, imageAvatar, general, pickProduct, associate, checkIssetPrd },
    data() {
        return {
            activeTab: 'promotionCampaign_general',
            loading: true,
        };
    },
    computed: {
        // result () {
        //   return this.$store.state.result
        // }
    },
    created() {
      eventBus.$on('fireMethod2', () => {
        this.saveData();
      });
    },
    mounted() {
        this.getData();
        this.breadcrumbSetUp();
        this.getTimeline();
    },

    methods: {
        breadcrumbSetUp(cate = 'promotionCampaign', typeBr = 'Edit') {
            if (typeof this.$route.query.id == 'undefined') {
                typeBr = 'Thêm mới';
            }

            const herf = window.location.origin;
            const div = document.createElement('a');
            div.innerHTML = `
          <a href="${herf}/${cate}">Danh Sách chương trình khuyến mãi</a>
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
        async savePromotionCampaign() {
            const dataDuplicate = await this.checkPrdDialog();
            if (typeof dataDuplicate !== 'undefined' && Object.keys(dataDuplicate).length > 0) {
              await this.$store.dispatch('b/setCheckPrdDialogVisible', true);
              await this.$store.dispatch('b/checkDuplicatePrdCollection', dataDuplicate);
            } else {
              console.log('oke oke');
              await this.saveData();
            }
        },
        async saveData() {
          const url = `admin/ajax/promotionCampaign/controller/${this.$route.query.id}/savePromotionCampaign`;
          const data = this.$store.state.b.content;
          const fileListImg = this.$store.state.b.fileList;
          data.all_desc = this.$store.state.c.content;
          const collectionPickProduct = this.$store.state.b.collection;
          const timeline = this.$store.state.b.timeline;
          const campaignCategory = this.$store.state.d.cateContent;
          const result = await api.request('POST', url, { data, collectionPickProduct, fileListImg, campaignCategory, timeline });
          const herfVIP = window.location.origin;
          const typeVIP = 'promotionCampaign';
          if (!result.data.error) {
              this.openSuccess(result.data.msg);
              if (this.$route.name == 'Add') {
                  window.onbeforeunload = function() {
                      return null;
                  };
                  window.location.href = `${herfVIP}/${typeVIP}`;
              }
          } else {
              this.openError(result.data.msg);
          }
        },
        async checkPrdDialog() {
          const pickPrd = this.$store.state.b.collection;
          const url = `admin/ajax/promotionCampaign/controller/${this.$route.query.id}/promotionCampaignCheckIssetPrd`;
          const result = await api.request('POST', url, { pickPrd });
          return result.data.data;
        },
        async getTimeline() {
            if (typeof this.$route.query.id !== 'undefined') {
                const url = `admin/ajax/promotionCampaign/controller/${this.$route.query.id}/promotionCampaignTimelineByID`;
                const result = await api.request('GET', url);
                if (!result.data.error) {
                  this.$store.dispatch('b/updateTimeline', result.data.data);
                }
            }
        },
        async getData() {
            await this.getAllLangData();
            if (typeof this.$route.query.id !== 'undefined') {
                const url = `admin/ajax/promotionCampaign/controller/promotionCampaignByID/${this.$route.query.id}`;
                const result = await api.request('GET', url);
                await this.$store.dispatch('b/content', result.data.data);
                if (result.data.error || result.data.data.length === 0) {
                  this.openError(result.data.msg);
                  this.$router.push({ name: 'Home' });
                }
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
