// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../helpers/api';
import SearchBar from './SearchBar/SearchBar.vue'
import WarehouseTable from './WarehouseTable.vue'


export default {
  name: 'WarehouseList',
  components: { SearchBar,WarehouseTable },
  data() {
    return {
    }
  },
  computed: {
    // result () {
    //   return this.$store.state.result
    // }
  },
  mounted() {

  },

  methods: {
  }
} // End class
