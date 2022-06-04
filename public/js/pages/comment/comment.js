const commentApp = new Vue({
    el: '#comment_VUE',
    data: {
        limit: 4,
        api: apiComment,
        me: false,
        rating: 0,
        comments: [],
        content: '',
        pagination: null,
    },
    components: {
        comment: httpVueLoader(`${BASE_URL}/template/vue_com/comment.vue`),
    },
    mounted: async function () {
        if(this.api.authentication){
            $.get(this.api.authentication).then(json => {
                this.me = json.data.login;
            })
        }
        this.loadComment();
    },
    methods: {

        loadComment: async function(page = 1){
            $.get(this.api.fetchURL, {
                page: page,
                limit: this.limit
            }).then(json => {
                this.comments = json.data;
                this.pagination = json.meta.pagination;
            })
        },

        focusInput: function (event) {
            if (!this.me && $('#loginModal').length) $('#loginModal').modal();
            return false;
        },

        postComment: function () {
            this.postError = '';
            if (!this.me) return this.focusInput();
            $.post(this.api.postURL, {
                content: this.content,
                type: this.objectType,
                object_id: this.objectID,
                _token: ENV.token
            }).then(json => {
                Swal.fire({
                    icon: 'success',
                    title: json.data.level,
                    text: json.message,
                });
                this.content = '';
                return false;
            }).fail(json => {
                this.postError = json.responseJSON.errors.content[0]
            })
        },

        toggleReplyForm: function (item) {
            item.reply.show_form = !item.reply.show_form;
        },

        bindClassActive: function (item) {
            return item.liked ? 'link-like active mr-2' : 'link-like mr-2'
        }
    }
})