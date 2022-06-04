export default {
    namespaced: true,
    state: {
        content: {},
        tabLangID: 1,
        lang: [],
    },
    mutations: {
        contentGeneral(state, payloadGeneral) {
            state.content = payloadGeneral;
        },
        updateTitle(state, value) {
            state.content[state.tabLangID].name = value;
        },
        updateSlug(state, value) {
            state.content[state.tabLangID].slug = value.replace(/\s/g, '');
        },
        updateLangID(state, value) {
            state.tabLangID = value;
        },
        updateShort_description(state, value) {
            state.content[state.tabLangID].short_description = value;
        },
        updateDescription(state, value) {
            state.content[state.tabLangID].description = value;
        },
        updateProduct_description(state, value) {
            state.content[state.tabLangID].product_description = value;
        },
        updatePolicy(state, value) {
            state.content[state.tabLangID].policy = value;
        },
        updateDocument(state, value) {
            state.content[state.tabLangID].document = value;
        },
        updateTechnology(state, value) {
            state.content[state.tabLangID].technology = value;
        },
        updateMeta_title(state, value) {
            state.content[state.tabLangID].meta_title = value;
        },
        updateMeta_description(state, value) {
            state.content[state.tabLangID].meta_description = value;
        },
        updateMeta_keyword(state, value) {
            state.content[state.tabLangID].meta_keyword = value;
        },
        setLangData(state, value) {
            state.lang = value;
            if (Object.keys(state.content).length === 0) {
                value.forEach((element, index) => {
                    state.content[element.language_id] = {
                        id: '',
                        name: '',
                        slug: '',
                        short_description: '',
                        technology: '',
                        document: '',
                        description: '',
                        product_description: '',
                        meta_title: '',
                        meta_description: '',
                        meta_keyword: '',
                        language_id: element.language_id,
                    };
                });
                state.content = Object.assign({}, state.content, state.content);
            }
        },
    },
    actions: {
        contentGeneral({commit}, content) {
            commit('contentGeneral', content);
        },
        updateTitle({commit}, content) {
            commit('updateTitle', content);
        },
        updateLangID({commit}, id) {
            commit('updateLangID', id);
        },
        updateShort_description({commit}, content) {
            commit('updateShort_description', content);
        },
        updateDescription({commit}, content) {
            commit('updateDescription', content);
        },
        updateProduct_description({commit}, content) {
            commit('updateProduct_description', content);
        },
        updatePolicy({commit}, content) {
            commit('updatePolicy', content);
        },
        updateDocument({commit}, content) {
            commit('updateDocument', content);
        },
        updateTechnology({commit}, content) {
            commit('updateTechnology', content);
        },
        updateMeta_title({commit}, content) {
            commit('updateMeta_title', content);
        },
        updateMeta_description({commit}, content) {
            commit('updateMeta_description', content);
        },
        updateMeta_keyword({commit}, content) {
            commit('updateMeta_keyword', content);
        },
        setLangData({commit}, content) {
            commit('setLangData', content);
        },
        updateSlug({commit}, content) {
            commit('updateSlug', content);
        },
    },
    getters: {},
};
