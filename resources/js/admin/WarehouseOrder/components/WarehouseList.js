// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../helpers/api';
import SearchBar from './SearchBar/SearchBar.vue';
import WarehouseTable from './WarehouseTable.vue';

import { eventBus } from '../app.js';
export default {
  name: 'WarehouseList',
  components: { SearchBar, WarehouseTable },
  data() {
    return {
      activeTab: this.$store.state.a.tabName,
    };
  },
  computed: {
    // result () {
    //   return this.$store.state.result
    // }
  },
  mounted() {
    this.dataTable(this.$route.query.page ?? 1);
  },
  created() {
    eventBus.$on('fireMethod', () => {
            this.dataTable();
      });
  },
  methods: {
    handleClick(tab, event) {
      this.$store.dispatch('a/tabName', tab.name);
      this.dataTable(this.$route.query.page ?? 1);
    },
    async dataTable(page = 1) {
      const tab = this.$store.state.a.tabName;
      const search = this.$store.state.a.search;
      const type = this.$store.state.a.tabType;
      const url = `ajax/warehouse/controller/warehouseList?page=${page}&&tap=${tab}&&idWarehouse=${search.idWarehouse}&&idWarehouseOrder=${search.idWarehouseOrder}&&type=${type}`;
      // let fillters = this.$store.state.a.searchFilter;
      // let result = await api.request('POST',url,{fillters});
      const result = await api.request('POST', url);
      this.$store.dispatch('a/content', result.data.data);
      // this.$router.push({path: this.$route.path, query: { ...this.$route.query, page: this.laravelData.current_page }}).catch(()=>{})
      // this.setParamUrl();
  },
  },
}; // End class
