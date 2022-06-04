import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/reset.css';
import 'element-ui/lib/theme-chalk/index.css';
import Bus from './bus';
import { store } from './store.js';
import Vuex from 'vuex';
import locale from 'element-ui/lib/locale/lang/en';
Vue.use(ElementUI, { locale });
Vue.use(Bus);
export const eventBus = new Vue();
import ProductEdit from './components/ProductEdit.vue';

new Vue({
    el: '#productEdit',
    store,
    computed: {
        ...Vuex.mapState({
            a: (state) => state.a,
            b: (state) => state.b,
            c: (state) => state.c,
            d: (state) => state.d,
            e: (state) => state.e,
            f: (state) => state.f,
        }),
    },
    // mounted() {
    //   this.$nextTick(() => {
    //     window.onbeforeunload = function() {};
    //   });
    // },
    components: { ProductEdit },
    render: (h) => h(ProductEdit),
});
