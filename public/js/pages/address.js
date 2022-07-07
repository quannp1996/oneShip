const addressAPP = new Vue({
    el: '#addressVUE',
    data: {
        api: apiURL,
        listSender: [],
        listReceiver: [],
        deletedID: '',
        senderForm: {
            fullname: '',
            phone: '',
            email: '',
            province_id: '',
            district_id: '',
            ward_id: '',
            village: '',
            zipcode: '',
            address1: '',
            address2: '',
            is_default: false,
        },
        receiverForm: {
            fullname: '',
            phone: '',
            email: '',
            province_id: '',
            district_id: '',
            ward_id: '',
            village: '',
            zipcode: '',
            address1: '',
            address2: '',
            is_default: false,
        }
    },
    components: {
        dropdown: httpVueLoader(`${BASE_URL}/template/vue_components/dropdown.vue?v=${Math.random()}`),
        citiesdropdown: httpVueLoader(`${BASE_URL}/template/vue_components/citiesDropdown.vue?v=${Math.random()}`),
        districtdropdown: httpVueLoader(`${BASE_URL}/template/vue_components/districtDropdown.vue?v=${Math.random()}`),
        warddropdown: httpVueLoader(`${BASE_URL}/template/vue_components/wardDropdown.vue?v=${Math.random()}`),
    },
    mounted: async function(){
        await this.load();
    },
    methods: {

        load: async function(){
            $.get(this.api.fetch, {

            }).then(json => {
                this.listSender = json.data.filter(item => {
                    return item.type == 1;
                });
                this.listReceiver = json.data.filter(item => {
                    return item.type == 2;
                })
            })
        },

        update: async function(){

        },

        storeSender: async function(){
            $.post(this.api.push, {
                ...this.senderForm,
                type: 1,
                _token: ENV.token
            }).then(json => {
                this.listSender.push(json.data);
            });
        },

        storeReceiver: async function(){
            $.post(this.api.push, {
                ...this.senderForm,
                type: 2,
                _token: ENV.token
            }).then(json => {
                this.listReceiver.push(json.data);
            });
        },

        openDeletePopup: function(itemID){
            this.deletedID = '12312312321';
            $('#delete-item-1').modal('show');
        },

        delete: async function(){

        }
    }
})