import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/reset.css';
import 'element-ui/lib/theme-chalk/index.css';
import { store } from './store.js';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import PromotionCampaignList from './components/PromotionCampaignList.vue';
import PromotionCampaignApp from './components/PromotionCampaignApp.vue';
import PromotionCampaignEdit from './components/PromotionCampaignEdit/PromotionCampaignEdit.vue';
import locale from 'element-ui/lib/locale/lang/en';
Vue.use(ElementUI, { locale });
Vue.use(VueRouter);
const routes = [
  { path: '/promotionCampaign',
    component: PromotionCampaignList,
    name: 'Home',
    props: true },
  { path: '/promotionCampaign/edit',
    component: PromotionCampaignEdit,
    name: 'Edit',
    props: true,
  },
  { path: '/promotionCampaign/add',
    component: PromotionCampaignEdit,
    name: 'Add',
    props: true,
  },
];
const router = new VueRouter({ mode: 'history',
routes: routes });
export const eventBus = new Vue(); // added line

new Vue({
  el: '#promotionCampaignApp',
  store,
  computed: {
  },
  router: router,
  components: { PromotionCampaignApp },
  render: (h) => h(PromotionCampaignApp),
}).$mount('#promotionCampaignApp');
