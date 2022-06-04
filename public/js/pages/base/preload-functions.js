var g_freezeTimer;
let preload_functions = {
    headers: {
        'X-CSRF-TOKEN': document.getElementById('csrf-token-meta').getAttribute('content'),
        'Access-Control-Allow-Origin': '*',
        // 'X-Frame-Options': 'SAMEORIGIN',
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'Authorization': 'Bearer ' + ((accessObject) ? accessObject.access_token : '')
    },
    numberFormatVND: new Intl.NumberFormat('vi-VN', {style: 'currency', currency: 'VND'}),
    loadDataByProductId: async function (urlApi, data, configs) {
        return this.fetchData(urlApi, data, configs);
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
    addToCart: async function (urlApi, dataToCart, gotoCartPage = false) {
        return await this.pushData(urlApi, dataToCart, {method: "PUT"}).then(async function (json) {
            if (gotoCartPage) {
                window.location.href = CART_URL;
            } else {
                await preload_functions.pushAlert(window.i18n.site.themvaogiohangthanhcong);
                return await json;
            }
        }).catch(error => {
            preload_functions.detectToPushAlert(error);
        });
    },
    fetchData: async function (urlApi, data, configs = {}) {
        let configExecute = {};
        let headers = this.headers instanceof Headers ? this.headers : new Headers(this.headers);
        let url = new URL(urlApi);

        if (configs.method && configs.method == 'GET') {

            configExecute = {
                method: 'GET',
                headers: headers
            };

            if (data instanceof URLSearchParams) {
                headers.set('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
                url.search = data.toString();
            }

        } else {
            configExecute = {
                method: 'POST',
                body: JSON.stringify(data),
                headers: headers
            };
        }

        return await this.callApi(url, configExecute);
    },
    pushData: async function (urlApi, data, configs) {
        let configExecute = Object.assign({}, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: this.headers
        }, configs);
        return await this.callApi(urlApi, configExecute);
    },
    callApi: async function (urlApi, options) {
        return await fetch(urlApi, options).then(response => {
            if (response.status === 200) {
                return Promise.resolve(response.json());
            } else {
                let er = new Error(`HTTP error! status: ${response.status}`);
                console.log(er);
                return Promise.reject(response);
            }
        });
    },
    pushAlert: async function (msg = '', title = window.i18n.site.notice, options, callback, icon = "warning") {
        let configExecute = Object.assign({}, {
            title: title,
            html: msg,
            showCloseButton: true,
            icon: icon
        }, options);

        Swal.fire(configExecute).then((result) => {
            if (callback) {
                return callback(result);
            }
        });
    },
    detectToPushAlert: function (error, message = '', reload = false) {

        let alertMessage = message != '' ? message : '';

        if (error.status == 401) {
            this.pushAlert(window.i18n.site.banphaidangnhapdesudungtinhnangnay);
        } else if (error.status == 406) {
            error.json().then(json => {
                this.pushAlert(json.message, window.i18n.site.notice, {}, (reload ? () => {
                    window.location.reload();
                } : false));
            });
        } else if (error.status == 422) {
            error.json().then(json => {
                let msg = '';

                for (let key in json.errors) {
                    msg += '<br/>' + _.join(json.errors[key], "<br/>");
                }

                this.pushAlert(msg);
            });
        } else if (error.status == 419) {
            this.pushAlert(window.i18n.site.vuilongreloadtranghientai);
        } else if (error.status == 404) {
            error.json().then(json => {
                if (json.message) {
                    this.pushAlert(msg);
                } else {
                    this.pushAlert(window.i18n.site.khongtimthaydulieuphuhop);
                }
            }).catch(error => {
                this.pushAlert(window.i18n.site.khongtimthaydulieuphuhop);
            });
        }
    },
    appendStateUrl: function (key, value, override = false, reset = false) {
        if (reset == true) {
            window.history.replaceState(null, null, '?');

            return '';
        }

        let url = new URLSearchParams(window.location.search);

        if (!key || value === '') return url;

        if (key != 'page') url.delete('page');

        let onUrl = url.has(key);

        if (onUrl) {

            let arrThisFilterValues = url.get(key);
            arrThisFilterValues = arrThisFilterValues ? arrThisFilterValues.split(",") : [];

            if (arrThisFilterValues.includes(String(value))) {
                arrThisFilterValues = arrThisFilterValues.filter(function (v, k) {
                    return v != value;
                });
            } else {
                arrThisFilterValues.push(value);
            }

            if (arrThisFilterValues.length > 0) {
                url.set(key, override ? value : arrThisFilterValues.join());
            } else {
                url.delete(key);
            }

        } else {
            url.append(key, value);
        }

        window.history.replaceState(null, null, "?" + url.toString());

        return url;
    },
    returnCurrentUrlParams: function () {
        let url = new URLSearchParams(window.location.search);

        return url;
    },
    urlParamsToObject: function (urlSearch, initObject = {}, needReset = false) {
        let params = initObject;

        if (!needReset) {
            if (urlSearch instanceof URLSearchParams) {
                urlSearch.forEach(function (item, key) {
                    params[key] = item
                });
            }
        }

        return params;
    },
    goToElement: async function (elem) {
        $('html, body').animate({
            scrollTop: $(elem).offset().top
        }, 300);
    },
    convertNumber: function (value) {
        return value ? (value + '').replace(/[^0-9]/g, "") : '';
    },
    formatVND: function (value) {
        return this.numberFormatVND.format(value);
    },
    freeze: async function (callback, freezeInterval = 500) {
        clearTimeout(g_freezeTimer);
        g_freezeTimer = setTimeout(callback, freezeInterval);
    },
    isEmpty: function (object) {
        return _.isEmpty(object);
    },
    isOnScreen(elem) {
        // if the element doesn't exist, abort
        if (elem.length == 0) {
            return;
        }
        var $window = jQuery(window);
        var viewport_top = $window.scrollTop();
        var viewport_height = $window.height();
        var viewport_bottom = viewport_top + viewport_height;
        var $elem = jQuery(elem);
        var top = $elem.offset().top;
        var height = $elem.height();
        var bottom = top + height;
        var newBottom = bottom + height;
        var newTop = top - height;
        return (top >= viewport_top && top < viewport_bottom) ||
            (bottom > viewport_top && bottom <= viewport_bottom) ||
            (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom) ||
            (newBottom > viewport_top && newBottom <= viewport_bottom) ||
            (newTop >= viewport_top && newTop < viewport_bottom);
    },
    addToWishList: async function (product_id, type) {
        var data = {product_id: product_id, type: type};
        return await this.pushData(url_api_add_wish, data, {method: "PUT"}).then(async function (json) {
            $('#icon-' + product_id).removeClass(json.is_add ? 'icons-heart' : 'icons-heart-active').addClass(json.is_add ? 'icons-heart-active' : 'icons-heart');
        }).catch(error => {
            preload_functions.detectToPushAlert(error);
        });
    },
};