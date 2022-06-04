export default {
  namespaced: true,
  state: {
    tagsContent: [],
    labelsContent: [],
  },
  mutations: {
    tagGetData(state, payloadData) {
      state.tagsContent = payloadData;
    },
    labelGetData(state, payloadData) {
      state.labelsContent = payloadData;
    },
    tagAddData(state, input) {
      const tags ={
        'tags': {
            'title': input,
        },
      };

      state.tagsContent.push(tags);
    },
    labelAddData(state, input) {
      const labels ={
        'tags': {
            'title': input,
        },
      };

      state.labelsContent.push(labels);
    },
    tagAddDataSearch(state, input) {
      let i = 0;
        Array.from(state.tagsContent).forEach((child) => {
          if (child.id == input.id) {
        i++;
        }
      });
      if (i==0) {
        const tags ={
          'id': input.id,
          'tags': {
              'title': input.value,
          },
        };
        state.tagsContent.push(tags);
      }
    },
    tagDeleteData(state, key) {
      const unique = (value, index, self) => {
          return self.indexOf(value) === index;
      };
      delete state.tagsContent[key];
      state.tagsContent = state.tagsContent.filter(unique);
    },
    labelAddDataSearch(state, input) {
      let i = 0;
        Array.from(state.labelsContent).forEach((child) => {
          if (child.id == input.id) {
        i++;
        }
      });
      if (i==0) {
        const labels ={
          'id': input.id,
          'tags': {
              'title': input.value,
          },
        };
        state.labelsContent.push(labels);
      }
    },
    labelDeleteData(state, key) {
      const unique = (value, index, self) => {
          return self.indexOf(value) === index;
      };
      delete state.labelsContent[key];
      state.labelsContent = state.labelsContent.filter(unique);
    },
  },
  actions: {
    tagGetData({ commit }, content) {
      commit('tagGetData', content);
    },
    labelGetData({ commit }, content) {
      commit('labelGetData', content);
    },
    tagAddData({ commit }, content) {
      commit('tagAddData', content);
    },
    tagDeleteData({ commit }, content) {
      commit('tagDeleteData', content);
    },
    tagAddDataSearch({ commit }, content) {
      commit('tagAddDataSearch', content);
    },
    labelAddDataSearch({ commit }, content) {
      commit('labelAddDataSearch', content);
    },
    labelDeleteData({ commit }, content) {
      commit('labelDeleteData', content);
    },
    labelAddData({ commit }, content) {
      commit('labelAddData', content);
    },
  },
  getters: {

  },
};
