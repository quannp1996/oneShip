export default {
  namespaced: true,
  state: {
    content: {},
    tabLangID: 1,
    langData: {},
  },
  mutations: {
      content(state, payloadGeneral) {
          state.content = payloadGeneral;
      },
      updateTitle(state, value) {
        state.content[state.tabLangID].name = value;
      },
      updateShort_description(state, value) {
        state.content[state.tabLangID].short_description = value;
      },
      updateLangID(state, value) {
        state.tabLangID = value;
      },
      updateLangData(state, value) {
        state.langData = value;
      },
  },
  actions: {
    content({ commit }, content) {
      commit('content', content);
    },
    updateTitle({ commit }, content) {
      commit('updateTitle', content);
    },
    updateShort_description({ commit }, content) {
      commit('updateShort_description', content);
    },
    updateLangID({ commit }, content) {
      commit('updateLangID', content);
    },
    updateLangData({ commit }, content) {
      commit('updateLangData', content);
    },
  },
  getters: {

  },
};