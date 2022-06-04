let app_api_footer_subscriber = new Vue({
    el: '#footerSaveSubscriber',
    data: {
        url_api_footer_subscriber: url_api_footer_subscriber,
        info: {
            regiter_email: ''
        },
        isSaving: false,
    },
    methods: {
        footerSaveSubscriber(evt) {
            app_api_footer_subscriber.isSaving = true;
            $.ajax({
                url: url_api_footer_subscriber,
                type: "POST",
                data: app_api_footer_subscriber.info,
                statusCode: {
                    422: function (response) {
                        var json = JSON.parse(response.responseText);
                        if (json) {
                            $('#regiter_email_footer span.error-message').empty();
                            $.each(json.errors, function(key, val) {
                                $('#regiter_email_footer #' + key).removeClass('reverse').css('border-bottom', '1px solid red' );
                                $('#regiter_email_footer #' + key + '_error').html(val[0]).css('display', 'block')
                            });
                        }
                    },
                },
                success: function (jsonData) {
                    if (jsonData.success) {
                        app_api_footer_subscriber.info = {};
                        return Swal.fire({
                            title: noti.notice,
                            html: jsonData.message,
                            showCloseButton: true,
                            icon: "success"
                        });

                    }
                }
            }).always(function () {
                app_api_footer_subscriber.isSaving = false;
            });
        }
    }
});