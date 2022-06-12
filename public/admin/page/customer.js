const orderApp = new Vue({
    el: '#showCustomerAPP',
    data: {
        api: apiURL,
        orders: [],
        user: window.user,
        listPrices: [],
    },
    mounted: async function(){
        $.get(this.api.shippings, {
            with: ['consts']
        }).then(json => {
            this.listPrices = json.data
        })
    },
    methods: {
        setPrices: function(item){
            $.post(this.api.setup, {
                shippingID: item.shippingUnitID,
                constID: item.id,
                userID: this.user.id
            }).then(json => {
                console.log(json);
            })
        }
    }
})