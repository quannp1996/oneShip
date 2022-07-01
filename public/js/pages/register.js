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
            password: ''
        }
    },

    mounted: function(){
    },

    methods: {
        sendRequest: async function(){
            $.post(this.api.register, {
                email: this.form.email,
                password: this.form.password
            }).then(json => {
                console.log(json);
            })
        }
    },
})