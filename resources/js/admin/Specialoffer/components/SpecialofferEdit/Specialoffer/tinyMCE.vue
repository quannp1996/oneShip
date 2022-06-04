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
        // eslint-disable-next-line vue/return-in-computed-property
        get() {
          if (typeof this.$store.state.c.content[this.$store.state.c.tabLangID] !== 'undefined') {
             return this.$store.state.c.content[this.$store.state.c.tabLangID].description;
          }
        },
        set(value) {
          this.$store.dispatch('c/updateDescription', value);
        },
      },
  },
  data() {
    return {
      init: {
        height: 500,
        plugins: [
          'lists advlist',
          'image imagetools',
          'link autolink',
          'table',
          'charmap',
          'searchreplace visualblocks code fullscreen',
          'print preview anchor insertdatetime media',
          'help codesample hr pagebreak nonbreaking toc textpattern noneditable ',
          'importcss',
          'directionality',
          'visualchars',
          'emoticons',
          'autosave',
        ],
        toolbar:
          'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        branding: false,
        menubar: true,
        // images_upload_handler: (blobInfo, success, failure) => {
        //   const img = 'data:image/jpeg;base64,' + blobInfo.base64();
        //   success(img);
        // },
        file_picker_callback: function(callback, value, meta) {
                    // let field = win.document.getElementById(field_name)

                    const windowName = 'Media Window';
                    // newwindow = window.open(url_call,windowName,'height=630,width=1200');

                    // var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
                    // var eventer = window[eventMethod];
                    // var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

                    const x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    const y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

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

                    // Listen to message from child window
                    // eventer(messageEvent,function(e) {
                    //     console.log('origin: ', e.origin);

                    //     // Check if origin is proper
                    //     var origin = ENV.PUBLIC_URL.slice(0, -1);
                    //     if( e.origin != origin ){ return }
                    //     console.log('parent received message!: ', e.data);

                    //     if(typeof e.data == 'string') {
                    //         callback(e.data.replace(origin, ''));
                    //         // if (meta.filetype === 'image') {
                    //         //     callback(e.data.replace(origin, ''), {alt: ''});
                    //         // }

                    //         // if (meta.filetype === 'media') {
                    //         //     callback(e.data.replace(origin, ''));
                    //         // }

                    //         // if (meta.filetype === 'file') {
                    //         //     callback(e.data.replace(origin, ''), {text: 'My text'});
                    //         // }
                    //     }
                    // }, false);

                    // if (window.focus) {newwindow.focus()}
                    // return false;

                    // EventHub.listen('file_selected', (path) => {
                    //
                    // })
                },
      },
    };
  },
};
</script>
