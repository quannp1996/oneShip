// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../helpers/api';
import SearchBar from './SearchBar/SearchBar.vue';
import SpecialofferTable from './SpecialofferTable.vue';


export default {
  name: 'SpecialofferList',
  components: { SearchBar, SpecialofferTable },
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