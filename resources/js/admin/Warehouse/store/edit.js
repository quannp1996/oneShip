export default {
    namespaced: true,
    state: {
      content: {
      },
      dialogVisible: false,
      dialogEditVisible: false,
      dialogVisiblePrdVariantSet: false,
      dataDetail: {},
      loading: true,
      choiceVariant: '',
    },
    mutations: {
        content(state, payload) {
            state.content = payload;
        },
        dialogVisible(state, payload) {
          state.dialogVisible = payload;
        },
        dialogEditVisible(state, payload) {
          state.dialogEditVisible = payload;
        },
        setDialogVisiblePrdVariantSet(state, payload) {
          state.dialogVisiblePrdVariantSet = payload;
        },
        dataDetail(state, payload) {
          state.dataDetail = payload;
        },
        setLoading(state, payload) {
          state.loading = payload;
        },
        choiceVariant(state, payload) {
          state.choiceVariant = payload;
        },
    },
    actions: {
      content({ commit }, content) {
        commit('content', content);
      },
      dialogVisible({ commit }, content) {
        commit('dialogVisible', content);
      },
      setDialogVisiblePrdVariantSet({ commit }, content) {
        commit('setDialogVisiblePrdVariantSet', content);
      },
      dataDetail({ commit }, content) {
        commit('dataDetail', content);
      },
      setLoading({ commit }, content) {
        commit('setLoading', content);
      },
      choiceVariant({ commit }, content) {
        commit('choiceVariant', content);
      },
      dialogEditVisible({ commit }, content) {
        commit('choiceVariant', content);
      },
    },
    getters: {

    },
  };
