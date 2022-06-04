export default {
  namespaced: true,
  state: {
    content: {},
    searchFilter: {
      id: '',
      name: '',
    },
  },
  mutations: {
      contentGeneral(state, payloadGeneral) {
          state.content = payloadGeneral;
      },
      filterName(state, value) {
        state.searchFilter.name = value;
      },
      filterID(state, value) {
        state.searchFilter.id = value;
      },
  },
  actions: {
    contentGeneral({ commit }, content) {
      commit('contentGeneral', content);
    },
    filterName({ commit }, content) {
      commit('filterName', content);
    },
    filterID({ commit }, content) {
      commit('filterID', content);
    },
  },
  getters: {

  },
};