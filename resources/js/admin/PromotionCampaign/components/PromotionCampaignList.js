// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../helpers/api';
import SearchBar from './SearchBar/SearchBar.vue';
import PromotionCampaignTable from './PromotionCampaignTable.vue';


export default {
  name: 'PromotionCampaignList',
  components: { SearchBar, PromotionCampaignTable },
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
