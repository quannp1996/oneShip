export default {
    namespaced: true,
    state: {
        content: {},
        searchFilter: {
            // id: '',
            // title: '',
            idWarehouse: '',
        },
        dialogVisible: false,
        warehouseData: {},
        dialogChoice: {
            idPrd: '',
            idWarehouse: '',
        },
    },
    mutations: {
        contentGeneral(state, payloadGeneral) {
            state.content = payloadGeneral;
        },
        filterTitle(state, value) {
            state.searchFilter.title = value;
        },
        filterID(state, value) {
            state.searchFilter.id = value;
        },
        dialogVisibleSet(state, value) {
            state.dialogVisible = value;
        },
        warehouseData(state, value) {
            state.warehouseData = value;
        },
        setIdPrd(state, value) {
            state.dialogChoice.idPrd = value;
        },
        setIdWarehouse(state, value) {
            state.dialogChoice.idWarehouse = value;
        },
        searchWarehouseID(state, value) {
          state.searchFilter.idWarehouse = value;
      },
    },
    actions: {
        contentGeneral({ commit }, content) {
            commit('contentGeneral', content);
        },
        filterTitle({ commit }, content) {
            commit('filterTitle', content);
        },
        filterID({ commit }, content) {
            commit('filterID', content);
        },
        dialogVisibleSet({ commit }, content) {
            commit('dialogVisibleSet', content);
        },
        setIdPrd({ commit }, content) {
            commit('setIdPrd', content);
        },
        warehouseData({ commit }, content) {
            commit('warehouseData', content);
        },
        setIdWarehouse({ commit }, content) {
            commit('setIdWarehouse', content);
        },
        searchWarehouseID({ commit }, content) {
          commit('searchWarehouseID', content);
        },
    },
    getters: {

    }
}
