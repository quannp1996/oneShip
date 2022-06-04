const paymentVue = new Vue({
    el: '#payment_app',
    data: {
        helperFunction: helperFunction,
        provinces: provinces,
        districts: [],
        wards: [],
        urlApi: {
            url_api_cart_info: url_api_cart_info,
            url_api_remove_item_cart: url_api_remove_item_cart,
            url_api_update_item_cart: url_api_update_item_cart,
            url_api_sugg_prd_cart: url_api_sugg_prd_cart,
            url_api_select_item: url_api_select_item,
        },
        cart: null,
        steps: ['THÔNG TIN', 'THANH TOÁN', 'HOÀN THÀNH'],
        information: {
            billStatus: false,
            customer: {
                fullname: '',
                phone: '',
                email: '',
                address: '',
                city: '',
                district: '',
                ward: ''
            },
            bill: {
               company: '',

            }
        },
        messageErrors: {

        },
        currentStep: 0,
    },
    mounted: async function(){
        await $.get(this.urlApi.url_api_cart_info).then(json => {
            this.cart = json
        })
    },

    methods: {
        changeCity: function(event){
            this.districts = window.districts.filter(item => {
                return item.province_id == event.target.value;
            })
            this.wards = [];
        },
        changeDistrict: function(event){
            console.log(event.target.value);
            this.wards = window.wards.filter(item => {
                console.log(item.district_id);
                return item.district_id == event.target.value;
            })
        }
    }
})