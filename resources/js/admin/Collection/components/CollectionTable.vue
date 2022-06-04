<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            <i class="fa fa-align-justify"></i> Danh sách
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="55">ID</th>
                        <th style="min-width:600px;">Tiêu đề</th>
                        <th >Ảnh</th>
                        <th >Trạng thái</th>
                        <th width="55">Lệnh</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(post) in laravelData.data" :key="post.id">
                        <td>{{ post.id }}</td>
                        <td><p v-if="post.all_desc.length > 0" >{{ post.all_desc[0].name  }}</p></td>
                        <td><img :src="herf+'/upload/'+type+'/thumb_350x0/'+post.image" style="width: 50px;height: 50px;"></td>
                        <td ><a v-if='post.status < 1'>Ẩn</a><a v-else>Hiện</a></td>
                        <td>
                          <div class="actionIcon">
                            <router-link :to="'/collection/edit?id='+ post.id" title="Sửa" class="text-primary"><i class="fa fa-pencil"></i></router-link>
                          </div>
                          <div class="actionIcon">
                            <router-link :to="'/collection'" title="Xóa" class="text-danger"><i @click='deleteCollection(post.id)' class="fa fa-trash"></i></router-link>
                          </div>
                          <div class="actionIcon">
                            <a class="text-info" :href="post.route_detail" target="_blank"
                               data-toggle="tooltip" data-original-title="Xem bộ sưu tập" data-placement="top"
                               title="Xem bộ sưu tập"><i class="fa fa-chain"></i></a>
                          </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h4 v-if="!data_length" align="center">Không tìm thấy dữ liệu phù hợp</h4>
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
  name: 'TagTable',
  components: { },
  data() {
    return {
        tableData: [],
        laravelData: {},
        herf: window.location.origin,
        visible: false,
        data_length: true,
        type: 'collection',
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
        const url = 'admin/ajax/collection/controller/collectionList?page='+page;
        const fillters = this.$store.state.a.searchFilter;
        const result = await api.request('POST', url, { fillters });
        this.laravelData = result.data.data;
        if(this.laravelData.data.length == 0){
            this.data_length = false
        }else{
            this.data_length = true
        }
        this.$router.push({ path: this.$route.path, query: { ...this.$route.query, page: this.laravelData.current_page } }).catch(()=>{});
        this.setParamUrl();

    },
    clearBreadcrumb() {
        const element = document.getElementsByClassName('breadcrumbAdd');
        if (typeof element[0] !== 'undefined') {
            element[0].remove();
        }
    },
    deleteCollection(id) {
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
        const url = `admin/ajax/collection/controller/${id}/collectionDelete`;
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