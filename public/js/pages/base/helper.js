const helperFunction = {
    numberFormatVND: new Intl.NumberFormat('vi-VN', {style: 'currency', currency: 'VND'}),
    formatVND: function (value) {
        return this.numberFormatVND.format(value);
    },
}