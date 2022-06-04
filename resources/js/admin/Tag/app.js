import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/reset.css';
import 'element-ui/lib/theme-chalk/index.css';
import { store } from './store.js';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import locale from 'element-ui/lib/locale/lang/en';
import TagList from './components/TagList.vue';
import TagApp from './components/TagApp.vue';
import TagEdit from './components/TagEdit/TagEdit.vue';
Vue.use(VueRouter);
Vue.use(ElementUI, { locale });
const routes = [
  { path: '/tags',
    component: TagList,
    name: 'Home',
    props: true },
  { path: '/tags/edit',
    component: TagEdit,
    name: 'Edit',
    props: true,
  },
  { path: '/tags/add',
    component: TagEdit,
    name: 'Add',
    props: true,
  },
];
const router = new VueRouter({ mode: 'history',
routes: routes });
export const eventBus = new Vue(); // added line

new Vue({
  el: '#tagApp',
  store,
  computed: {
    ...Vuex.mapState({
      a: (state) => state.a,
      b: (state) => state.b,
      c: (state) => state.c,
    }),
  },
  router: router,
  components: { TagApp },
  render: (h) => h(TagApp),
}).$mount('#tagApp');
