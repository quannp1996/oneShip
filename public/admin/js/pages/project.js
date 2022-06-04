const projectEdit = new Vue({
    el: '#product_tab',
    data: {
        api: apiProducts,
        selected: [],
        products: [],
    },
    async mounted() {
        if(typeof window.products != 'undefined'){
            this.selected = window.products
        }
        await this.search();
    },
    methods: {
        search: function(){
            $.get(this.api, {
                name: $('#keyword').val(),
                cate_ids: $('#categories').val(),
                status: 2
            }).then( json => {
                this.products = json.data.data
            })
        },
        selectProduct: function(product){
            if(!this.selected.find(item => {
                return item.id == product.id
            })){
                this.selected.push(product);
            }else{
                const index = this.selected.findIndex(item => {
                    return item.id == product.id
                });
                this.selected.splice(index, 1);
            }
        },

        checkProduct: function(product){
            if(this.selected.length == 0) return false;
            return !! this.selected.find(item => {
                return item.id == product.id
            })
        },

        deleteProduct: function(product){
            const index = this.selected.findIndex(item => {
                return item.id == product.id
            });
            this.selected.splice(index, 1);
        }
    },
})