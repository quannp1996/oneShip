<template>
    <div class="row">
            <div class="col-sm-9">
                <table class="table table-bordered table-hover mb-0">
                    <thead>
                    <tr>
                        <th width="30%">Thuộc tính</th>
                        <th width="65%">Giá trị</th>
                        <th width="65%">Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" v-model></td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
</template>

<script>
    import tinymce from 'tinymce/tinymce';
    import Editor from '@tinymce/tinymce-vue';
    import 'tinymce/themes/silver';
    import 'tinymce/plugins/image';
    import 'tinymce/plugins/media';
    import 'tinymce/plugins/table';
    import 'tinymce/plugins/lists';
    import 'tinymce/plugins/advlist';
    import 'tinymce/plugins/link';
    import 'tinymce/plugins/autolink';
    import 'tinymce/plugins/lists';
    import 'tinymce/plugins/link';
    import 'tinymce/plugins/image';
    import 'tinymce/plugins/charmap';
    import 'tinymce/plugins/searchreplace';
    import 'tinymce/plugins/visualblocks';
    import 'tinymce/plugins/code';
    import 'tinymce/plugins/fullscreen';
    import 'tinymce/plugins/print';
    import 'tinymce/plugins/preview';
    import 'tinymce/plugins/anchor';
    import 'tinymce/plugins/insertdatetime';
    import 'tinymce/plugins/media';
    import 'tinymce/plugins/help';
    import 'tinymce/plugins/table';
    import 'tinymce/plugins/importcss';
    import 'tinymce/plugins/directionality';
    import 'tinymce/plugins/visualchars';
    import 'tinymce/plugins/template';
    import 'tinymce/plugins/codesample';
    import 'tinymce/plugins/hr';
    import 'tinymce/plugins/pagebreak';
    import 'tinymce/plugins/nonbreaking';
    import 'tinymce/plugins/toc';
    import 'tinymce/plugins/imagetools';
    import 'tinymce/plugins/textpattern';
    import 'tinymce/plugins/noneditable';
    import 'tinymce/plugins/emoticons';
    import 'tinymce/plugins/autosave';

    export default {
        name: 'productParameter',
        computed: {
            technology: {
                get() {
                    if (
                        typeof this.$store.state.a.content[this.$store.state.a.tabLangID] !==
                        'undefined'
                    ) {
                        return this.$store.state.a.content[this.$store.state.a.tabLangID]
                            .technology;
                    }
                },
                set(value) {
                    this.$store.dispatch('a/updateTechnology', value);
                },
            },
        },
        data() {
            return {}
        },
    };
</script>
