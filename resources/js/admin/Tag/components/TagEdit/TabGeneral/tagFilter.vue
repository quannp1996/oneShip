<template>
  <div>
    <el-transfer
      filterable
      v-loading="loading"
      :titles="['Danh mục có', 'Danh mục đã chọn']"
      v-model="filter"
      :data="data"
    >
       <span slot-scope="{ option }" data-toggle="collapse" :href="'#collapse'+option.key" aria-expanded="false" :aria-controls="'collapse'+option.key">{{ option.key }}:{{ option.label }}
         <!-- <div class="collapse" :id="'collapse'+option.key"> -->
              <div class="small text-danger" v-html="option.description"></div>
         <!-- </div> -->
        </span>
    </el-transfer>
  </div>
</template>
<style>
@import "../../../css/style.css";
</style>
<script>

import api from '../../../helpers/api';

export default {
    data() {
        return {
            data: [],
            loading: true,
        };
    },
    computed: {
        filter: {
            get() {
                return this.$store.state.d.filterContent;
            },
            set(value) {
                this.$store.dispatch('d/filterGetData', value);
            },
        },
    },
    mounted() {
        this.getListFilter();
    },
    methods: {
        async getListFilter() {
            const url = 'admin/ajax/filters/getListFilter';
            const filter = await api.request('GET', url);
            const filterData = [];
            Object.keys(filter.data.data).forEach(function(key) {
                filterData.push({
                    label: filter.data.data[key].text,
                    key: filter.data.data[key].id,
                    description: filter.data.data[key].short_description,
                });
            });
            this.data = filterData;
            await this.filterDataByID().then(() => {
                    this.loading = false;
            });
        },
        getAndSetData(content) {
            this.$store.dispatch('d/filterGetData', content);
        },
        async filterDataByID() {
            const url = `admin/ajax/tags/${this.$route.query.id}/controller/filterData`;
            const filters = await api.request('GET', url);
            if (filters) {
                this.getAndSetData(filters.data.data);
            }
        },
    },
};
</script>
