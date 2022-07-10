const registerVUE = new Vue({
    el: '#registerVUE',
    data: {
        api: api,
        form: {
            email: '',
            password: '',
            accpect: false,
        },
        errors: {
            email: '',
            password: '',
            accpect: ''
        }
    },

    mounted: function(){
    },

    methods: {
        sendRegister: async function(){
            console.log(this.form.accpect);
            if (!this.form.accpect) return this.errors.accpect = 'Bạn phải chấp nhận với các điều khoản';
            $.post(this.api.register, {
                _token: ENV.token,
                email: this.form.email,
                password: this.form.password
            }).then(json => {
                if (json.code == 200) return location.href = '/login';
            }).fail(json => {
                console.log(json);
            })
        }
    },
})