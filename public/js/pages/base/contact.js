let app_contact = new Vue({
    el: '#page-contact',
    data: {
        url_api_save_contact: url_api_save_contact,
        info: {
            name: '',
            address: '',
            phone: '',
            email: '',
            message: '',
            _token: ENV.token,
        },
        isSaving: false,
    },
    methods: {
        saveContact() {
            app_contact.isSaving = true;
            $.ajax({
                url: this.url_api_save_contact,
                type: "POST",
                data: app_contact.info,
                statusCode: {
                    422: function (response) {
                        const bugs = response.responseJSON.errors;
                        let html = '';
                        Object.keys(bugs).forEach(element => {
                            html += bugs[element][0] + '<BR>';
                        });
                        return Swal.fire({
                            title: window.i18n.site.notice,
                            html: html,
                            showCloseButton: true,
                            icon: "warning"
                        });
                    },
                },
                success: function (jsonData) {
                    if (jsonData.success) {
                        app_contact.info = {};
                        return Swal.fire({
                            title: window.i18n.site.thanhcong,
                            html: jsonData.message,
                            showCloseButton: true,
                            icon: "success"
                        });
                    }
                },
            }).always(function () {
                app_contact.isSaving = false;
            });
        }
    }
});