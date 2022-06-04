<template>
  <el-form>
    <el-card v-if="this.$route.query.id">
      <el-row>
        <el-input placeholder="ID Sản phẩm" v-model="idInput">
          <template slot="prepend"><i class="fa fa-hashtag"></i></template>
        </el-input>
        <el-input placeholder="Tiêu đề" v-model="inputTitle">
          <template slot="prepend"><i class="fa fa-bookmark-o"></i></template>
        </el-input>
        <el-autocomplete
          v-model="stateCate"
          :fetch-suggestions="querySearchAsyncCate"
          placeholder="Danh mục"
          @select="addCate"
        ></el-autocomplete>
        <el-button
          type="primary"
          icon="el-icon-search"
          v-on:click="getCollection"
          >Tìm kiếm</el-button
        >
      </el-row>
    </el-card>
    <el-card>
      <el-button type="primary" @click="dialogVisible = true"
        >Thêm nhiều sản phẩm</el-button
      >
       <el-autocomplete
        class="search"
        v-model="state"
        :fetch-suggestions="querySearchAsync"
        placeholder="Thêm sản phẩm vào collection"
        @select="addCollection"
      ></el-autocomplete>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th width="50">ID</th>
              <th width="70">Image</th>
              <th width="455">Tiêu đề</th>
              <th width="555">Mô tả</th>
              <th width="555">Danh mục</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(items, index) in collection" :key="items.id">
              <td>{{ items.id }}</td>
              <td>
                <img
                  class="image"
                  :src="
                    herf + '/upload/' + type + '/thumb_350x0/' + items.image
                  "
                  width="50"
                  height="50"
                />
              </td>
              <td>{{ items.name }}</td>
              <td>
                <p class="text">{{ items.short_description }}</p>
              </td>
              <td>
                <b v-for="(cate, index) in items.categories" :key="index">{{ (index > 0) ? ' | ' : '' }} {{ cate.name }}</b>
              </td>
              <td>
                <a href="javascript:void(0)" @click="removeElement(index)" class="text-danger"
                  ><i class="el-icon-error"></i
                ></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </el-card>
    <el-dialog
      title="Chọn sản phẩm để thêm vào bộ sưu tập này"
      :visible.sync="dialogVisible"
      width="70%"
      :before-close="handleClose"
    >
      <el-card>
        <el-autocomplete
        class="search"
          v-model="stateCatePrdAddCollection"
          :fetch-suggestions="querySearchAsyncCate"
          placeholder="Tìm danh mục"
          @select="productsForAddCollection"
        ></el-autocomplete>
      </el-card>
      <el-card>
        <el-tabs
          v-model="editableTabsValue"
          type="card"
          editable
          @edit="handleTabsEdit"
          @tab-click="handleClick"
        >
          <el-tab-pane
            v-for="(item, index) in editableTabs"
            :key="index"
            :label="item.title"
            :name="index"
          >
            <el-card v-loading="loading">
              <div class="table-responsive" style="max-height:500px" @scroll="onScroll">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th width="70">ID</th>
                      <th width="80">Image</th>
                      <th width="455">Tiêu đề</th>
                      <th width="555">Mô tả</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="value in item.content" :key="value.product_id">
                      <template v-if="value.product">
                        <td>{{ value.product_id }}</td>
                        <td>
                          <img
                            class="image"
                            :src="
                              herf +
                                '/upload/' +
                                type +
                                '/thumb_350x0/' +
                                value.product.image
                            "
                            width="50"
                            height="50"
                          />
                        </td>
                        <td>{{ value.product.desc.name }}</td>
                        <td>{{ value.product.desc.short_description }}</td>
                        <td>
                          <input
                            type="checkbox"
                            :id="value.product_id"
                            :value="value.product_id"
                            v-model="checkedProduct"
                          />
                        </td>
                      </template>
                    </tr>
                  </tbody>
                </table>
              </div>
            </el-card>
          </el-tab-pane>
        </el-tabs>
      </el-card>
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogVisible = false">Cancel</el-button>
        <el-button type="primary" @click="addPrdsToCollection"
          >Confirm</el-button
        >
      </span>
    </el-dialog>
  </el-form>
</template>

