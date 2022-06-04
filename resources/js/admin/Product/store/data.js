export default {
    namespaced: true,
    state: {
        content: {
            image: '',
            image_url: '',
            image_design: '',
            image_design_url: '',
            status: 2,
            donvi: '',
            promotion_percent: 0,
            data_status: 2,
            is_promotion: 0,
            promotion_from: '',
            promotion_to: '',
            color: '',
            is_new: 0,
            sort_order: 0,
            code: '',
            is_home: 0,
            hot: 0,
            price: 0,
            stock: 0,
            global_price: 0
        },
        arrID_variants_add: {},
    },
    mutations: {
        contentData(state, payloadData) {
            state.content = payloadData;
        },
        deleteArrIDVariantAdd(state, value) {
            delete state.arrID_variants_add[value];
            state.arrID_variants_add = Object.assign({}, state.arrID_variants_add, state.arrID_variants_add);
        },
        addVariantID(state, value) {
            // state.arrID_variants_add.push(value.product_variant_id);
            const keyArr = value.product_variant_id;
            const productOptionInsert = value.productOptionInsert;
            state.arrID_variants_add[keyArr] = productOptionInsert;

            // console.log(productOptions);
        },
        updateStatus(state, value) {
            state.content.status = value;
        },
        updatePromotion(state, value) {
            state.content.is_promotion = value;
        },
        updatePromotionFrom(state, value) {
            state.content.promotion_from = value;
        },
        updatePromotionTo(state, value) {
            state.content.promotion_to = value;
        },
        updateData_status(state, value) {
            state.content.data_status = value;
        },
        updateGlobal_price(state, value) {
            state.content.global_price = value;
        },
        updatePrice(state, value) {
            state.content.price = value;
        },
        updateStock(state, value) {
            state.content.stock = value;
        },
        updateColor(state, value) {
            state.content.color = value;
        },
        updateNew_old(state, value) {
            state.content.is_new = value;
        },
        updateIs_home(state, value) {
            state.content.is_home = value;
        },
        updateHot(state, value) {
            state.content.hot = value;
        },
        setSort_order(state, value) {
            state.content.sort_order = value;
        },
        setCode(state, value) {
            state.content.code = value;
        },
        setImg(state, value) {
            state.content.image = value;
        },
        setImgDesign(state, value) {
            state.content.image_design = value;
        },
        setImgUrl(state, value) {
            state.content.image_url = value;
        },
        setImgDesignUrl(state, value) {
            state.content.image_design_url = value;
        },
        updateDonVi(state, value){
            state.content.donvi = value;
        },
        updatePromotionPercent(state, value){
            state.content.promotion_percent = value;
        }
    },
    actions: {
        contentData({commit}, content) {
            commit('contentData', content);
        },
        updateVideoLink({commit}, content) {
            commit('updateVideoLink', content);
        },
        updateManufacturer({commit}, content) {
            commit('updateManufacturer', content);
        },
        updateStatus({commit}, content) {
            commit('updateStatus', content);
        },
        updatePromotion({commit}, content) {
            commit('updatePromotion', content);
        },
        updatePromotionFrom({commit}, content) {
            commit('updatePromotionFrom', content);
        },
        updatePromotionTo({commit}, content) {
            commit('updatePromotionTo', content);
        },
        updateData_status({commit}, content) {
            commit('updateData_status', content);
        },
        updateGlobal_price({commit}, content) {
            commit('updateGlobal_price', content);
        },
        updatePrice({commit}, content) {
            commit('updatePrice', content);
        },
        updateStock({commit}, content) {
            commit('updateStock', content);
        },
        updateColor({commit}, content) {
            commit('updateColor', content);
        },
        updateNew_old({commit}, content) {
            commit('updateNew_old', content);
        },
        updateIs_home({commit}, content) {
            commit('updateIs_home', content);
        },
        updateHot({commit}, content) {
            commit('updateHot', content);
        },
        setSort_order({ commit }, content) {
            commit('setSort_order', content);
        },
        setCode({ commit }, content) {
            commit('setCode', content);
        },
        setImg({commit}, content) {
            commit('setImg', content);
        },
        setImgUrl({commit}, content) {
            commit('setImgUrl', content);
        },
        setImgDesign({commit}, content) {
            commit('setImgDesign', content);
        },
        setImgDesignUrl({commit}, content) {
            commit('setImgDesignUrl', content);
        },
        setDataPrdOrigin({commit}, content) {
            commit('setDataPrdOrigin', content);
        },
        setPrimaryCategoryId({commit}, content) {
            commit('setPrimaryCategoryId', content);
        },
        setFreeship({commit}, content) {
            commit('setFreeship', content);
        },
        addVariantID({commit}, content) {
            commit('addVariantID', content);
        },
        deleteArrIDVariantAdd({commit}, content) {
            commit('deleteArrIDVariantAdd', content);
        },
        updateDonVi({commit}, content){
            commit('updateDonVi', content);
        },
        updatePromotionPercent({commit}, content){
            commit('updatePromotionPercent', content);
        }
    },
    getters: {},
};
