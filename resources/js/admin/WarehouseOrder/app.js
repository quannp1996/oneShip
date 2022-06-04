import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/reset.css';
import 'element-ui/lib/theme-chalk/index.css';
import { store } from './store.js';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import WareHouseList from './components/WarehouseList.vue';
import WarehouseApp from './components/WarehouseApp.vue';
import locale from 'element-ui/lib/locale/lang/en';
Vue.use(ElementUI, { locale });
Vue.use(VueRouter);
const routes = [
  { path: '/warehouse/order',
    component: WareHouseList,
    name: 'Home',
    props: true },
];
const router = new VueRouter({ mode: 'history',
routes: routes });
export const eventBus = new Vue(); // added line

new Vue({
  el: '#WarehouseApp',
  store,
  computed: {
    ...Vuex.mapState({
      a: (state) => state.a,
      b: (state) => state.b,
      // c: state => state.c,
    }),
  },
  router: router,
  components: { WarehouseApp },
  render: (h) => h(WarehouseApp),
}).$mount('#WarehouseApp');