<div class="content-information" id="comment_VUE">
    <div class="title">
        phản hồi đánh giá sản phẩm
    </div>
    <div class="comment mt-4" v-for="item in comments" :key="item.id">
        <comment :comment="item"></comment>
    </div>
    <div class="comment-upload">
        <div class="title">
            Đánh giá của bạn
        </div>
        <div class="inrating">
            <span>Đánh giá của bạn *</span>
            <div class="star">
                <fieldset class="rating">
                    <input type="radio" id="star5" v-model="rating" name="rating" value="5" />
                    <label for="star5"></label>
                    <input type="radio" id="star4" v-model="rating" name="rating" value="4" />
                    <label for="star4"></label>
                    <input type="radio" id="star3" v-model="rating" name="rating" value="3" />
                    <label for="star3"></label>
                    <input type="radio" id="star2" v-model="rating" name="rating" value="2" />
                    <label for="star2"></label>
                    <input type="radio" id="star1" v-model="rating" name="rating" value="1" />
                    <label for="star1"></label>
                </fieldset>
            </div>
        </div>
        <div class="comment-box">
            <span class="title">Nhận xét của bạn *</span>
            <form action="">
                <textarea name="content" v-model="content" id="content" placeholder="Viết đánh giá"></textarea>
                <button class="btn-submit">
                    gửi bình luận
                </button>
            </form>
        </div>
    </div>
</div>
@push('js_bot_all')
    <script>
        const apiComment = {
            fetchURL: '{!! $fectchURL !!}',
            postComment: '{{}}',
        };
    </script>
    {!! \FunctionLib::addMedia('js/pages/comment/comment.js') !!}
@endpush
