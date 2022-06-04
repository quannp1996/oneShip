// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../helpers/api';
import SearchBar from './SearchBar/SearchBar.vue';
import ManufacturerTable from './ManufacturerTable.vue';


export default {
  name: 'ManufacturerList',
  components: { SearchBar, ManufacturerTable },
  data() {
    return {
    };
  },
  computed: {
    // result () {
    //   return this.$store.state.result
    // }
  },
  mounted() {

  },

  methods: {
  },
}; // End class