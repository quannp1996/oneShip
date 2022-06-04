export default {
    namespaced: true,
    state: {
        filterContent: [],
    },
    mutations: {
        filterGetData(state, payloadData) {
            state.filterContent = payloadData;
        },
        filterSet(state, payload) {
            let i = 0;
            if (typeof state.filterContent !== 'undefined') {
                Array.from(state.filterContent).forEach((child) => {
                    if (child.id == payload[0].id) {
                        i++;
                    }
                });
                if (i == 0) {
                    state.filterContent.push({
                        name: payload[0].value,
                        id: payload[0].id,
                    });
                }
            } else {
                if (i == 0) {
                    state.filterContent = new Array();
                    state.filterContent.push({
                        name: payload[0].value,
                        id: payload[0].id,
                    });
                }
            }
        },
        filterDelete(state, payload) {
            const unique = (value, index, self) => {
                return self.indexOf(value) === index;
            };
            const data = state.filterContent;
            delete data[payload];
            state.filterContent = data.filter(unique);
        },
    },
    actions: {
        filterGetData({ commit }, content) {
            commit('filterGetData', content);
        },
        filterSet({ commit }, content) {
            commit('filterSet', content);
        },
        filterDelete({ commit }, content) {
            commit('filterDelete', content);
        },
    },
    getters: {

    },
};
