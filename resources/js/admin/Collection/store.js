import Vue from 'vue'
import Vuex from 'vuex'
// import moduleGenera from './store/general.js'
import moduleEdit from './store/edit.js'
import moduleImage from './store/image.js'
import moduleList from './store/list.js'
// import moduleInfo from './store/dataTag.js'
Vue.use(Vuex) // khai báo vue sử dụng plugin vuex
export const store = new Vuex.Store({
  modules: {
    a: moduleList,
    b: moduleEdit,
    c: moduleImage,
    // c: moduleInfo,
  }
});
