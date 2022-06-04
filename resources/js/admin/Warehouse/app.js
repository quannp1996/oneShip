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
Vue.use(VueRouter);
Vue.use(ElementUI, { locale });
// import TagEdit from './components/TagEdit/TagEdit.vue'
const routes = [
  { path: '/warehouse',
    component: WareHouseList,
    name: 'Home',
    props: true },
  // { path: '/tags/edit',
  //   component:TagEdit,
  //   name: "Edit",
  //   props: true
  // },
  // { path: '/tags/add',
  //   component:TagEdit,
  //   name: "Add",
  //   props: true
  // },
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
      // b: state => state.b,
      // c: state => state.c,
    }),
  },
  router: router,
  components: { WarehouseApp },
  render: (h) => h(WarehouseApp),
}).$mount('#WarehouseApp');