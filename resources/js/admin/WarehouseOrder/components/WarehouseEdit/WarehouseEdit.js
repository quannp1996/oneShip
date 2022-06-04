
// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../../helpers/api';
import general from './TabGeneral/general.vue';
import dataTag from './TabGeneral/dataTag.vue';
import imageAvatar from './TabGeneral/image.vue';
export default {
  name: 'TagEdit',
  components: { dataTag, imageAvatar, general },
  data() {
    return {
       editId: Number(window.tag_id),
       activeTab: 'tag_general',
    };
  },
  computed: {
    // result () {
    //   return this.$store.state.result
    // }
  },
  mounted() {
    this.getData();
  },

  methods: {
    async saveTag() {
      const url = `admin/ajax/tags/controller/${this.$route.query.id}/tagSave`;
      const data = this.$store.state.b.content;
      data.all_desc = this.$store.state.c.content;
      const result = await api.request('POST', url, { data });
      if (!result.data.error) {
        this.openSuccess(result.data.msg);
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
        if (result.data.data.all_desc == 0) {
            var desData=[];
            Array.from(this.$store.state.c.langData).forEach((child) => {
                    desData[child.language_id] = {
                    language_id: child.language_id,
                    name: '',
                    short_description: '',
                  };
           });
           await this.$store.dispatch('c/content', desData);
        } else {
            await this.$store.dispatch('c/content', result.data.data.all_desc);
        }
      } else {
console.log('test');
        var desData=[];
        Array.from(this.$store.state.c.langData).forEach((child) => {
                desData[child.language_id] = {
                language_id: child.language_id,
                name: '',
                short_description: '',
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
