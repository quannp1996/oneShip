const homeVUE = new Vue({
    el: '#home_app',
    data: {
        urlFetchData: fetchURL,
        contentData: {
            hotCategories: [],
            hotProducts: [],
            albums: [],
            newProducts: [],
            promotionProducts: [],
            hotPartner: [],
            blogs: [],
        },
        callback: {
            hotCategories: function () {
                new Swiper("#categorySwiper .mySwiper", {
                    spaceBetween: 0,
                    breakpoints: {
                        320: {
                            slidesPerView: 1,
                        },
                        576: {
                            slidesPerView: 2,
                        },
                        768: {
                            slidesPerView: 3,
                        },
                        992: {
                            slidesPerView: 4,
                        },
                        1200: {
                            slidesPerView: 5,

                        },
                    },
                    navigation: {
                        nextEl: "#categorySwiper .swiper-button-next",
                        prevEl: "#categorySwiper .swiper-button-prev",
                    },
                });
            },
            hotProducts: function () {
                getTabs('.categoryTab_hot .item', '.tab-content-list', '.tab-content', '.products-home #tab-', '.products-home');
                tabsClassActive('.categoryTab_hot .item', '.products-home');
            },
            albums: function () {
                new Swiper("#bannerGallery .mySwiper", {
                    breakpoints: {
                        320: {
                            slidesPerView: 1,
                            spaceBetween: 15,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 15,
                        },
                        1200: {
                            slidesPerView: 2,
                            spaceBetween: 30,
                        },
                    },
                    navigation: {
                        nextEl: "#bannerGallery .swiper-button-next",
                        prevEl: "#bannerGallery .swiper-button-prev",
                    },
                });
            },
            newProducts: function () {
                getTabs('.categoryTab_new .item', '.tab-content-list', '.tab-content', '.products-home #tab-', '.products-home');
                tabsClassActive('.categoryTab_new .item', '.products-home');
            },
            hotPartner: function () {
                new Swiper("#clientsSlide .mySwiper", {
                    breakpoints: {
                        320: {
                            slidesPerView: 2,
                            spaceBetween: 10
                        },
                        768: {
                            slidesPerView: 4,
                            spaceBetween: 20
                        },
                        992: {
                            slidesPerView: 5,
                            spaceBetween: 20
                        },
                        1200: {
                            slidesPerView: 6,
                            spaceBetween: 30
                        },
                    },
                    navigation: {
                        nextEl: "#clientsSlide .swiper-button-next",
                        prevEl: "#clientsSlide .swiper-button-prev",
                    },
                });
            },
            promotionProducts: function(){
                getTabs('.categoryTab_promotion .item', '.tab-content-list', '.tab-content', '.products-home #tab-', '.products-home');
                tabsClassActive('.categoryTab_promotion .item', '.products-home');
            }
        }
    },
    components: {
        product: httpVueLoader(`${BASE_URL}/template/vue_com/product.vue`),
        big_product: httpVueLoader(`${BASE_URL}/template/vue_com/big_product.vue`),
        new: httpVueLoader(`${BASE_URL}/template/vue_com/new.vue`),
    },
    mounted: function () {
        setTimeout(this.load.bind(this, 0), 0);
    },
    methods: {
        load: async function (key) {
            if (typeof Object.keys(this.urlFetchData)[key] != 'undefined') {
                const fetchURL = this.urlFetchData[Object.keys(this.urlFetchData)[key]];
                await $.get(fetchURL)
                    .then(json => {
                        this.contentData[Object.keys(this.contentData)[key]] = json.data;
                    }).fail(json => {

                    }).always(() => {
                        setTimeout(this.load.bind(this, key + 1), 0);
                    });
                typeof this.callback[Object.keys(this.contentData)[key]] == 'function'
                    &&
                    setTimeout(this.callback[Object.keys(this.contentData)[key]].call(this), 0);
            }
        },
    }
})