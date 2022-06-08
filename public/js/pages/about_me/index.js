const homeVUE = new Vue({
    el: '#about_app__page',
    data: {
        isReading: false,
        developmentTime: JSON.parse(jsonDevelopment),
        activeIndex: 0,
        selectTab: JSON.parse(jsonDevelopment)[0],
    },
    mounted: function() {
        setTimeout(function(){
            var swiper = new Swiper("#swiperOptionsYear", {
                // slideToClickedSlide: true,
                breakpoints: {
                  320: {
                    slidesPerView: 2,
                    spaceBetween: 15
                  },
                  768: {
                    slidesPerView: 3,
                    spaceBetween: 30
                  },
                  992: {
                    slidesPerView: 4,
                    spaceBetween: 40
                  },
                  1200: {
                    slidesPerView: 5,
                    spaceBetween: 50
                  },
                  1600: {
                    slidesPerView: 6,
                    spaceBetween: 95
                  },
                },
                navigation: {
                  nextEl: ".list-item-tab .swiper-button-next",
                  prevEl: ".list-item-tab .swiper-button-prev",
                },
              });
        }, 0)
    },
    methods: {
        selecteTab: function(item, index){
            this.selectTab = item;
            this.activeIndex = index;
        }
    }
})