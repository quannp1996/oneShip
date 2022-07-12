const ordersApp = new Vue({
    el: '#orderAPP',
    data: {
        api: window.api,
        pagination: null,
        orders: [],
        titles: [],
        limit: 1,
        filters: {
            status: [],
            keyword: '',
            keywordType: '',
            time: '',
        }
    },
    components: {
        pagination: httpVueLoader(`${BASE_URL}/template/vue_components/pagination.vue?v=${Math.random()}`),
    },
    async mounted() {
        this.getOrders();
    },
    methods: {
        getOrders: async function(page){
            $.get(this.api.fetch, {
                limit: this.limit,
                page: page
            }).then(json => {
                this.orders = json.data,
                this.pagination = json.meta.pagination
            })
        },
    },
})