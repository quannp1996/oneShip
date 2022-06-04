import Vue from 'vue'
import Vuex from 'vuex'
import moduleList from './store/list.js'
import moduleOrder from './store/order.js'
Vue.use(Vuex) // khai báo vue sử dụng plugin vuex
export const store = new Vuex.Store({
  modules: {
    a: moduleList,
    b: moduleOrder,
    // a: moduleGenera,
    // b: moduleEdit,
    // c: moduleInfo,
  }
});
