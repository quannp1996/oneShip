const estimateVUE = new Vue({
    el: '#estimateVUE',
    data: {
        api: window.api,
        provinces: [],
        sender: {
            province: null,
            district: null,
            ward: null,
            zip: 0,
            districts: [],
            wards: [],
        },
        receiver: {
            province: null,
            district: null,
            ward: null,
            zip: 0,
            districts: [],
            wards: [],
        },
        package: {
            weight: 0
        }
    },
    
    components: {
        dropdown: httpVueLoader(`${BASE_URL}/template/vue_components/dropdown.vue?v=${Math.random()}`),
    },

    mounted() {
        $.get(this.api.provinces).then(json => {
            this.provinces = json.data.provinces;
        })
    },
    methods: {
        choseProvince: async function(item, object){
            object.province = item.code;
            await $.get(this.api.districts, {
                province_id: item.code
            }).then(json => {
                object.districts = json.data
            })
        },
        choseDistrict: async function(item, object){
            object.district = item.code;
            await $.get(this.api.wards, {
                district_id: item.code
            }).then(json => {
                object.wards = json.data
            })
        },

        choseWard: function(item, object){
            object.ward = item.code;
        },

        caculateFee: async function(){
            
        }
    },
})