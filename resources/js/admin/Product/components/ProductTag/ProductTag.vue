<template>
  <div class='row'>
    <div class='col-lg-6 border-left'>
        <el-header><h2>Tag thường</h2></el-header>
       <el-autocomplete
        v-model="stateTag"
        :fetch-suggestions="querySearchAsyncTag"
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
        @close="handleClose(index,'tag')">
        <a v-if="tag.tags">{{tag.tags.title}}</a>
        <a v-if="typeof tag.tags.title ==='undefined' || tag.tags.title ==='null'">Tag đã xóa hoặc không xác định</a>
      </el-tag>
      <el-input
        class="input-new-tag"
        v-if="inputVisible"
        v-model="inputValue"
        ref="saveTagInput"
        size="mini"
        @keyup.enter.native="handleInputConfirm('tag')"
        @blur="handleInputConfirm('tag')"
      >
      </el-input>
      <el-button v-else class="button-new-tag" size="small" @click="showInput">+ Tạo tags mới</el-button>
    </div>
    <div class='col-lg-6'>
        <el-header><h2>Tag đặc biệt (Nhãn)</h2></el-header>
        <el-autocomplete
        v-model="stateLabel"
        :fetch-suggestions="querySearchAsyncLabel"
        placeholder="Tìm và thêm Nhãn đã có"
        @select="addLabelSearch"
        no-data-text = "No data found"
      ></el-autocomplete>
      <br>
      <br>
      <el-tag
        :key="index"
        v-for="(label,index) in labels"
        closable
        :disable-transitions="false"
        @close="handleClose(index,'label')">
        <a v-if="label.tags">{{label.tags.title}}</a>
        <a v-if="typeof label.tags.title ==='undefined' || label.tags.title ==='null'">Nhãn đã xóa hoặc không xác định</a>
      </el-tag>
      <el-input
        class="input-new-tag"
        v-if="inputVisibleLabel"
        v-model="inputValueLabel"
        ref="saveLabelInput"
        size="mini"
        @keyup.enter.native="handleInputConfirm('label')"
        @blur="handleInputConfirm('label')"
      >
      </el-input>
      <el-button v-else class="button-new-tag" size="small" @click="showInputLabel">+ Tạo Nhãn mới</el-button>
    </div>
  </div>
</template>
<style>
  @import url('./../../css/tag.css');
</style>

<script>
  import api from '../../helpers/api';
  export default {
    data() {
      return {
        // dynamicTags: ['Tag 1', 'Tag 2', 'Tag 3'],
        inputVisible: false,
        inputValue: '',
        inputVisibleLabel: false,
        inputValueLabel: '',
        objectId: Number(window.product_id),
        stateTag: '',
        stateLabel: '',
        linksTag: [],
        linksLabel: [],
      };
    },
    mounted() {
      this.getData();
      this.getDataLabel();
    },
    computed: {
      tags() {
        return this.$store.state.e.tagsContent;
      },
      labels() {
        return this.$store.state.e.labelsContent;
      },
    },
    methods: {
      handleClose(tag, cate = 'tag') {
        this.deleteTags(tag, cate);
        // this.dynamicTags.splice(this.dynamicTags.indexOf(tag), 1);
      },
      setAndGetData(data, cate = 'tag') {
        if (cate == 'tag') {
          this.$store.dispatch('e/tagGetData', data);
        } else {
          this.$store.dispatch('e/labelGetData', data);
        }
      },

      deleteTags(key, cate = 'tag') {
        if (cate === 'tag') {
          this.$store.dispatch('e/tagDeleteData', key);
        } else {
          this.$store.dispatch('e/labelDeleteData', key);
        }
      },

      addTags(input) {
        this.$store.dispatch('e/tagAddData', input);
      },
      addLabels(input) {
        this.$store.dispatch('e/labelAddData', input);
      },
      addTagsSearch(input) {
        this.$store.dispatch('e/tagAddDataSearch', input);
      },
      addLabelSearch(input) {
        this.$store.dispatch('e/labelAddDataSearch', input);
      },
      showInput() {
        this.inputVisible = true;
        this.$nextTick((_) => {
          this.$refs.saveTagInput.$refs.input.focus();
        });
      },
      showInputLabel() {
        this.inputVisibleLabel = true;
        this.$nextTick((_) => {
          this.$refs.saveLabelInput.$refs.input.focus();
        });
      },
      handleInputConfirm(cate = 'tag') {
        if (cate === 'tag') {
          const inputValue = this.inputValue;
          if (inputValue == null || inputValue.trim() === '') {
            console.log('Empty');
          } else {
            this.addTags(inputValue);
          }
          this.inputVisible = false;
          this.inputValue = '';
        } else {
          const inputValueLabel = this.inputValueLabel;
          if (inputValueLabel == null || inputValueLabel.trim() === '') {
            console.log('Empty');
          } else {
            this.addLabels(inputValueLabel);
          }
          this.inputVisibleLabel = false;
          this.inputValueLabel = '';
        }
      },

      async getData() {
        if (!isNaN(this.objectId)) {
          const type= 'product';
          const cate= 'tag';
          const url = `admin/ajax/tags/${this.objectId}/controller/getTagByIdPrd/${type}/${cate}`;
          const tags = await api.request('GET', url);
          if (typeof tags.data.data != 'undefined') {
            this.setAndGetData(tags.data.data);
          }
        }
      },
      async getDataLabel() {
        if (!isNaN(this.objectId)) {
          const type= 'product';
          const cate= 'label';
          const url = `admin/ajax/tags/${this.objectId}/controller/getTagByIdPrd/${type}/${cate}`;
          const labels = await api.request('GET', url);
          if (typeof labels.data.data != 'undefined') {
            this.setAndGetData(labels.data.data, 'label');
          }
        }
      },
      async querySearchAsyncTag(queryString='', cb) {
        const type= 'product';
        const cate= 'tag';
        const url = `admin/ajax/tags/${this.objectId}/controller/getSearchTagByIdPrd/${type}/${cate}`;
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
        this.linksTag = tagData;
        // var results = queryString ? links.filter(this.createFilter(queryString)) : links;
        clearTimeout(this.timeout);

            cb(tagData);
      },
      async querySearchAsyncLabel(queryString='', cb) {
        const type= 'product';
        const cate= 'label';
        const url = `admin/ajax/tags/${this.objectId}/controller/getSearchTagByIdPrd/${type}/${cate}`;
        const labels = await api.request('POST', url, { queryString });
        const labelData=[];
        if (typeof labels.data.data != 'undefined') {
           Array.from(labels.data.data).forEach((child) => {
          if (typeof child.title != 'undefined') {
                labelData.push({
                value: child.title,
                id: child.id,
              });
            }
          });
        }
        this.linksLabel = labelData;
        // var results = queryString ? links.filter(this.createFilter(queryString)) : links;
        clearTimeout(this.timeout);

            cb(labelData);
      },
    },
  };
</script>
