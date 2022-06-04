const app_cart = new Vue({
    el: '#cart_app',
    data: {
        helperFunction: helperFunction,
        urlApi: {
            url_api_cart_info: url_api_cart_info,
            url_api_remove_item_cart: url_api_remove_item_cart,
            url_api_update_item_cart: url_api_update_item_cart,
            url_api_sugg_prd_cart: url_api_sugg_prd_cart,
            url_api_select_item: url_api_select_item,
        },
        numberFormatVND: new Intl.NumberFormat('vi-VN', {style: 'currency', currency: 'VND'}),
        url_router_checkout: url_router_checkout,
        suggestProducts: {},
        cart: null,
        isLoading: true,
        isCheckeAll: false,
    },
    async beforeMount() {
        await this.loadCart();
    },
    async mounted() {
        
    },
    computed: {

    },
    watch: {
        cart: {
            handler(after, before) {
                this.reCalc();
            },
            deep: true,
        },
    },
    methods: {
        
        submitWhenUpdated:function () {
            setTimeout(function () {
                window.location.href = this.url_router_checkout;
            },1000)
        },
        loading: function() {
            this.isLoading = true;
        },
        loaded: function() {
            this.isLoading = false;
        },
        goTopProductList: function() {
            this.preload.goToElement($('#box-product-listing'));
        },
        formatVND: function(value) {
            return this.numberFormatVND.format(parseFloat(value));
        },
        // loadSuggestProduct: async function() {
        //     this.loading();
        //     await this.preload.fetchData(
        //         this.urlApi.url_api_sugg_prd_cart, {}, { method: 'GET' },
        //     ).then((json) => {
        //         this.suggestProducts = json;
        //         this.loaded();
        //     }).catch((error) => {
        //     this.loaded();
        //     });

        //     if (this.suggestProducts.products) {
        //         lazyloader = new LazyLoad({
        //             elements: '.lazy',
        //         });
        //     }
        // },
        loadCart: async function() {
            this.loading();
            await $.get(this.urlApi.url_api_cart_info).then(json => {
                this.cart = json
            })
            this.loaded();
        },
        removeItem: async function(item) {
            Swal.fire({
                title: 'Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Chắc chắn',
                denyButtonText: `Hủy`,
            }).then((result) => {
                if (typeof result.value != 'undefined') {
                    $.ajax({
                        url: this.urlApi.url_api_remove_item_cart,
                        type: "PUT",
                        data: { itemId: item.rowId, productId: item.id, variantId: item.variantId },
                        success: json => {
                            this.cart = json;
                            $('.accessories-header .cart-header span.card_items').text(this.cart.count_selected)
                        },
                        errors: josn => {

                        }
                    }).always(json => {

                    })
                }
            });
        },
        updateItem: async function(item) {
            this.loading();
            $.ajax({
                url: this.urlApi.url_api_update_item_cart,
                type: 'PUT',
                data: { itemId: item.rowId, productId: item.id, variantId: item.variantId, quantity: item.quantity },
                success: json => {
                    this.cart = json;
                    this.loaded();
                },
                errors: json =>{

                }
            }).always(json => {
                this.loaded();
            })
        },

        freeze: async function (callback, freezeInterval = 500) {
            clearTimeout(window.g_freezeTimer);
            window.g_freezeTimer = setTimeout(callback, freezeInterval);
        },

        changeQuantity: async function(item, step = 1) {
            this.loading();
            if (item.quantity > 1 || (item.quantity > 0 && step >= 0)) {
                item.quantity = parseInt(item.quantity);

                await (item.quantity += parseInt(step));

                this.freeze(() => {
                    this.updateItem(item);
                });
                this.loaded();
            } else {
                const result = await this.removeItem(item);
                if (!result) {
                    item.quantity = 1;
                    this.freeze(() => {
                        this.updateItem(item);
                    });
                }
                this.loaded();
            }
        },
        selectedItem: async function(item) {
            const data = {
                items: [],
            };

            if (item instanceof Array) {
                item.forEach((element) => {
                    data.items.push({
                        itemId: element.rowId,
                        productId: element.id,
                        variantId: element.variantId,
                        selected: element.selected,
                    });
                });
            } else {
                item.selected = !item.selected;
                data.items.push({ itemId: item.rowId, productId: item.id, variantId: item.variantId, selected: item.selected });
            }

            if (data.items.length > 0) {
                this.preload.freeze(() => {
                    this.preload.pushData(
                        this.urlApi.url_api_select_item,
                        data, { method: 'PUT' },
                    ).then((json) => {
                        this.cart = json;
                    }).catch((error) => {
                        this.preload.detectToPushAlert(error);
                    });
                });
            }
        },
        wishlistItem: function() {

        },
        reCalc: function() {
            let sub_total = 0;
            let count_selected = 0;

            for (element in this.cart.items) {
                if (this.cart.items[element].selected && this.cart.items[element].quantity > 0) {
                    sub_total += this.cart.items[element].quantity * this.cart.items[element].price;
                    count_selected++;
                }
            };

            this.cart.sub_total = sub_total;
            this.cart.count_selected = count_selected;
        },
        unSelectedAll: async function(event) {
            event.preventDefault();

            this.isCheckeAll = false;
            const arrSelected = [];
            for (element in this.cart.items) {
                if (this.cart.items[element].selected == true) {
                    this.cart.items[element].selected = false;
                    arrSelected.push(this.cart.items[element]);
                }
            }
            this.selectedItem(arrSelected);
        },
        selectAll: function(event) {
            // event.preventDefault();

            this.isCheckeAll = true;
            const arrSelected = [];
            for (element in this.cart.items) {
                if (this.cart.items[element].selected == false) {
                    this.cart.items[element].selected = true;
                    arrSelected.push(this.cart.items[element]);
                }
            }
            this.selectedItem(arrSelected);
        },
        handleInput(item, e) {
            item.quantity=e.target.value.replace(/[^\d]/g, '');
        },
    },
});