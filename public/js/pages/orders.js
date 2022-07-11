const ordersApp = new Vue({
    el: '#orderAPP',
    data: {
        api: window.api,
        pagination: null,
        orders: [],
        titles: [],
        filters: {
            status: [],
            keyword: '',
            keywordType: '',
            time: '',
        }
    },
    async mounted() {
        this.getOrders();
    },
    methods: {
        getOrders: async function(){
            $.get(this.api.fetch, {}).then(json => {
                this.orders = json.data
            })
        }
    },
})