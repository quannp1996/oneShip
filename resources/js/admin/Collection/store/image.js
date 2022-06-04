export default {
  namespaced: true,
  state: {
    fileList: [],
  },
  mutations: {
    fileList(state, payloadData) {
      state.fileList = payloadData;
    },
  },
  actions: {
    fileList({ commit }, content) {
      commit('fileList', content);
    },
  },
  getters: {

  },
};