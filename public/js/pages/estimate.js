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
        package_weight: ''
    },
    mounted() {
        $.get(this.api.provinces).then(json => {
            this.provinces = json.data.provinces;
        })
    },
    methods: {
        choseProvince: async function(item, object){
            object.province = item;
            await $.get(this.api.districts, {
                province_id: item.code
            }).then(json => {
                console.log(json);
            })
        },
        choseDistrict: function(item, object){
            object.district = item;
        },
        choseWard: function(item, object){
            object.ward = item;
        },
    },
})