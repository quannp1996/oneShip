export default {
  namespaced: true,
  state: {
    content:{},
    searchFilter:{
      id:'',
      title:'',
    }
  },
  mutations: {
      contentGeneral(state, payloadGeneral){
          state.content = payloadGeneral;
      },
      filterTitle(state,value){
        state.searchFilter.title = value;
      },
      filterID(state,value){
        state.searchFilter.id = value;
      }
  },
  actions: {
    contentGeneral({commit},content){
      commit('contentGeneral',content);
    },
    filterTitle({commit},content){
      commit('filterTitle',content);
    },
    filterID({commit},content){
      commit('filterID',content);
    },
  },
  getters: {

  }
}
