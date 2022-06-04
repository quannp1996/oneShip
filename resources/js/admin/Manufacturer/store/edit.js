export default {
    namespaced: true,
    state: {
      content: {
        manufacturer_id: '',
        name: '',
        image: '',
        sort_order: '',
        created_at: '',
        primary_category_id: '',
      },
      type: {},
      cate: {},
    },
    mutations: {
        content(state, payload) {
            state.content = payload;
        },
        setName(state, value) {
          state.content.name = value;
        },
        setImg(state, value) {
          state.content.image = value;
        },
        setSortOrder(state, value) {
          state.content.sort_order = value;
        },
        setPrimaryCategoryId(state, value) {
          state.content.primary_category_id = value;
        },
    },
    actions: {
      content({ commit }, content) {
        commit('content', content);
      },
      setName({ commit }, content) {
        commit('setName', content);
      },
      setImg({ commit }, content) {
        commit('setImg', content);
      },
      setSortOrder({ commit }, content) {
        commit('setSortOrder', content);
      },
      setPrimaryCategoryId({ commit }, content) {
        commit('setPrimaryCategoryId', content);
      },
    },
    getters: {

    },
  };