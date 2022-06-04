import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/reset.css';
import 'element-ui/lib/theme-chalk/index.css';
import { store } from './store.js';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import SpecialofferList from './components/SpecialofferList.vue';
import SpecialofferApp from './components/SpecialofferApp.vue';
import SpecialofferEdit from './components/SpecialofferEdit/SpecialofferEdit.vue';
import locale from 'element-ui/lib/locale/lang/en';
Vue.use(ElementUI, { locale });
Vue.use(VueRouter);
const routes = [
  { path: '/specialoffer',
    component: SpecialofferList,
    name: 'Home',
    props: true },
  { path: '/specialoffer/edit',
    component: SpecialofferEdit,
    name: 'Edit',
    props: true,
  },
  { path: '/specialoffer/add',
    component: SpecialofferEdit,
    name: 'Add',
    props: true,
  },
];
const router = new VueRouter({ mode: 'history',
routes: routes });
export const eventBus = new Vue(); // added line

new Vue({
  el: '#specialofferApp',
  store,
  computed: {
    ...Vuex.mapState({
      a: (state) => state.a,
      b: (state) => state.b,
      // c: (state) => state.c,
    }),
  },
  router: router,
  components: { SpecialofferApp },
  render: (h) => h(SpecialofferApp),
}).$mount('#specialofferApp');