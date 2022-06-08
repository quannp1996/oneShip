var main = new Vue({
    el: '#main_information',
    data() {
        return {
            api: api,
            refreshOption: [],
            options: [],
            counter: 1,
            variants: [],
            variantsOption: [],
            optionSelected: {},
            product: product,
            numberFormatVND: new Intl.NumberFormat('vi-VN', {style: 'currency', currency: 'VND'}),
        }
    },

    methods: {
        modalHide() {
            this.showModal = false;
        },
        formatVND: function (value) {
            return this.numberFormatVND.format(value);
        },
        toggle: function (toggle) {
            if (toggle === 'document') {
                this.isActive_doc = !this.isActive_doc;
                if (this.toggle_doc == toggle) {
                    this.toggle_doc = '';
                } else {
                    this.toggle_doc = toggle;
                }
            }
            if (toggle === 'technology') {
                this.isActive_tech = !this.isActive_tech;
                if (this.toggle_tech == toggle) {
                    this.toggle_tech = '';
                } else {
                    this.toggle_tech = toggle;
                }
            }
        },
        increment() {
            this.counter++;
        },
        decrement() {
            if (this.counter > 1) this.counter--;
        },
        onlyNumber($event) {
            let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 is dot
                $event.preventDefault();
            }
        },
        showModalFunciton(dom) {
            this.text = text
            this.modal = dom;
            this.showModal = true;
        },
        closeModal({
            currentTarget,
            target
        }) {
            this.modal = '';
            this.showModal = false;
        },
        loadDataRate: function (url) {
            $.get(url).then(json => {
                this.rate = json.data.data
            });
        },
        updateEvaluteFormActionClick: function (url, product_id) {
            var form = $('#evaluate-form');
            var data = $(form).serializeArray();
            var fd = new FormData();
            if (data.length > 0) {
                $.each(data, function (key, value) {
                    fd.append(value.name, value.value);
                })
            }
            fd.append('product_id', product_id);
            $('#evaluate-form input').removeAttr('style').addClass('reverse');
            $('#evaluate-form textarea').removeAttr('style').addClass('reverse');
            $.ajax({
                type: 'POST',
                url: url,
                data: fd,
                // dataType: 'html',
                contentType: false,
                processData: false,
                statusCode: {
                    422: function (response) {
                        var json = JSON.parse(response.responseText);
                        if (json) {
                            $('#evaluate-form span.error-message').empty();
                            $.each(json.errors, function (key, val) {
                                $('#evaluate-form #' + key).removeClass('reverse')
                                    .css('border-bottom', '1px solid red');
                                $('#evaluate-form #' + key + '_error').html(val[0])
                                    .css('display', 'block')
                            });
                        }
                    },
                    200: function (response) {
                        if (response.error === 1) {
                            Swal.fire(
                                response.data.title,
                                response.data.mess,
                                'error'
                            )
                        } else {
                            $('input[name="star_evalute"]').prop('checked', false).change();
                            $('#evaluate-form input[type="radio"]').attr('checked', false);
                            $('#evaluate-form input[type="text"]').val('');
                            $('#evaluate-form textarea').val('');
                            $('#evaluate-form .text-danger').empty();
                        }

                    }
                },
                beforeSend: function () {

                }
            }).done(function (json) {
                if (json.error === 1) {
                    Swal.fire(
                        json.code.title,
                        json.code.mess,
                        'error'
                    )
                } else {
                    Swal.fire(
                        json.data.title,
                        json.data.mess,
                        'success'
                    )
                }
            });
        },
        addCart: function () {
            const variant = this.variants.filter(item => {
                return eval(item.product_option_values.join('+')) == eval(Object.values(this.optionSelected).join('+'));
            })
            $.ajax({
                url: this.api.addCart,
                type: 'PUT',
                data: {
                    product_id: this.product.id,
                    product_variant_id: variant[0].product_variant_id,
                    product_quantity: this.counter
                },
                success: json => {
                    $('#addtoCart').modal();
                    $('.accessories-header .cart-header span.card_items').text(json.data.count_items);
                },
                erros: json => {

                }
            });
        },
        uniqueOptions: async function (options) {
            let options_unique = JSON.parse(JSON.stringify(options));
            options_unique.forEach(element => {
                let flags = [],
                    output = [],
                    l = element.product_option_values.data.length,
                    i;
                for (i = 0; i < l; i++) {
                    if (flags[element.product_option_values.data[i].option_value_id]) continue;
                    flags[element.product_option_values.data[i].option_value_id] = true;
                    element.product_option_values.data[i].disabled = false;
                    element.product_option_values.data[i].checked = false;
                    output.push(element.product_option_values.data[i]);
                }
                element.product_option_values.data = output;
            });
            return options_unique;
        },
        selectedOption: function (optionID, $event) {
            this.optionSelected[optionID] = +$event.target.value;
            let optionSelected = Object.values(this.optionSelected).filter(item => {
                return item > 0
            });
            if (!optionSelected.length) this.reset();
            const canVariant = this.variantsOption.filter(optionArr => {
                return optionSelected.every(el => optionArr.includes(el));
            })
            this.options.map(option => {
                option.product_option_values.map(optionValue => {
                    if (optionSelected.indexOf(optionValue.option_value_id) >= 0 || optionValue.option_id == optionID) return;
                    optionValue.disabled = (
                        canVariant.filter(variant => {
                            return variant.indexOf(optionValue.option_value_id) >= 0;
                        }).length <= 0
                    )
                })
            })
        },

        reset: function (resetCounter = false) {
            this.options.map(option => {
                option.product_option_values.map(optionValue => {
                    optionValue.disabled = false;
                })
            })
            Object.keys(this.optionSelected).map(key => {
                this.optionSelected[key] = 0
            });
            resetCounter && (this.counter = 1);
        },
    },

    async mounted() {

        await $.get(this.api.options).then(json => {
            this.uniqueOptions(json.data).then(items => {
                const options = items.map(item => {
                    this.optionSelected[item.option_id] = 0;
                    return {
                        ...item,
                        product_option_values: item.product_option_values.data
                    }
                })
                this.options = options;
                this.refreshOption = [...options];
            });
        });

        await $.get(this.api.variants).then(json => {
            this.variants = json.data.map(item => {
                this.variantsOption.push(item.product_option_values.data.map(option => {
                    return option.option_value_id
                }));
                return {
                    ...item,
                    product_option_values: item.product_option_values.data.map(option => {
                        return option.option_value_id
                    })
                };
            })
        });
    },
});