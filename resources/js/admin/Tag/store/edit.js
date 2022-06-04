export default {
    namespaced: true,
    state: {
      content: {
        id: '',
        title: '',
        image: '',
        type: 'product',
        color: '',
        cate: '',
        primary_category_id: '',
      },
      type: {},
      cate: {},
    },
    mutations: {
        content(state, payload) {
            state.content = payload;
        },
        setTitle(state, value) {
          state.content.title = value;
        },
        setType(state, value) {
          state.content.type = value;
        },
        setCate(state, value) {
          state.content.cate = value;
        },
        setImg(state, value) {
          state.content.image = value;
        },
        setColor(state, value) {
          state.content.color = value;
        },
        setPrimaryCategoryId(state, value) {
          state.content.primary_category_id = value;
        },
    },
    actions: {
      content({ commit }, content) {
        commit('content', content);
      },
      setTitle({ commit }, content) {
        commit('setTitle', content);
      },
      setType({ commit }, content) {
        commit('setType', content);
      },
      setCate({ commit }, content) {
        commit('setCate', content);
      },
      setImg({ commit }, content) {
        commit('setImg', content);
      },
      setColor({ commit }, content) {
        commit('setColor', content);
      },
      setPrimaryCategoryId({ commit }, content) {
        commit('setPrimaryCategoryId', content);
      },
    },
    getters: {

    },
  };
