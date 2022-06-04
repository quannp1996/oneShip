export default {
    namespaced: true,
    state: {
        collectionContent: [],
    },
    mutations: {
        cateGetData(state, payloadData) {
            state.collectionContent = payloadData;
        },
        cateSet(state, payload) {
            let i = 0;
            if (typeof state.collectionContent !== 'undefined') {
                Array.from(state.collectionContent).forEach((child) => {
                    if (child.id == payload[0].id) {
                        i++;
                    }
                });
                if (i == 0) {
                    state.collectionContent.push({
                        name: payload[0].value,
                        id: payload[0].id,
                    });
                }
            } else {
                if (i == 0) {
                    state.collectionContent = new Array();
                    state.collectionContent.push({
                        name: payload[0].value,
                        id: payload[0].id,
                    });
                }
            }
        },
        cateDelete(state, payload) {
            const unique = (value, index, self) => {
                return self.indexOf(value) === index;
            };
            const data = state.collectionContent;
            delete data[payload];
            state.collectionContent = data.filter(unique);
        },
    },
    actions: {
        cateGetData({ commit }, content) {
            commit('cateGetData', content);
        },
        cateSet({ commit }, content) {
            commit('cateSet', content);
        },
        cateDelete({ commit }, content) {
            commit('cateDelete', content);
        },
    },
    getters: {

    },
};