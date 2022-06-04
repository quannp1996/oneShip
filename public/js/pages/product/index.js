const productAPP = new Vue({
    el: "#product_app",
    data: {
        api: api,
        page: 1,
        products: null,
        filterParam: JSON.parse(filterID),
        price_sort: '',
        pagination: {},
        title: '',
        isSearching: false
    },
    mounted: function(){
        this.load(1);
    },
    components: {
        product: httpVueLoader(`${BASE_URL}/template/vue_com/product.vue`),
        paginate: httpVueLoader(`${BASE_URL}/template/vue_com/pagination.vue`),
    },
    methods: {
        load: function(page){
            this.isSearching = true;
            $.get(this.api, {
                group_filter_ids: this.filterParam,
                page: page,
                limit: 12,
                name: this.title,
            }).then(json => {
                this.isSearching = false;
                this.products = json.data;
                this.pagination = json.meta.pagination;
            });
        },

        search: function(){
            this.load(1);
        },
        
        gotoPage: function(page){
            this.load(page);
        },

        cancleSearch: function(){
            this.filterParam = JSON.parse(filterID),
            this.price_sort = '';
            this.title = '';
            this.load(1);
        }        
    }
})