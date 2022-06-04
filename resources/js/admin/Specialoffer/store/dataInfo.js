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
      updateLink(state, value) {
        state.content[state.tabLangID].link = value;
      },
      updateShort_description(state, value) {
        state.content[state.tabLangID].short_description = value;
      },
      updateDescription(state, value) {
        state.content[state.tabLangID].description = value;
      },
      updateMeta_description(state, value) {
        state.content[state.tabLangID].meta_description = value;
      },
      updateMeta_title(state, value) {
        state.content[state.tabLangID].meta_title = value;
      },
      updateMeta_keyword(state, value) {
        state.content[state.tabLangID].meta_keyword = value;
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
    updateLink({ commit }, content) {
      commit('updateLink', content);
    },
    updateShort_description({ commit }, content) {
      commit('updateShort_description', content);
    },
    updateDescription({ commit }, content) {
      commit('updateDescription', content);
    },
    updateMeta_title({ commit }, content) {
      commit('updateMeta_title', content);
    },
    updateMeta_description({ commit }, content) {
      commit('updateMeta_description', content);
    },
    updateMeta_keyword({ commit }, content) {
      commit('updateMeta_keyword', content);
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