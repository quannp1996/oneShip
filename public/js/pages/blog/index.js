const blogApp = new Vue({
    el: '#blog_category__app',
    data:{
        api: api,
        news: [],
        pagination: null,
    },
    mounted: async function(){
        this.load()
    },
    components:{
        article_horizontal: httpVueLoader(`${BASE_URL}/template/vue_com/article_horizontal.vue`),
        pagination: httpVueLoader(`${BASE_URL}/template/vue_com/pagination.vue`),
    },
    methods: {
        load: function(page = 1){
            $.get(api, {
                page: page
            }).then(json => {
                this.news = json.data;
                this.pagination = json.meta.pagination;
            })
        },
        goToPage: function(page = 1){
            this.load(page);
        }
    }
})