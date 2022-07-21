const createOrderVUE = new Vue({
    el: '#createOrderVue',
    data: {
        api: window.api,
        provinces: [],
        steps: ['step1', 'step2', 'step3', 'step4'],
        currentStep: 0,
        note: '',
        reference_code: '',
        sender: {
            fullname: '',
            phone: '',
            email: '',
            address1: '',
            zipcode: '',
            address2: '',
            province_id: null,
            district_id: null,
            ward_id: null,
            zip: 0,
        },
        receiver: {
            fullname: '',
            phone: '',
            email: '',
            address1: '',
            zipcode: '',
            address2: '',
            province_id: null,
            district_id: null,
            ward_id: null,
            zip: 0,
            districts: [],
            wards: [],
        },
        package: {
            list: [{
                productCode: '',
                productName: '',
                quanlity: 1,
                price: ''
            }],
            size: {
                l: '',
                w: '',
                h: ''
            },
            weight: 0,
        },
        shipping: {
            selectedShipping: null,
            cod: '',
            services: [],
            picking_type: '',
        },
        listSender: [],
        listReceiver: [],
        listShipping: [],
        selectedShipping: '',
        error: {
            sender: {},
            receiver: {}
        },
    },

    watch: {
        
    },

    components: {
        dropdown: httpVueLoader(`${BASE_URL}/template/vue_components/dropdown.vue?v=${Math.random()}`),
        citiesdropdown: httpVueLoader(`${BASE_URL}/template/vue_components/citiesDropdown.vue?v=${Math.random()}`),
        districtdropdown: httpVueLoader(`${BASE_URL}/template/vue_components/districtDropdown.vue?v=${Math.random()}`),
        warddropdown: httpVueLoader(`${BASE_URL}/template/vue_components/wardDropdown.vue?v=${Math.random()}`),
    },

    mounted() {
        $.get(this.api.provinces).then(json => {
            this.provinces = json.data.provinces;
        })
        $.get(this.api.fetchAddress).then(json => {
            this.listSender = json.data.filter(item => {
                return item.type == 1;
            });
            this.listReceiver = json.data.filter(item => {
                return item.type == 2;
            })
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

        gotoStep: function(step){
            switch(step){
                case 'step2': 
                    return this.gotoStep2();
                case 'step3': 
                    return this.gotoStep3();
                case 'step4':
                    return this.gotoStep4();
            }
        },

        gotoStep2: function(){
            if(!this.validateFormStep1()) return false;
            this.currentStep = 1;
        },

        gotoStep3: function(){
            // if(!this.validateFormStep1()) return false;
            $.post(this.api.estimate, {
                _token: ENV.token,
                sender: this.sender,
                receiver: this.receiver,
                package: this.package
            }).then(json => {
                this.listShipping = json.data.shippings;
                this.currentStep = 2;
            })
        },

        gotoStep4: async function(){
            $.post(this.api.storeOrder, {
                _token: ENV.token,
                sender: this.sender,
                receiver: this.receiver,
                package: this.package,
                note: this.note,
                reference_code: this.reference_code,
                shipping: {
                    cod: this.shipping.cod,
                    services: this.shipping.services,
                    picking_type: '',
                    shippingID: this.selectedShipping
                }
            }).then(json => {
                Swal.fire({
                    
                })
            })
        },

        cancel: function(){
            window.location.href = this.api.cancel
        },

        validateFormStep1: function(){
            const required = ['fullname', 'phone', 'address1', 'province', 'district', 'ward'];
            this.error = {
                sender: {},
                receiver: {}
            }
            let pass = true;
            Object.keys(this.sender).forEach(item => {
                if(required.includes(item) && (this.sender[item] == '' || this.sender[item] == null)){
                    this.error.sender[item] = 'Bắt buộc';
                    pass = false;
                }
            });
            this.error.sender = {... this.error.sender};
            Object.keys(this.receiver).forEach(item => {
                if(required.includes(item) && (this.receiver[item] == '' || this.receiver[item] == null)){
                    this.error.receiver[item] = 'Bắt buộc';
                    pass = false;
                }
            });
            this.error.receiver = {... this.error.receiver};
            return pass;
        },

        addPackage: function(){
            this.package.list.push({
                productCode: '',
                productName: '',
                quanlity: 1,
                price: ''
            })
        },

        pickShipping: function(item){
            this.selectedShipping = item.id;
            this.shipping.selectedShipping = item;
        },

        selectAddress: function(item){
            if(item.type == 1){
                this.sender = {
                    ... item
                }
                $('#modalSenderAddrs').modal('hide');
            }else{
                this.receiver = {
                    ... item
                }
                $('#modalReceiverAddrs').modal('hide');
            }
        }   
    },
})