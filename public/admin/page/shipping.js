
const baseItem = {
    weight: '',
    gia: {
        vungmien: {
            in: {
                mangra: 0,
                layhang: 0
            },
            out: {
                mangra: 0,
                layhang: 0
            },
        },
        tinh: {
            in: {
                mangra: 0,
                layhang: 0
            },
            out: {
                mangra: 0,
                layhang: 0
            },
        },
        thanh: {
            in: {
                mangra: 0,
                layhang: 0
            },
            out: {
                mangra: 0,
                layhang: 0
            },
        }
    }
}
const baseConst = {
    title: '',
    items: [],
    overweight: JSON.parse(JSON.stringify(baseItem)),
    shippingUnitID: window.shippingUnit.id,
    is_default: 0,
}
const orderApp = new Vue({
    el: '#shippingVUE',
    data: {
        apiURL: window.shippingAPI,
        shippingUnit: window.shippingUnit,
        shipping_const: window.shippingUnit.consts ?? [],
        is_adding: false,
        current_const: JSON.parse(JSON.stringify(baseConst)),
    },
    mounted: async function () {

    },
    methods: {
        openModalAdd: function () {
            this.is_adding = true;
            this.current_const = JSON.parse(JSON.stringify(baseConst));
            $('#addShippingCostModal').modal('show');
        },

        openEditModal: function (priceList) {
            this.is_adding = false;
            this.current_const = {
                ... baseConst,
                ... priceList
            };
            $('#addShippingCostModal').modal('show');
        },

        addItem: function () {
            let newConst = JSON.parse(JSON.stringify(baseItem));
            this.current_const.items.push(newConst);
        },

        deleteItem: function(index) {
            this.current_const.items.splice(index, 1);
        },

        setDefault: function(item) {

        },

        deleteConst: function (item) {
            Swal.fire({
                title: 'Bạn có chắc chắn ?',
                text: "Bạn có chắc chắn xóa bảng giá này",
                showCancelButton: true,
                confirmButtonText: 'Tiếp tục',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('/shipping_unit/shipping_const/delete/' + item.id).then(json => {
                        if (json.data.success) {
                            this.shipping_const = this.shipping_const.filter(shipping => {
                                return shipping.id != item.id
                            })
                        }
                    })
                }
            })
        },

        saveShippingConst: function () {
            $.post(this.is_adding ? this.apiURL.shipping_const : `/shipping_unit/shipping_const/update/${this.current_const.id}`, {
                ... this.current_const,
                shippingUnitID: this.shippingUnit.id
            }).then(json => {
                if (this.is_adding) {
                    this.shipping_const.push(json.data);
                } else {
                    console.log(json);
                }
                $('#addShippingCostModal').modal('hide');
            }).fail(json => {

            })
        },

        setDefault: function( id ){
            $.post(`/shipping_unit/shipping_const/set_default/${id}`).then(json => {
                console.log(json);
            }).fail(json => {

            });
        }
    }
})