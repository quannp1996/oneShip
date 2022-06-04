<template>
  <div>
     <el-autocomplete
        v-model="state"
        :fetch-suggestions="querySearchAsync"
        placeholder="Tìm và thêm tag đã có"
        @select="addTagsSearch"
        no-data-text = "No data found"
      ></el-autocomplete>
      <br>
      <br>
      <el-tag
        :key="index"
        v-for="(tag,index) in tags"
        closable
        :disable-transitions="false"
        @close="handleClose(index)">
        <a v-if="tag.tags">{{tag.tags.title}}</a>
        <a v-if="tag.tags == null" style="color:red">Tag đã bị xóa</a>
      </el-tag>
      <el-input
        class="input-new-tag"
        v-if="inputVisible"
        v-model="inputValue"
        ref="saveTagInput"
        size="mini"
        @keyup.enter.native="handleInputConfirm"
        @blur="handleInputConfirm"
      >
      </el-input>
      <el-button v-else class="button-new-tag" size="small" @click="showInput">+ Tạo tags mới</el-button>
  </div>
</template>
<style>
  .el-tag + .el-tag {
    margin-left: 10px;
  }
  .button-new-tag {
    margin-left: 10px;
    height: 32px;
    line-height: 30px;
    padding-top: 0;
    padding-bottom: 0;
  }
  .input-new-tag {
    width: 90px;
    margin-left: 10px;
    vertical-align: bottom;
  }
</style>

<script>
  import api from '../../../helpers/api';
  export default {
    data() {
      return {
        // dynamicTags: ['Tag 1', 'Tag 2', 'Tag 3'],
        inputVisible: false,
        inputValue: '',
        objectId: Number(this.$route.query.id),
        state: '',
        links: [],
        type: 'collection',
        cate: 'tag',
      };
    },
    mounted() {
      this.getData();
    },
    computed: {
      tags() {
        return this.$store.state.b.tagsContent;
      },
    },
    methods: {
      handleClose(tag) {
        this.deleteTags(tag);
        // this.dynamicTags.splice(this.dynamicTags.indexOf(tag), 1);
      },
      setAndGetData(data) {
        this.$store.dispatch('b/tagGetData', data);
      },

      deleteTags(key) {
        this.$store.dispatch('b/tagDeleteData', key);
      },

      addTags(input) {
        this.$store.dispatch('b/tagAddData', input);
      },
      addTagsSearch(input) {
        this.$store.dispatch('b/tagAddDataSearch', input);
      },
      showInput() {
        this.inputVisible = true;
        this.$nextTick((_) => {
          this.$refs.saveTagInput.$refs.input.focus();
        });
      },

      handleInputConfirm() {
        const inputValue = this.inputValue;
        if (inputValue == null || inputValue.trim() === '') {
        } else {
          this.addTags(inputValue);
        }
        this.inputVisible = false;
        this.inputValue = '';
      },
      isEmptyOrSpaces(str) {
          return str === null || str.match(/^ *$/) !== null;
      },
      openError(msg) {
          this.$message.error(msg);
      },
      async getData() {
        if (!isNaN(this.objectId)) {
          const url = `admin/ajax/tags/${this.objectId}/controller/getTagByIdPrd/${this.type}/${this.cate}`;
          const tags = await api.request('GET', url);
          if (typeof tags.data.data != 'undefined') {
            this.setAndGetData(tags.data.data);
          }
        }
      },

      async querySearchAsync(queryString='', cb) {
        const url = `admin/ajax/tags/${this.objectId}/controller/getSearchTagByIdPrd/${this.type}/${this.cate}`;
        const tags = await api.request('POST', url, { queryString });
        const tagData=[];
        if (typeof tags.data.data != 'undefined') {
           Array.from(tags.data.data).forEach((child) => {
          if (typeof child.title != 'undefined') {
                tagData.push({
                value: child.title,
                id: child.id,
              });
            }
          });
        }
        this.links = tagData;
        // var results = queryString ? links.filter(this.createFilter(queryString)) : links;
        clearTimeout(this.timeout);

            cb(tagData);
      },
    },
  };
</script>