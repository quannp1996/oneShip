<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            <i class="fa fa-align-justify"></i> Danh sách
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th style="min-width:600px;">Tên thương hiệu</th>
                        <th >Ngày tạo</th>
                        <!--<th >Ảnh</th>-->
                        <th width="60">Lệnh</th>
                    </tr>
                </thead>
                <tbody>
                        <tr v-for="post in laravelData.data" :key="post.manufacturer_id">
                            <td>{{ post.manufacturer_id }}</td>
                            <td>{{ post.name }}</td>
                            <td><p v-if="post.created_at">{{ post.created_at.replace(/.000000Z/g, ' ').replace(/T/g, ' ')}}</p></td>
                            <!--<td><img
                              v-if="post.image"
                              :src="herf + '/upload/' + type + '/thumb_400x0/' + post.image"
                              class="imageList"
                            /></td>-->
                            <td>
                              <div class="actionIcon">
                                <router-link :to="'/manufacturer/edit?id='+ post.manufacturer_id" ><i class="fa fa-pencil"></i></router-link>
                              </div>
                              <div class="actionIcon">
                                <router-link :to="'/manufacturer'" class="text-danger" ><i @click='deleteTag(post.manufacturer_id)' class="fa fa-trash"></i></router-link>
                              </div>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
        <pagination :data="laravelData" @pagination-change-page="dataTable"></pagination>
    </el-card>
</template>
<style>
  @import "./../css/list.css";
</style>
<script>
// import ProductTag from "./ProductTag/ProductTag.vue";
import api from '../helpers/api';
import Vue from 'vue';
import moment from 'moment';
import { eventBus } from '../app.js';
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);
Vue.component('pagination', require('laravel-vue-pagination'));
export default {
  name: 'ManufacturerTable',
  components: { },
  data() {
    return {
        tableData: [],
        laravelData: {},
        herf: window.location.origin,
        type: 'manufacturer',
      };
    },
  computed: {
    // result () {
    //   return this.$store.state.result
    // }
  },
  mounted() {
      this.dataTable(this.$route.query.page ?? 1);
  },
  created() {
      eventBus.$on('fireMethod', () => {
              this.dataTable();
      });
  },
  methods: {
    async dataTable(page = 1) {
        this.clearBreadcrumb();
        const url = 'admin/ajax/manufacturer/controller/manufacturerList?page='+page;
        const fillters = this.$store.state.a.searchFilter;
        const result = await api.request('POST', url, { fillters });
        this.laravelData = result.data.data;
        this.$router.push({ path: this.$route.path, query: { ...this.$route.query, page: this.laravelData.current_page } }).catch(()=>{});
        this.setParamUrl();
    },
    clearBreadcrumb() {
          const element = document.getElementsByClassName('breadcrumbAdd');
          if (typeof element[0] !== 'undefined') {
            element[0].remove();
          }
    },
    deleteTag(id) {
        this.$swal({
          title: 'Bạn có chắc chắn?',
          icon: 'warning',
          html: '<p style="text-align:center">Bạn có muốn xóa</p>',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Delete',
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Deleted!',
              '<p>Thành công</p>',
              'success',
            );
            this.deleteElm(id);
          }
        });
    },
    async deleteElm(id) {
        const url = `admin/ajax/manufacturer/controller/${id}/manufacturerDelete`;
        const result = await api.request('GET', url);
        if (!result.data.error) {
            this.openSuccess(result.data.msg);
            this.dataTable();
        } else {
            this.openError(result.data.msg);
        }
    },
    setParamUrl() {
      this.$router.push({ path: this.$route.path, query: { ...this.$route.query, title: this.$store.state.a.searchFilter.title } }).catch(()=>{});
      this.$router.push({ path: this.$route.path, query: { ...this.$route.query, id: this.$store.state.a.searchFilter.id } }).catch(()=>{});
    },
    format_date(value) {
         if (value) {
           return moment(value*1000).format('MM/DD/YYYY hh:mm');
          }
    },
    openSuccess(msg) {
      this.$message({
        message: msg,
        type: 'success',
      });
    },
    openError(msg) {
      this.$message.error(msg);
    },
  },
}; // End class

</script>