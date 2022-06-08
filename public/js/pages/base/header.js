
let header = new Vue({
    el: '#header',
    data: {
        url_cart_number: url_cart_number,
        isActive: true,
        isActiveSub: 0,
        menu_current: 0,
        isScrolled: false,
        isWatching: false,
        showModal: false,
        fieldType: 'password',
        modalname: false,
        modal: '',
        number_cart: 0,
        dataProfile: {
            customer: [],
            province: [],
            district: [],
            ward: [],
        },
    },
    methods: {
        toggleHeaderSearch() {
            this.isActive = !this.isActive;
        },
        toggleMenuSubProduct(id) {
            this.isActiveSub = id;
            this.menu_current = id;
        },
        headerScrollSticky() {
            if (window.scrollY) this.isScrolled = true;
            else this.isScrolled = false;
        },
        modalEmit(modalname) {
            this.showModal = modalname;
        },
        modalHide() {
            this.modal = false;
        },
        closeModal({currentTarget, target}) {
            if (currentTarget === target) this.modal = false;
        },
        btnCloseModal() {
            this.modal = false;
        },
        openModalLogin() {
            this.$emit('modal-login');
        },
        openModalSuccess() {
            this.$emit('modal-success');
        },
        switchVisibility() {
            this.fieldType = this.fieldType === 'password' ? 'text' : 'password';
            this.isWatching = !this.isWatching;
        },
        showModalFunciton(event, dom) {
            this.modal = dom;
            this.showModal = true;
        },
        showModalWithDataFunction(event, dom, url_load) {
            if (typeof url_load !== undefined && typeof url_load !== 'undefined') ;
            {
                this.loadDataPopup(event, url_load)
            }
            this.showModalFunciton(event, dom);
        },
        formatDateUS(date) {
            const options = {year: 'numeric', month: 'numeric', day: 'numeric'}
            return new Date(date).toLocaleDateString('en-US', options)
        },
        loadDataPopup: async function (event, url) {
            await $.get(url)
                .then(json => {
                    this.dataProfile = json.data;
                }).fail(json => {
                }).always(() => {
                });
        },
        loadData: async function (event, url, dom) {
            var value = event.target.value;
            url = url + '&value=' + value;
            $('#popup-update-customer span.error-message').empty();
            this.dataProfile[dom] = [];
            await $.get(url).then(json => {
                this.dataProfile[dom] = json.data.data
            });
        },
        getCartNumber: function () {
            $.get(url_cart_number).then(json => {
                this.number_cart = json.data
            });
        },
        loadPopup: function (event, dom, url, holder, type = 'modal', popup_holder = '', modal_holder = '') {
            this.showModalFunciton(event, dom);
            $(popup_holder).empty();
            $.getJSON(url, function (result) {
                var data = "";
                if (typeof result.data !== 'undefined') data = result.data;
                $(holder).empty().html(data);
            });
            $(document).ajaxStop(function () {
                if (type != undefined) {
                    switch (type) {
                        case "modal":
                            break;
                        case "popup":
                            $(popup_holder).fadeIn();
                            $(popup_holder).find(".popup").addClass("opened");
                            $(popup_holder).find(".popup-content").addClass("active");
                            break;
                    }
                }
            });
        },
        registerActionClick: function (event, url) {
            event.preventDefault();
            var form = $('#popup-register');
            var data = $(form).serializeArray();
            var fd = new FormData();
            if (data.length > 0) {
                $.each(data, function (key, value) {
                    fd.append(value.name, value.value);
                })
            }
            $('#popup-register input').removeAttr('style').addClass('reverse');
            $('#popup-register textarea').removeAttr('style').addClass('reverse');

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
                            $('#popup-register span.error-message').empty();
                            $.each(json.errors, function (key, val) {
                                $('#popup-register #' + key).removeClass('reverse').css('border-bottom', '1px solid red');
                                $('#popup-register #' + key + '_error').html(val[0]).css('display', 'block')
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

                            $('#popup-register span.error-message').empty();
                            $('#popup-register input[type="text"]').val('');
                            $('#popup-register input[type="password"]').val('');
                            $('#popup-register textarea').val('');
                            $('#popup-register .text-danger').empty();

                        }

                    }
                },
                beforeSend: function () {

                }
            }).done(function (json) {
                header.modalHide();
                header.showModalFunciton(event, 'register-success');
            });
        },
        loginActionClick: function (url) {
            var form = $('#popup-login');
            var data = $(form).serializeArray();
            var fd = new FormData();
            if (data.length > 0) {
                $.each(data, function (key, value) {
                    fd.append(value.name, value.value);
                })
            }
            fd.append('type', 'home');

            $('#popup-login input').removeAttr('style').addClass('reverse');
            $('#popup-login textarea').removeAttr('style').addClass('reverse');
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
                            $('#popup-login span.error-message').empty();
                            $.each(json.errors, function (key, val) {
                                $('#popup-login #' + key).removeClass('reverse').css('border-bottom', '1px solid red');
                                $('#popup-login #' + key + '_error').html(val[0]).css('display', 'block')
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
                            $('#popup-login span.error-message').empty();
                            $('#popup-login input[type="text"]').val('');
                            $('#popup-login textarea').val('');
                            $('#popup-login .text-danger').empty();

                            shop.redirect(response.data.url)
                        }

                    }
                },
                beforeSend: function () {

                }
            }).done(function (json) {

            });
        },
        changepassActionClick: function (url) {
            var form = $('#change-password-page');
            var data = $(form).serializeArray();
            var fd = new FormData();
            if (data.length > 0) {
                $.each(data, function (key, value) {
                    fd.append(value.name, value.value);
                })
            }
            $('#change-password-page input').removeAttr('style').addClass('reverse');
            $('#change-password-page textarea').removeAttr('style').addClass('reverse');
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
                            $('#change-password-page span.error-message').empty();
                            $.each(json.errors, function (key, val) {
                                $('#change-password-page #' + key).removeClass('reverse').css('border-bottom', '1px solid red');
                                $('#change-password-page #' + key + '_error').html(val[0]).css('display', 'block')
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
                            $('#change-password-page span.error-message').empty();
                            $('#change-password-page input[type="password"]').val('');
                            $('#change-password-page input[type="text"]').val('');
                        }

                    }
                },
                beforeSend: function () {

                }
            }).done(function (json) {
                header.modalHide();
                Swal.fire(
                    json.data.title,
                    json.data.mess,
                    'success'
                )
            });
        },
        changeProfileActionClick: function (url) {
            var form = $('#popup-update-customer');
            var data = $(form).serializeArray();
            var fd = new FormData();
            if (data.length > 0) {
                $.each(data, function (key, value) {
                    fd.append(value.name, value.value);
                })
            }
            $('#popup-update-customer input').removeAttr('style').addClass('reverse');
            $('#popup-update-customer textarea').removeAttr('style').addClass('reverse');
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
                            $('#popup-update-customer span.error-message').empty();
                            $.each(json.errors, function (key, val) {
                                $('#popup-update-customer #' + key).removeClass('reverse').css('border-bottom', '1px solid red');
                                $('#popup-update-customer #' + key + '_error').html(val[0]).css('display', 'block')
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
                            $('#popup-update-customer input[type="text"]').val('');
                            $('#popup-update-customer textarea').val('');
                            $('#popup-update-customer .text-danger').empty();
                        }

                    }
                },
                beforeSend: function () {

                }
            }).done(function (json) {
                header.modalHide()
                Swal.fire(
                    json.data.title,
                    json.data.mess,
                    'success'
                )
            });
        },
        updateAvatarActionChange: function (e, url) {
            var files = e.target.files || e.dataTransfer.files;
            var fd = new FormData();
            fd.append('avatar', files[0]);
            fd.append('_token', ENV.token);

            $.ajax({
                type: 'POST',
                url: url,
                data: fd,
                contentType: false,
                processData: false,
                statusCode: {
                    422: function (response) {
                        var json = JSON.parse(response.responseText);
                        if (json) {

                            $.each(json.errors, function (key, val) {
                                Swal.fire(
                                    'Thất bại',
                                    val[0],
                                    'error'
                                )
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
                            // Swal.fire(
                            //     response.data.title,
                            //     response.data.mess,
                            //     'success'
                            // )
                            // shop.reload();
                        }

                    }
                },
                beforeSend: function () {

                }
            }).done(function (json) {
                header.modalHide();
                Swal.fire(
                    json.data.title,
                    json.data.mess,
                    'success'
                )
            });
        },
        forgotPasswordActionClick: function (e, url) {
            var form = $('#popup-reset-password');
            var data = $(form).serializeArray();
            var fd = new FormData();
            if (data.length > 0) {
                $.each(data, function (key, value) {
                    fd.append(value.name, value.value);
                })
            }
            $('#popup-reset-password input').removeAttr('style').addClass('reverse');
            $('#popup-reset-password textarea').removeAttr('style').addClass('reverse');
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
                            $('#popup-reset-password span.error-message').empty();
                            $.each(json.errors, function (key, val) {
                                $('#popup-reset-password #' + key).removeClass('reverse').css('border-bottom', '1px solid red');
                                $('#popup-reset-password #' + key + '_error').html(val[0]).css('display', 'block')
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
                            $('#popup-reset-password span.error-message').empty();
                            $('#popup-reset-password input[type="text"]').val('');
                            $('#popup-reset-password textarea').val('');
                            $('#popup-reset-password .text-danger').empty();
                        }

                    }
                },
                beforeSend: function () {

                }
            }).done(function (json) {
                header.modalHide();
                header.showModalFunciton(e, 'forgot-success');
            });
        },
        searchData: function (e, url, dom) {
            var key = $(dom).val();
            url = url + '?key=' + key
            $.getJSON(url, function (result) {
                if (result.error == 0) {
                    shop.redirect(result.data.url)
                } else {
                    Swal.fire(
                        'Error !!!',
                        json.code.mess,
                        'error'
                    )
                }
            });
        }
    },
    mounted() {
        this.getCartNumber();
        window.addEventListener('scroll', this.headerScrollSticky);


    },

});

