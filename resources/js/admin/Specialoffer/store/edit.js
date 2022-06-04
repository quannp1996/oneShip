export default {
    namespaced: true,
    state: {
      content: {
        id: '',
        image: '',
        status: 1,
        offer_time_start: null,
        offer_time_end: null,
        offer_discount_type: 'price',
        offer_discount_value: '',
      },
      type: {},
      collection: {},
      editableTabs: {},
    },
    mutations: {
        content(state, payload) {
            state.content = payload;
        },
        setStatus(state, value) {
          state.content.status = value;
        },
        setContentTabPrd(state, value) {
          state.editableTabs[value.tabDetect].content = value.prd;
          state.editableTabs = Object.assign({}, state.editableTabs, state.editableTabs);
        },
        collectionData(state, payload) {
          state.collection[payload.product_id] = {
              id: payload.product_id,
              name: payload.name,
              description: payload.description,
              short_description: payload.short_description,
          };
          if (payload.product != null ) {
              state.collection[payload.product_id].image = payload.product.image ?? '';
              state.collection[payload.product_id].imageUrl = payload.product.imageUrl ?? '';
              state.collection[payload.product_id].categories = {};
              if (typeof payload.product.categories !== 'undefined') {
                      payload.product.categories.forEach((element, index) => {
                      state.collection[payload.product_id].categories[index] = element.desc;
                  });
              }
          }
          state.collection = Object.assign({}, state.collection, state.collection);
        },
        addPrdsCollectionData(state, payload) {
          const pickPrd={};
          Array.from(payload).forEach((child) => {
              if (typeof state.collection[child.id] === 'undefined') {
                  pickPrd[child.id] = {
                      id: child.id,
                      name: child.desc.name,
                      description: child.description,
                      short_description: child.desc.short_description,
                  };
                  if (child != null ) {
                      pickPrd[child.id].image = child.image ?? '';
                      pickPrd[child.id].imageUrl = child.image_url ?? '';
                      pickPrd[child.id].categories = {};
                      if (typeof child.categories !== 'undefined') {
                              child.categories.forEach((element, index) => {
                              pickPrd[child.id].categories[index] = element.desc;
                          });
                      }
                  }
              }
          });
          const merged = { ...state.collection, ...pickPrd };
          state.collection = merged;
          state.collection = Object.assign({}, state.collection, state.collection);
        },
        addEditTableTabs(state, value) {
          state.editableTabs[value.name] = value;
          // state.editableTabs.push(value);
          // state.editableTabs.push(value);
        },
        setEditTableTabs(state, value) {
          state.editableTabs = value;
          state.editableTabs = Object.assign({}, state.editableTabs, state.editableTabs);
        },

        filterEditTableTabs(state, value) {
          // state.editableTabs[value.index] = state.editableTabsOriginFilter[value.index];
          Object.filter = (obj, predicate) =>
            Object.keys(obj)
                  .filter( (key) => predicate(obj[key]) )
                  .reduce( (res, key) => (res[key] = obj[key], res), {} );
          const filtered = Object.filter(state.editableTabs[value.index].content, (score) => {
            if ( score.product !=null ) {
              return score.product.desc.name.includes(value.filter);
            }
          } );
          state.editableTabs[value.index].content = filtered;
          state.editableTabs = Object.assign({}, state.editableTabs, state.editableTabs);
        },
        updateLangData(state, value) {
          state.langData = value;
        },
        setImg(state, value) {
          state.content.image = value;
        },
        setTypeDiscount(state, value) {
          state.content.offer_discount_type = value;
        },
        setPriceDiscount(state, value) {
          state.content.offer_discount_value = value;
        },
        setTimeStart(state, value) {
          state.content.offer_time_start = value;
        },
        setTimeEnd(state, value) {
          state.content.offer_time_end = value;
        },
        setType(state, value) {
          state.type = value;
        },
        removeElement(state, payload) {
          delete state.collection[payload];
          state.collection = Object.assign({}, state.collection, state.collection);
        },
    },
    actions: {
      content({ commit }, content) {
        commit('content', content);
      },
      setStatus({ commit }, content) {
        commit('setStatus', content);
      },
      collectionData({ commit }, content) {
        commit('collectionData', content);
      },
      addEditTableTabs({ commit }, content) {
        commit('addEditTableTabs', content);
      },
      setImg({ commit }, content) {
        commit('setImg', content);
      },
      setTypeDiscount({ commit }, content) {
        commit('setTypeDiscount', content);
      },
      setPriceDiscount({ commit }, content) {
        commit('setPriceDiscount', content);
      },
      setTimeStart({ commit }, content) {
        commit('setTimeStart', content);
      },
      setTimeEnd({ commit }, content) {
        commit('setTimeEnd', content);
      },
      updateLangData({ commit }, content) {
        commit('updateLangData', content);
      },
      addPrdsCollectionData({ commit }, content) {
        commit('addPrdsCollectionData', content);
      },
      setType({ commit }, content) {
        commit('setType', content);
      },
      removeElement({ commit }, content) {
        commit('removeElement', content);
      },
      setEditTableTabs({ commit }, content) {
        commit('setEditTableTabs', content);
      },
      filterEditTableTabs({ commit }, content) {
        commit('filterEditTableTabs', content);
      },
      setContentTabPrd({ commit }, content) {
        commit('setContentTabPrd', content);
      },
    },
    getters: {

    },
  };
