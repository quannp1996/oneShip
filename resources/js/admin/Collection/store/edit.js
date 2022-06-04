export default {
    namespaced: true,
    state: {
        content: {},
        general: {
            id: '',
            image: '',
            image_hover: '',
            images:[],
            title: '',
            is_good_price: '',
            color: '',
            status: 1,
            is_showroom: 0,
            sort_order: 0,
        },
        collection: {},
        productAddCollection: {},
        langData: {},
        tabLangID: 1,
        tagsContent: [],
        editableTabs: {},
    },
    mutations: {
        content(state, payload) {
            state.content = payload;
        },
        images(state, payload){
            state.general.images = payload;
        },
        pushImages(state, payload){
            state.general.images.push(payload);
        },
        general(state, payload) {
            state.general = payload;
        },
        resetTab(state, payload) {
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

            // state.collection[payload.product_id] = {
            //     id: payload.product_id,
            //     name: payload.name,
            //     description: payload.description,
            //     short_description: payload.short_description,
            // };
            // if (payload.product != null ) {
            //     state.collection[payload.product_id].image = payload.product.image ?? '';
            //     state.collection[payload.product_id].imageUrl = payload.product.imageUrl ?? '';
            //     state.collection[payload.product_id].categories = {};
            //     if (typeof payload.product.categories !== 'undefined') {
            //             payload.product.categories.forEach((element, index) => {
            //             state.collection[payload.product_id].categories[index] = element.desc;
            //         });
            //     }
            // }
            // state.collection = Object.assign({}, state.collection, state.collection);
        },
        removeElement(state, payload) {
            delete state.collection[payload];
            state.collection = Object.assign({}, state.collection, state.collection);
        },
        updateLangData(state, value) {
            state.langData = value;
        },
        updateLangID(state, value) {
            state.tabLangID = value;
        },
        updateTitle(state, value) {
            state.content[state.tabLangID].name = value;
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
        setImg(state, value) {
            state.general.image = value;
        },
        setImgHover(state, value) {
            state.general.image_hover = value;
        },
        setGoodPrice(state, value) {
            state.general.is_good_price = value;
        },
        setStatus(state, value) {
            state.general.status = value;
        },

        setShowroom(state, value) {
            state.general.is_showroom = value;
        },

        setSort_order(state, value) {
            state.general.sort_order = value;
        },
        tagGetData(state, payloadData) {
            state.tagsContent = payloadData;
          },
        tagAddData(state, input) {
            const tags ={
                'tags': {
                    'title': input,
                },
            };

            state.tagsContent.push(tags);
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
        setColor(state, value) {
            state.general.color = value;
        },
        setProductAddCollection(state, value) {
            // state.collection[payload.product_id] = {
            //     id: payload.product_id,
            //     name: payload.name,
            //     description: payload.description,
            //     short_description: payload.short_description,
            // };
            // if (payload.product != null ) {
            //     state.collection[payload.product_id].image = payload.product.image ?? '';
            //     state.collection[payload.product_id].imageUrl = payload.product.imageUrl ?? '';
            //     state.collection[payload.product_id].cate = {};
            //     if (typeof payload.product.categories !== 'undefined') {
            //             payload.product.categories.forEach((element, index) => {
            //             state.collection[payload.product_id].cate[index] = element.desc;
            //         });
            //     }
            // }
            // state.collection = Object.assign({}, state.collection, state.collection);
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
    },
    actions: {
        images({ commit }, content) {
            commit('images', content);
        },
        pushImages({ commit }, content) {
            commit('pushImages', content);
        },
        content({ commit }, content) {
            commit('content', content);
        },
        general({ commit }, content) {
            commit('general', content);
        },
        collectionData({ commit }, content) {
            commit('collectionData', content);
        },
        removeElement({ commit }, content) {
            commit('removeElement', content);
        },
        updateLangData({ commit }, content) {
            commit('updateLangData', content);
        },
        updateTitle({ commit }, content) {
            commit('updateTitle', content);
        },
        updateShort_description({ commit }, content) {
            commit('updateShort_description', content);
        },
        updateDescription({ commit }, content) {
            commit('updateDescription', content);
        },
        updateMeta_description({ commit }, content) {
            commit('updateMeta_description', content);
        },
        updateMeta_title({ commit }, content) {
            commit('updateMeta_title', content);
        },
        updateMeta_keyword({ commit }, content) {
            commit('updateMeta_keyword', content);
        },
        updateLangID({ commit }, content) {
            commit('updateLangID', content);
        },
        setImg({ commit }, content) {
            commit('setImg', content);
        },
        setImgHover({ commit }, content) {
            commit('setImgHover', content);
        },
        setGoodPrice({ commit }, content) {
            commit('setGoodPrice', content);
        },
        setStatus({ commit }, content) {
            commit('setStatus', content);
        },
        setShowroom({ commit }, content) {
            commit('setShowroom', content);
        },
        setSort_order({ commit }, content) {
            commit('setSort_order', content);
        },
        tagGetData({ commit }, content) {
            commit('tagGetData', content);
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
        setColor({ commit }, content) {
            commit('setColor', content);
        },
        setProductAddCollection({ commit }, content) {
            commit('setProductAddCollection', content);
        },
        addEditTableTabs({ commit }, content) {
            commit('addEditTableTabs', content);
        },
        setEditTableTabs({ commit }, content) {
            commit('setEditTableTabs', content);
        },
        addPrdsCollectionData({ commit }, content) {
            commit('addPrdsCollectionData', content);
        },
        setContentTabPrd({ commit }, content) {
          commit('setContentTabPrd', content);
      },
    },
    getters: {

    },
};
