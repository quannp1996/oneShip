import Vue from 'vue';
import Vuex from 'vuex';
import moduleGenera from './store/general.js';
import moduleData from './store/data.js';
import moduleImage from './store/image.js';
import moduleAssociate from './store/associate.js';
import moduleFilter from './store/filter.js';
import moduleTag from './store/tag.js';
import moduleCollection from './store/collection.js';
Vue.use(Vuex); // khai báo vue sử dụng plugin vuex
export const store = new Vuex.Store({
  modules: {
    a: moduleGenera,
    b: moduleData,
    c: moduleImage,
    d: moduleAssociate,
    e: moduleTag,
    f: moduleFilter,
    g: moduleCollection,
  },
});