<style>
@import "../../../css/edit.css";
</style>
<script>
import messageMixin from '../../../mixins/messageMixin.js';
import api from '../../../helpers/api';
export default {
  mixins: [messageMixin],
  name: 'General',
  components: {},
  data() {
    return {
      currentDate: new Date(),
      stateCate: '',
      stateCatePrdAddCollection: '',
      state: '',
      herf: window.location.origin,
      type: 'product',
      idInput: '',
      idCateInput: '',
      inputTitle: '',
      dialogVisible: false,
      editableTabsValue: '2',
      tabIndex: 2,
      checkedProduct: [],
      tabClick: '',
      loading: false,
    };
  },
  computed: {
    collection() {
      return this.$store.state.b.collection;
    },
    editableTabs() {
      return this.$store.state.b.editableTabs;
    },
  },
  mounted() {
    if (typeof this.$route.query.id != 'undefined') {
      this.getCollection();
    }
  },

  methods: {
    onScroll({ target: { scrollTop, clientHeight, scrollHeight } }) {
      if (scrollTop + clientHeight >= scrollHeight) {
          this.loading = true;
          this.loadScollTab(this.tabClick);
      }
    },
    handleClick(tab, event) {
      this.tabClick = tab.name;
    },
    async loadScollTab(tabDetect) {
      const offset = Object.keys(this.$store.state.b.editableTabs[tabDetect].content).length;
      const url = `admin/ajax/products/${tabDetect}/controller/getPrdByIdCateForOffset?offset=${offset}`;
      // eslint-disable-next-line vue/no-async-in-computed-properties
      await api.request('GET', url).then((response) => {
            // test.push(response.data.data);
            if (response.data.data.length > 0) {
               const prd = [...this.$store.state.b.editableTabs[this.tabClick].content, ...response.data.data];
              // this.$store.state.b.editableTabs[this.tabClick].content = prd;
              // this.$store.state.b.editableTabs=Object.assign({}, this.$store.state.b.editableTabs, this.$store.state.b.editableTabs);
              this.$store.dispatch('b/setContentTabPrd', { tabDetect, prd });
              this.loading = false;
            } else {
              this.showMessage('No Data', 'warning');
              this.loading = false;
            }
        });
    },
    handleClose(done) {
      this.$confirm('Bạn có chắc muốn đóng?', 'Cảnh báo!', {
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Bỏ qua',
      })
        .then((_) => {
          done();
        })
        .catch((_) => {});
    },
    removeElement(index) {
      this.$store.dispatch('b/removeElement', index);
    },
    numberFormat(number) {
      return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
      }).format(number);
    },
    async addCollection(item) {
      // if (typeof this.$route.query.id != 'undefined') {
      //   await this.getCollection('default');
      // }
      await this.$store.dispatch('b/collectionData', item.data);
    },
    async addPrdsToCollection() {
      const ids = this.checkedProduct;
      const url = 'admin/ajax/products/controller/getIdsPrd';
      const products = await api.request('POST', url, { ids });
      if (!products.data.error) {
        await this.$store.dispatch(
          'b/addPrdsCollectionData',
          products.data.data.data,
        );
        this.dialogVisible = false;
      }
    },
    async querySearchAsync(queryString, cb) {
      const url = 'admin/ajax/collection/controller/searchProduct';
      const cate = await api.request('POST', url, { queryString });
      const collectionData = [];
      Array.from(cate.data.data).forEach((child) => {
        if (child.product != null) {
          collectionData.push({
            value: child.name,
            id: child.id,
            data: child,
            cate: child.product,
          });
        }
      });
      clearTimeout(this.timeout);
      cb(collectionData);
    },
    async getCollection(type) {
      let url = '';
      if (this.stateCate === '') {
        // eslint-disable-next-line no-var
        var cateID = '';
      } else {
        // eslint-disable-next-line no-var
        var cateID = this.idCateInput;
      }
      if (type != 'default') {
        url = `admin/ajax/collection/${this.$route.query.id}/controller/dataCollection?prd_id=${this.idInput}&&inputTitle=${this.inputTitle}&&cate_id=${cateID}`;
      } else {
        url = `admin/ajax/collection/${this.$route.query.id}/controller/dataCollection`;
      }
      const data = await api.request('GET', url);
      this.$store.state.b.collection = data.data.data;
    },
    async querySearchAsyncCate(queryString, cb) {
      const url = 'admin/ajax/category/controller/getCategories';
      const cate = await api.request('POST', url, { queryString });
      const cateData = [];
      Array.from(cate.data.data).forEach((child) => {
        cateData.push({
          value: child.text,
          id: child.id,
        });
      });
      this.links = cateData;
      // var results = queryString ? links.filter(this.createFilter(queryString)) : links;
      clearTimeout(this.timeout);
      cb(cateData);
    },
    addCate(item) {
      this.idCateInput = item.id;
    },
    async productsForAddCollection(item) {
      const url = `admin/ajax/products/${item.id}/controller/getPrdByIdCate`;
      const product = await api.request('GET', url);
      if (product.data.success) {
        // this.$store.dispatch('b/setProductAddCollection', product.data.data.products);
        if (
          typeof product.data.data.products !== 'undefined' &&
          product.data.data.products.length !== 0
        ) {
          this.handleTabsEdit(
            item.id,
            'add',
            product.data.data.cate.name,
            product.data.data.products,
          );
        } else {
          return this.showMessage('No Data', 'error');
        }
      }
    },
    handleTabsEdit(targetName, action, tabTitle, content) {
      if (action === 'add') {
        const newTabName = ++this.tabIndex + '';
        this.$store.dispatch('b/addEditTableTabs', {
          title: 'Tab ' + tabTitle,
          name: targetName,
          content: content,
        });
        this.editableTabsValue = newTabName;
      }
      if (action === 'remove') {
        const tabs = this.$store.state.b.editableTabs;
        const tabsFillter = this.$store.state.b.editableTabs;
        let activeName = this.editableTabsValue;
        delete tabsFillter[targetName];
        if (activeName === targetName) {
          Object.keys(tabs).forEach((index) => {
            if (tabs[index].name === targetName) {
              const nextTab = tabs[index + 1] || tabs[index - 1];
              if (nextTab) {
                activeName = nextTab.name;
              }
            }
          });
        }
        this.editableTabsValue = activeName;
        // const tabValueFill = tabs.filter((tab) => tab.name !== targetName);
        this.$store.dispatch('b/setEditTableTabs', tabsFillter);
      }
    },
  },
};
</script>

<style></style>
