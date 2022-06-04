export default {
    namespaced: true,
    state: {
      content: {
        id: '',
        image: '',
        image_mobile: '',
        status: 1,
        start_date: null,
        end_date: null,
        offer_discount_type: 'voucher_accessory',
        parity_price: '',
        promote_percent: '',
        formating: 'normal',
        formatprice: 'normal',
        primary_category_id: '',
      },
      formating: {},
      formatprice: {},
      collection: {},
      checkDuplicate: {},
      editableTabs: {},
      fileList: [],
      timeline: [],
      checkPrdDialogVisible: false,
    },
    mutations: {
        // ---------------------------- Content general info promotion campaign ---------------------------

        content(state, payload) {
            state.content = payload;
        },
        setImg(state, value) {
          state.content.image = value;
        },
        setImgMobi(state, value) {
          state.content.image_mobile = value;
        },
        setFormatDiscount(state, value) {
          state.content.formating = value;
        },
        setFormatPrice(state, value) {
          state.content.formatprice = value;
        },
        setParityPrice(state, value) {
          state.content.parity_price = value;
        },
        setPromotePercentDiscount(state, value) {
          state.content.promote_percent = value;
        },
        setTimeStart(state, value) {
          state.content.start_date = value;
        },
        setTimeEnd(state, value) {
          state.content.end_date = value;
        },
        setPrimaryCategoryId(state, value) {
          state.content.primary_category_id = value;
        },
        setStatus(state, value) {
          state.content.status = value;
        },
        updateTimeline(state, payload) {
          state.timeline = payload;
        },
        setCheckPrdDialogVisible(state, payload) {
          state.checkPrdDialogVisible = payload;
        },
        fileList(state, payloadData) {
          state.fileList = payloadData;
        },
        setFilelist(state, payloadData) {
          state.fileList = payloadData;
        },
        setFilelistAddPrd(state, payloadData) {
          if (state.fileList.length == 0) {
              state.fileList = new Array();
          }
          state.fileList.push({
              img: payloadData.image,
              imglarge: payloadData.imglarge,
              promotion_campaign_id: '',
              id: payloadData.id,
          });
          // state.fileList = payloadData;
        },
        // ---------------------------- Format data and languages ---------------------------
        updateLangData(state, value) {
          state.langData = value;
        },
        setFormat(state, value) {
          state.formating = value;
        },
        setFormatPriceList(state, value) {
          state.formatprice = value;
        },
        // ---------------------------- Collection product ---------------------------
        checkDuplicatePrdCollection(state, value) {
          state.checkDuplicate = value;
        },
        removeElement(state, payload) {
          delete state.collection[payload];
          state.collection = Object.assign({}, state.collection, state.collection);
        },
        removeCheckDuplicate(state, payload) {
          delete state.checkDuplicate[payload];
          state.checkDuplicate = Object.assign({}, state.checkDuplicate, state.checkDuplicate);
        },
        collection(state, payload) {
          state.collection = payload;
        },
        collectionData(state, payload) {
          const lastKey = parseInt(Object.keys(state.collection).length) + 1;
          state.collection[lastKey] = {
              id: payload.product_id,
              name: payload.name,
              description: payload.description,
              short_description: payload.short_description,
              sort: 0,
              timeline: [],
          };
          if (payload.product != null ) {
              state.collection[lastKey].image = payload.product.image ?? '';
              state.collection[lastKey].imageUrl = payload.product.imageUrl ?? '';
              state.collection[lastKey].categories = {};
              if (typeof payload.product.categories !== 'undefined') {
                      payload.product.categories.forEach((element, index) => {
                      state.collection[lastKey].categories[index] = element.desc;
                  });
              }
          }
          state.collection = Object.assign({}, state.collection, state.collection);
        },
        addPrdsCollectionData(state, payload) {
          const pickPrd={};
          let lastKey = parseInt(Object.keys(state.collection).length) + 1;

          Array.from(payload).forEach((child) => {
              if (typeof state.collection[child.id] === 'undefined') {
                  lastKey++; console.log(lastKey);
                  pickPrd[lastKey] = {
                      id: child.id,
                      name: child.desc.name,
                      description: child.description,
                      short_description: child.desc.short_description,
                      sort: 0,
                      timeline: [],
                  };
                  if (child != null ) {
                      pickPrd[lastKey].image = child.image ?? '';
                      pickPrd[lastKey].imageUrl = child.image_url ?? '';
                      pickPrd[lastKey].categories = {};
                      if (typeof child.categories !== 'undefined') {
                              child.categories.forEach((element, index) => {
                              pickPrd[lastKey].categories[index] = element.desc;
                          });
                      }
                  }
              }
          });
          const merged = { ...state.collection, ...pickPrd };
          state.collection = merged;
          state.collection = Object.assign({}, state.collection, state.collection);
        },
        // ---------------------------- tab collection search ----------------------------
        setContentTabPrd(state, value) {
          state.editableTabs[value.tabDetect].content = value.prd;
        },
        addEditTableTabs(state, value) {
          state.editableTabs[value.name] = value;
        },
        setEditTableTabs(state, value) {
          state.editableTabs = value;
          state.editableTabs = Object.assign({}, state.editableTabs, state.editableTabs);
        },

        filterEditTableTabs(state, value) {
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
    },
    actions: {
      content({ commit }, content) {
        commit('content', content);
      },
      collection({ commit }, content) {
        commit('collection', content);
      },
      updateTimeline({ commit }, content) {
        commit('updateTimeline', content);
      },
      setPrimaryCategoryId({ commit }, content) {
        commit('setPrimaryCategoryId', content);
      },
      setStatus({ commit }, content) {
        commit('setStatus', content);
      },
      fileList({ commit }, content) {
        commit('fileList', content);
      },
      setFilelist({ commit }, content) {
        commit('setFilelist', content);
      },
      setFilelistAddPrd({ commit }, content) {
        commit('setFilelistAddPrd', content);
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
      setImgMobi({ commit }, content) {
        commit('setImgMobi', content);
      },
      setFormatDiscount({ commit }, content) {
        commit('setFormatDiscount', content);
      },
      setPromotePercentDiscount({ commit }, content) {
        commit('setPromotePercentDiscount', content);
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
      setFormat({ commit }, content) {
        commit('setFormat', content);
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
      setParityPrice({ commit }, content) {
        commit('setParityPrice', content);
      },
      formatprice({ commit }, content) {
        commit('formatprice', content);
      },
      setFormatPrice({ commit }, content) {
        commit('setFormatPrice', content);
      },
      setFormatPriceList({ commit }, content) {
        commit('setFormatPriceList', content);
      },
      setContentTabPrd({ commit }, content) {
        commit('setContentTabPrd', content);
      },
      setCheckPrdDialogVisible({ commit }, content) {
        commit('setCheckPrdDialogVisible', content);
      },
      checkDuplicatePrdCollection({ commit }, content) {
        commit('checkDuplicatePrdCollection', content);
      },
      removeCheckDuplicate({ commit }, content) {
        commit('removeCheckDuplicate', content);
      },
    },
    getters: {

    },
  };
