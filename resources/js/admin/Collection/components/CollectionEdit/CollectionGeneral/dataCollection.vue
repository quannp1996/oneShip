<template>
  <el-tabs v-model="activeName" @tab-click="handleClick">
    <el-tab-pane
      v-for="(items, index) in this.$store.state.b.langData"
      v-bind:label="items.name"
      :tabID="items.language_id"
      :name="'tab' + index"
      :key="index"
    >
      <el-form>
        <div class="form-group">
          <label>
            Tên <span class="small text-danger">({{ items.name }})</span>
          </label>
          <el-input style="width:100%" placeholder="Tên bộ sưu tập" v-model="title">
            <template slot="prepend"
              ><img :src="'/admin/img/lang/' + items.image" :title="items.name"
            /></template>
          </el-input>
        </div>
        <div class="form-group">
          <label>
            Mô tả ngắn <span class="small text-danger">({{ items.name }}) </span
            ><img :src="'/admin/img/lang/' + items.image" :title="items.name" />
          </label>
          <el-input type="textarea" placeholder="Mô tả ngắn" :rows="4" v-model="short_description">
            <template slot="prepend"></template>
          </el-input>
        </div>
        <hr />
        <div class="form-group">
          <el-form-item label="Meta Tag Title" label-width="160px">
            <el-input style="width:100%" placeholder="" v-model="meta_title">
              <span class="small text-danger">({{ items.name }})</span
              ><template slot="prepend"
                ><img
                  :src="'/admin/img/lang/' + items.image"
                  :title="items.name"
              /></template>
            </el-input>
          </el-form-item>
        </div>
        <div class="form-group">
          <el-form-item label="Meta Tag Description" label-width="160px">
            <el-input
              style="width:100%"
              placeholder=""
              v-model="meta_description"
            >
              <span class="small text-danger">({{ items.name }})</span
              ><template slot="prepend"
                ><img
                  :src="'/admin/img/lang/' + items.image"
                  :title="items.name"
              /></template>
            </el-input>
          </el-form-item>
        </div>
        <div class="form-group">
          <el-form-item label="Meta Tag Keywords" label-width="160px">
            <el-input style="width:100%" placeholder="" v-model="meta_keyword">
              <span class="small text-danger">({{ items.name }})</span
              ><template slot="prepend"
                ><img
                  :src="'/admin/img/lang/' + items.image"
                  :title="items.name"
              /></template>
            </el-input>
          </el-form-item>
        </div>
      </el-form>
    </el-tab-pane>
  </el-tabs>
</template>
<script>

import api from '../../../helpers/api';
import TinyMCE from './tinyMCE.vue';
export default {
  components: {
    TinyMCE,
  },
  data() {
    return {
      activeName: 'tab0',
    };
  },

  created() {
    // this.$bus.on('storeNewProductVariant', productVariant => {
    //   this.listProductVariants.data.unshift(productVariant.data);
    // });
    // this.$bus.on('deleteProductVariant', productVariant => {
    //   let position = this.listProductVariants.data.indexOf(productVariant);
    //   this.listProductVariants.data.splice(position, 1);
    // });
  },
  computed: {
    title: {
      // eslint-disable-next-line vue/return-in-computed-property
      get() {
        if (
          typeof this.$store.state.b.content[this.$store.state.b.tabLangID] !=
          'undefined'
        ) {
          return this.$store.state.b.content[this.$store.state.b.tabLangID]
            .name;
        }
      },
      set(value) {
        this.$store.dispatch('b/updateTitle', value);
      },
    },
    short_description: {
      // eslint-disable-next-line vue/return-in-computed-property
      get() {
        if (
          typeof this.$store.state.b.content[this.$store.state.b.tabLangID] !=
          'undefined'
        ) {
          return this.$store.state.b.content[this.$store.state.b.tabLangID]
            .short_description;
        }
      },
      set(value) {
        this.$store.dispatch('b/updateShort_description', value);
      },
    },
    description: {
      // eslint-disable-next-line vue/return-in-computed-property
      get() {
        if (
          typeof this.$store.state.b.content[this.$store.state.b.tabLangID] !=
          'undefined'
        ) {
          return this.$store.state.b.content[this.$store.state.b.tabLangID]
            .description;
        }
      },
      set(value) {
        this.$store.dispatch('b/updateDescription', value);
      },
    },
    meta_title: {
      // eslint-disable-next-line vue/return-in-computed-property
      get() {
        if (
          typeof this.$store.state.b.content[this.$store.state.b.tabLangID] !==
          'undefined'
        ) {
          return this.$store.state.b.content[this.$store.state.b.tabLangID]
            .meta_title;
        }
      },
      set(value) {
        this.$store.dispatch('b/updateMeta_title', value);
      },
    },
    meta_description: {
      // eslint-disable-next-line vue/return-in-computed-property
      get() {
        if (
          typeof this.$store.state.b.content[this.$store.state.b.tabLangID] !==
          'undefined'
        ) {
          return this.$store.state.b.content[this.$store.state.b.tabLangID]
            .meta_description;
        }
      },
      set(value) {
        this.$store.dispatch('b/updateMeta_description', value);
      },
    },
    meta_keyword: {
      // eslint-disable-next-line vue/return-in-computed-property
      get() {
        if (
          typeof this.$store.state.b.content[this.$store.state.b.tabLangID] !==
          'undefined'
        ) {
          return this.$store.state.b.content[this.$store.state.b.tabLangID]
            .meta_keyword;
        }
      },
      set(value) {
        this.$store.dispatch('b/updateMeta_keyword', value);
      },
    },
  },

  mounted() {
    // this.tagByID()
  },

  methods: {
    updateLangID(content) {
      this.$store.dispatch('b/updateLangID', content);
    },
    getAndSetData(content) {
      this.$store.dispatch('b/content', content);
    },

    handleClick(tab, event) {
      this.updateLangID(tab.$attrs.tabID);
    },
  },
};
</script>
