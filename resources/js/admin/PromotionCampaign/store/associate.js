export default {
    namespaced: true,
    state: {
        cateContent: [],
    },
    mutations: {
        cateGetData(state, payloadData) {
            state.cateContent = payloadData;
        },
        cateSet(state, payload) {
            let i = 0;
            if (typeof state.cateContent !== 'undefined') {
                Array.from(state.cateContent).forEach((child) => {
                    if (child.id == payload[0].id) {
                        i++;
                    }
                });
                if (i == 0) {
                    state.cateContent.push({
                        name: payload[0].value,
                        id: payload[0].id,
                    });
                }
            } else {
                if (i == 0) {
                    state.cateContent = new Array();
                    state.cateContent.push({
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
            const data = state.cateContent;
            delete data[payload];
            state.cateContent = data.filter(unique);
        },
    },
    actions: {
        cateGetData({ commit }, content) {
            commit('cateGetData', content);
        },
        setPrimaryCategoryId({ commit }, content) {
            commit('setPrimaryCategoryId', content);
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
