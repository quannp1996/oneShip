export default {
    namespaced: true,
    state: {
      productData: [],
      dialogTableVisible: false,
      dialogFormVisible: false,
    },
    mutations: {
        productData(state, payload) {
            const data = state.productData;
            data.push(payload);
            state.productData = data;
            state.productData = Object.assign([], state.productData, state.productData);
        },
        setDialogForm(state, payload) {
            state.dialogFormVisible = payload;
        },
        setDialogTable(state, payload) {
            state.dialogTableVisible = payload;
        },
        deleteProductData(state, payload) {
            delete state.productData[payload];
            // state.productData = Object.assign({}, state.productData, state.productData);
            state.productData = state.productData.filter(Boolean);
        },
    },
    actions: {
        productData({ commit }, content) {
            commit('productData', content);
        },
        setDialogForm({ commit }, content) {
            commit('setDialogForm', content);
        },
        setDialogTable({ commit }, content) {
            commit('setDialogTable', content);
        },
        deleteProductData({ commit }, content) {
            commit('deleteProductData', content);
        },
    },
    getters: {

    },
  };
