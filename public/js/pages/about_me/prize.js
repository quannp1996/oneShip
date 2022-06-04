const prizeVUE = new Vue({
  el: '#prize_app__page',
  data: {
    fetchURL: api,
    prizes: [],
    pagination: null,
  },
  components: {
    "box-app": httpVueLoader(`${BASE_URL}/template/vue_com/box-app.vue`),
  },
  mounted: async function () {
      await this.load();
      this.buildSwiper();
  },

  methods: {
    load: async function(page = 1){
      await $.get(this.fetchURL, {
        page: page
      }).then(json => {
        this.prizes = this.prizes.concat(json.data);
        this.pagination = json.meta.pagination;
      });
    },
    loadMore: async function(){
        await this.load(this.pagination.current_page + 1);
        this.buildSwiper();
    },
    buildSwiper: function(){
      setTimeout(() => {
        this.prizes.forEach(item => {
          new Swiper(`.mySwiper_${item.id}`, {
            breakpoints: {
              320: {
                slidesPerView: 1,
                spaceBetween: 10
              }, 
              768: {
                slidesPerView: 2,
                spaceBetween: 20
              },
              992: {
                slidesPerView: 3,
                spaceBetween: 20
              },
              1200: {
                slidesPerView: 4,
                spaceBetween: 30
              },
            },
            navigation: {
              nextEl: `#swiperProducts_${item.id} .swiper-button-next`,
              prevEl: `#swiperProducts_${item.id} .swiper-button-prev`,
            },
          });
        });
      }, 100)
    }
  }
})