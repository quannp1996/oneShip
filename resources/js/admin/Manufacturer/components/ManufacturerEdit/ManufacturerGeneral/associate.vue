<template>
  <div>
    <el-transfer
      v-loading="loading"
      filterable
      :titles="['Danh mục có', 'Danh mục đã chọn']"
      v-model="cate"
      :data="data"
    >
       <span slot-scope="{ option }" data-toggle="collapse" :href="'#collapse'+option.key" aria-expanded="false" :aria-controls="'collapse'+option.key">{{ option.key }}:{{ option.label }}
         <div>
            <div class="small text-danger" v-html="option.description"></div>
            <el-radio v-model="primaryCategoryId" :label="option.key"><span class="text-success small">Click vào đây nếu là Danh mục chính</span></el-radio>
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
@import "../../../css/style.css";
</style>
<script>
import api from '../../../helpers/api';

export default {
  name: 'associate',
  data: function() {
    return {
      manufacturerId: this.$route.query.id,
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
    cate: {
      get() {
        return this.$store.state.d.cateContent;
      },
      set(value) {
        this.$store.dispatch('d/cateGetData', value);
      },
    },
    primaryCategoryId: {
      get() {
        return this.$store.state.b.content.primary_category_id;
      },
      set(value) {
        this.$store.dispatch('b/setPrimaryCategoryId', value);
      },
    },
  },
  methods: {
    deleteCate(key) {
      this.$store.dispatch('d/cateDelete', key);
    },
    addCate(item) {
      const cateData = [];
      cateData.push({
        value: item.value,
        id: item.id,
      });
      this.$store.dispatch('d/cateSet', cateData);
    },
    // async querySearchAsync(queryString, cb) {
    //   const url = 'admin/ajax/category/controller/getCategories';
    //   const cate = await api.request('POST', url, { queryString });
    //   const cateData=[];
    //   Array.from(cate.data.data).forEach((child) => {
    //       cateData.push({
    //       value: child.text,
    //       id: child.id,
    //     });
    //   });
    //   this.links = cateData;
    //   // var results = queryString ? links.filter(this.createFilter(queryString)) : links;
    //   clearTimeout(this.timeout);
    //   cb(cateData);
    // },
    async querySearchAsync(queryString, cb) {
      const url = 'admin/ajax/category/controller/getCategories';
      const cate = await api.request('POST', url, { queryString });
      const cateData = [];
      Array.from(cate.data.data).forEach((child) => {
        cateData.push({
          label: child.text,
          key: child.id,
          description: child.description,
          // initial: child.id,
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
      this.$store.dispatch('d/cateGetData', content);
    },
    async cateDataByID() {
      const url = `admin/ajax/manufacturer/${this.manufacturerId}/controller/cateData`;
      const manufacturer = await api.request('GET', url);
      if (manufacturer) {
        this.getAndSetData(manufacturer.data.data);
      }
    },
  },
};
</script>
