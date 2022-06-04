import Vue from 'vue';
import Vuex from 'vuex';
import moduleGenera from './store/general.js';
import moduleEdit from './store/edit.js';
import moduleInfo from './store/dataInfo.js';
Vue.use(Vuex); // khai báo vue sử dụng plugin vuex
export const store = new Vuex.Store({
  modules: {
    a: moduleGenera,
    b: moduleEdit,
    c: moduleInfo,
  },
});