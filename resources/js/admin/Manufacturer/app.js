import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/reset.css';
import 'element-ui/lib/theme-chalk/index.css';
import { store } from './store.js';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import locale from 'element-ui/lib/locale/lang/en';
Vue.use(VueRouter);
Vue.use(ElementUI, { locale });
import ManufacturerList from './components/ManufacturerList.vue';
import ManufacturerApp from './components/ManufacturerApp.vue';
import ManufacturerEdit from './components/ManufacturerEdit/ManufacturerEdit.vue';
const routes = [
  { path: '/manufacturer',
    component: ManufacturerList,
    name: 'Home',
    props: true },
  { path: '/manufacturer/edit',
    component: ManufacturerEdit,
    name: 'Edit',
    props: true,
  },
  { path: '/manufacturer/add',
    component: ManufacturerEdit,
    name: 'Add',
    props: true,
  },
];
const router = new VueRouter({ mode: 'history',
routes: routes });
export const eventBus = new Vue(); // added line

new Vue({
  el: '#manufacturerApp',
  store,
  computed: {
    ...Vuex.mapState({
      a: (state) => state.a,
      b: (state) => state.b,
      // c: (state) => state.c,
    }),
  },
  router: router,
  components: { ManufacturerApp },
  render: (h) => h(ManufacturerApp),
}).$mount('#manufacturerApp');