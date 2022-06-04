const newVUE = new Vue({
    el: '#new_app',
    data: {
        catIDS: IDS.split('_'),
        limit: 12,
        api: API,
        news: {
            
        },
        pagination: {

        }
    },
    mounted: function(){
        this.load(0);
    },
    components: {
        new_item: httpVueLoader(`${BASE_URL}/template/vue_com/new.vue`),
        pagination: httpVueLoader(`${BASE_URL}/template/vue_com/pagination.vue`),
    },
    methods: {
        buildTab: function(){
            getTabs('.jsEventClick-blog', '.blog-tab-content .blog-tab-item', '.blog-tab-content .blog-tab-item', '#', null)
            tabsClassActive('.jsEventClick-blog', '.blog-tab-category')
            $('.blog-tab-content .blog-tab-item').slice(0, 1).show();
            $('.blog-tab-col').first().find('.blog-tab-item').addClass('active');
        },
        load: function(key){
            if(typeof this.catIDS[key] != 'undefined'){
                $.get(`${this.api}`, {
                    cate_ids: [this.catIDS[key]],
                    limit: this.limit,
                }).then(json => {
                    this.news[this.catIDS[key]] = json.data;
                    this.pagination[this.catIDS[key]] = json.meta.pagination;
                    this.news = {... this.news};
                    this.pagination = {... this.pagination}
                }).always(() => {
                    setTimeout(this.load.bind(this, key + 1), 0);
                });
            }else{
                this.buildTab();
            }
        },
        gotoPage: function(page, index){
            $.get(`${this.api}`, {
                page: page,
                limit: this.limit,
                cate_ids: [index],
            }).then(json => {
                this.news[index] = json.data;
                this.pagination[index] = json.meta.pagination;
                this.news = {... this.news};
                this.pagination = {... this.pagination}
            })
        }
    }
})