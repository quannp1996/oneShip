<template>
  <editor  v-model="description" :init="init"></editor>
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
  name: 'TinyMce',
  components: {
    editor: Editor,
  },
  computed: {
    description: {
        get() {
          if (typeof this.$store.state.b.content[this.$store.state.b.tabLangID] !== 'undefined') {
             return this.$store.state.b.content[this.$store.state.b.tabLangID].description;
          }
        },
        set(value) {
          this.$store.dispatch('b/updateDescription', value);
        },
      },
  },
  data() {
    return {
      init: {
        height: 500,
        plugins: ['lists advlist', 'image', 'link autolink', 'table', 'charmap', 'searchreplace visualblocks code fullscreen', 'print preview anchor insertdatetime media', 'help codesample hr pagebreak nonbreaking toc textpattern noneditable ', 'importcss', 'directionality', 'visualchars', 'emoticons', 'autosave'],
        imagetools_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | emoticons | fullscreen  preview save image | insertfile print charmap media template link anchor codesample | ltr rtl',
        toolbar_sticky: false,
        fontsize_formats: '8px 10px 12px 14px 18px 24px 36px 48px 72px',
        autosave_ask_before_unload: false,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        importcss_append: true,
        image_caption: true,
        relative_urls: false,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: 'mceNonEditable',
        toolbar_mode: 'sliding',
        contextmenu: 'link image imagetools table',
        file_picker_callback: function (callback, value, meta) {
          const windowName = 'Media Window';

          const x =
                  window.innerWidth ||
                  document.documentElement.clientWidth ||
                  document.getElementsByTagName('body')[0].clientWidth;
          const y =
                  window.innerHeight ||
                  document.documentElement.clientHeight ||
                  document.getElementsByTagName('body')[0].clientHeight;

          const type = 'image' === meta.filetype ? 'Images' : 'Files';
          const url = '/file/laravel-filemanager?editor=tinymce5&type=' + type;

          tinymce.activeEditor.windowManager.openUrl({
            url: url,
            title: windowName,
            width: x * 0.8,
            height: y * 0.8,
            onMessage: (api, message) => {
              callback(message.content);
            },
          });
        },
      },
    };
  },
};
</script>
