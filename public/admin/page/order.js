const orderApp = new Vue({
    el: '#orderApp',
    data: {
        api: window.apiURL,
        user: null,
        users: [],
        shippings: [],
        status: '',
        sender: {
            fullname: '',
            phone: '',
            email: '',
            city: 0,
            district: 0,
            ward: 0,
            zipcode: '',
            address1: '',
            address2: ''
        },
        cities: window.provinces,
        districts: {
            sender: [],
            receiver: [], 
        },
        wards: {
            sender: [],
            receiver: [],
        },
        receiver: {
            fullname: '',
            phone: '',
            email: '',
            city: 0,
            district: 0,
            ward: 0,
            zipcode: '',
            address1: '',
            address2: ''
        },
        packages: [{
            code: '',
            product: '',
            quanlity: '',
            price: ''
        }],
        package: {
            weight: '',
            ref_code: '',
            note: ''
        },
        listSender: [],
        listReceiver: [],
        filter: {
            user: '',
        },
        shippingData: {
            shipping: 0,
            fee: 0,
            cod: 0,
            shipping_type: 0
        }
    },
    watch: {
        async 'shippingData.shipping' (newValue){
            await this.caculateFee(newValue);
        }
    },
    mounted: async function(){
        this.loadUser();
        this.loadShipping();
    },
    methods: {
        loadUser: async function() {
            $.get(this.api.users, {
                keyword: this.filter.user
            }).then(json => {
                this.users = json.data
            })
        },

        loadShipping: async function()
        {
            $.get(this.api.shipping).then(json => {
                this.shippings = json.data;
            });
        },

        addNewPackge: function(){
            this.packages.push({});
        },

        removePackage: function(key){
            this.packages = this.packages.splice(1, key);
        },
        
        selectUser: function(user)
        {
            this.user = user; 
            $('#userModel').modal('hide');
        },

        changeCity: function(object = 'sender')
        {
            this.wards[object] = [];
            console.log(window.districts.filter(item => {
                return item.province_id == this[object].city;
            }));
            this.districts[object] = window.districts.filter(item => {
                return item.province_id == this[object].city;
            });
        },

        changeDistrict: function(object = 'sender')
        {
            this.wards[object] = window.wards.filter(item => {
                return item.district_id == this[object].district;
            });
        },

        openModalUser: function()
        {
            this.loadUser();
            $('#userModel').modal('show');
        },

        submitForm: function(event)
        {
            const url = event.target.action;
            $.post(url, {
                _token: ENV.token,
                customer_id: this.user.id,
                sender: this.sender,
                receiver: this.receiver,
                shipping: this.shippingData.shipping,
                shipping_type: this.shippingData.shipping_type,
                package: {
                    ... this.package,
                    items: {
                        ... this.packages
                    }
                },
            }).then(json => {

            }).fail(json => {

            })
        },

        caculateFee: async function(shippingID){
            console.log(this.api.caculate);
            $.get(this.api.caculate, {
                userID: this.user.id,
                shippingID: shippingID,
                package: {
                    weight: this.package.weight
                },
                sender: {
                    province: this.sender.city,
                    district: this.sender.district,
                    ward: this.sender.ward,
                },
                receiver: {
                    province: this.receiver.city,
                    district: this.receiver.district,
                    ward: this.receiver.ward,
                }
            }).then(json => {
                this.shippingData.fee = json.data.fee
            })
        }
    }
})