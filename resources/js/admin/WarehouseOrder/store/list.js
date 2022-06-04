export default {
    namespaced: true,
    state: {
      content: {},
      searchFilter: {
        id: '',
        title: '',
      },
      tabName: 'new_order',
      tabType: 'All',
      warehouseStore: {

      },
      dialogTableVisible: false,
      orderChosenID: '',
      detailOrder: {},
      loadingOrderDetail: false,
      search: {
        idWarehouseOrder: '', idWarehouse: '',
      },
    },
    mutations: {
        content(state, payloadGeneral) {
            state.content = payloadGeneral;
        },
        loadingOrderDetail(state, value) {
          state.loadingOrderDetail = value;
      },
        filterTitle(state, value) {
          state.searchFilter.title = value;
        },
        filterID(state, value) {
          state.searchFilter.id = value;
        },
        tabName(state, value) {
          state.tabName = value;
        },
        dataWarehouseStore(state, value) {
          state.warehouseStore = value;
        },
        setDialogTable(state, payload) {
          state.dialogTableVisible = payload;
        },
        setOrderChosen(state, payload) {
          state.orderChosenID = payload;
        },
        detailOrder(state, payload) {
          state.detailOrder = payload;
        },
        setDetailOrder(state, payload) {
          state.detailOrder.status = payload;
        },
        setIdWarehouseOrder(state, payload) {
          state.search.idWarehouseOrder = payload;
        },
        setIdWarehouse(state, payload) {
          state.search.idWarehouse = payload;
        },
    },
    actions: {
      content({ commit }, content) {
        commit('content', content);
      },
      filterTitle({ commit }, content) {
        commit('filterTitle', content);
      },
      filterID({ commit }, content) {
        commit('filterID', content);
      },
      tabName({ commit }, content) {
        commit('tabName', content);
      },
      dataWarehouseStore({ commit }, content) {
        commit('dataWarehouseStore', content);
      },
      setDialogTable({ commit }, content) {
        commit('setDialogTable', content);
      },
      setOrderChosen({ commit }, content) {
        commit('setOrderChosen', content);
      },
      detailOrder({ commit }, content) {
        commit('detailOrder', content);
      },
      setDetailOrder({ commit }, content) {
        commit('setDetailOrder', content);
      },
      setIdWarehouseOrder({ commit }, content) {
        commit('setIdWarehouseOrder', content);
      },
      setIdWarehouse({ commit }, content) {
        commit('setIdWarehouse', content);
      },
      loadingOrderDetail({ commit }, content) {
        commit('loadingOrderDetail', content);
      },
    },
    getters: {

    },
  };
