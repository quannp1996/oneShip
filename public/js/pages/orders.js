const ordersApp = new Vue({
    el: '#orderAPP',
    data: {
        api: window.api,
        orders: [],
        titles: [],
        filters: []
    },
    async mounted() {
        this.getOrders();
    },
    methods: {
        getOrders: async function(){
            $.get(this.api.fetch, {}).then(josn => {
                
            })
        }
    },
})