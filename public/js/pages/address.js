const addressAPP = new Vue({
    el: '#addressVUE',
    data: {
        api: apiURL,
        listSender: [],
        listReceiver: [],
        deletedid: '',
        editForm: {
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

        storeSender: async function(){
            $.post(this.api.push, {
                ...this.senderForm,
                type: 1,
                _token: ENV.token
            }).then(json => {
                this.listSender.push(json.data);
                $('#modalNguoiGui').modal('hide');
            });
        },

        storeReceiver: async function(){
            $.post(this.api.push, {
                ...this.receiverForm,
                type: 2,
                _token: ENV.token
            }).then(json => {
                this.listReceiver.push(json.data);
                $('#modalNguoiNhan').modal('hide');
            });
        },

        openDeletePopup: function(itemID){
            this.deletedid = itemID;
            $('#delete-item-1').modal('show');
        },

        openUpdatePopup: function(item){
            this.editForm = {... item};
            $('#edit-item-1').modal('show');
        },

        updateAddress: async function(){
            $.post(`/customers/address/update/${this.editForm.id}`, {
                ... this.editForm,
                _token: ENV.token
            }).then(json => {
                if(json.data.type == 1){
                    this.listSender = this.listSender.map(item => {
                        if(item.id == json.data.address.id){
                            return {
                                ... json.data.address
                            };
                        }
                        return item;
                    });
                }else{
                    this.listReceiver = this.listReceiver.map(item => {
                        if(item.id == json.data.address.id){
                            item = {
                                ... json.data.address
                            }
                        }
                        return item;
                    })
                }
                $('#edit-item-1').modal('hide');
            }).fail(json => {
                Swal.fire({
                    type:'warning',
                    title: 'Cảnh báo',
                    text: json.responseJSON.message
                })
            })
        },

        deleteAddress: async function(){
            $.ajax({
                url: '/customers/address/delete/' + this.deletedid,
                data: {
                    _token: ENV.token
                },
                type: 'DELETE',
                success: json => {
                    this.listSender = this.listSender.filter(item => {
                        return item.id != this.deletedid;
                    });
                    this.listReceiver = this.listReceiver.filter( item => {
                        return item.id != this.deletedid;
                    })
                },
                error: json => {
                    Swal.fire({
                        type:'warning',
                        title: 'Cảnh báo',
                        text: json.responseJSON.message
                    })
                }
            }).always(json => {
                $('#delete-item-1').modal('hide');
            })
        }
    }
})