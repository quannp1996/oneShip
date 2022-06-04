import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/reset.css';
import 'element-ui/lib/theme-chalk/index.css';
import {store} from './store.js';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import locale from 'element-ui/lib/locale/lang/en';

Vue.use(VueRouter);
Vue.use(ElementUI, {locale});
// import TagList from './components/TagList.vue'
import CollectionApp from './components/CollectionApp.vue';
import CollectionEdit from './components/CollectionEdit/CollectionEdit.vue';
import CollectionList from './components/CollectionList.vue';

const routes = [
    {
        path: '/collection',
        component: CollectionList,
        name: 'Home',
        props: true,
    },
    {
        path: '/collection/add',
        component: CollectionEdit,
        name: 'Add',
        props: true,
    },

    {
        path: '/collection/edit',
        component: CollectionEdit,
        name: 'Edit',
        props: true,
    },
];
const router = new VueRouter({
    mode: 'history',
    routes: routes
});
export const eventBus = new Vue(); // added line

new Vue({
    el: '#collectionApp',
    store,
    computed: {
        ...Vuex.mapState({
            a: (state) => state.a,
            b: (state) => state.b,
            c: (state) => state.c,
        }),
    },
    router: router,
    components: {CollectionApp},
    render: (h) => h(CollectionApp),
}).$mount('#collectionApp');