// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../helpers/api';
import SearchBar from './SearchBar/SearchBar.vue';
import TagTable from './TagTable.vue';


export default {
  name: 'TagList',
  components: { SearchBar, TagTable },
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
