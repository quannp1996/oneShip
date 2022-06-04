<template>
  <el-form  label-width="120px">
     <el-form-item label="Tiêu đề đại diện">
        <el-input v-model="title"></el-input>
      </el-form-item>
       <el-form-item label="Danh mục">
        <el-select v-model="type" placeholder="Select">
           <el-option
            v-for="(item) in this.$store.state.b.type"
            :key="item"
            :label="item"
            :value="item">
          </el-option>
        </el-select>
      </el-form-item>
        <el-form-item label="Loại">
        <el-select v-model="cate" placeholder="Select">
           <el-option
            v-for="(item) in this.$store.state.b.cate"
            :key="item"
            :label="item"
            :value="item">
          </el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="Màu sắc">
        <el-input v-model="colorPk"></el-input><div class="backgroundColor" :style="{background: colorPk}">  </div>
         <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          Chọn màu
        </a>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
             <color-picker style='box-sizing: unset;'
          theme="light"
          :color="color"
          :sucker-hide="false"
          :sucker-canvas="suckerCanvas"
          :sucker-area="suckerArea"
          @changeColor="changeColor"
          @openSucker="openSucker"
          />
          </div>
        </div>
    </el-form-item>
  </el-form>
</template>

<style>
  .backgroundColor{
    width:40px;
    height:40px;
    float: left;
    border: black solid 1px;
  }
  .avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #409EFF;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
  }
  .avatar {
    width: 178px;
    height: 178px;
    display: block;
  }
</style>
<script>
import api from '../../../helpers/api';
import colorPicker from '@caohenghu/vue-colorpicker';
export default {
   name: 'General',
    components: { colorPicker },
    data() {
      return {
        suckerCanvas: null,
        suckerArea: [],
        isSucking: false,
        color:''
      }
    },
    computed: {
        title:{
          get(){
            return this.$store.state.b.content.title;
          },
          set(value){
            this.$store.dispatch('b/setTitle',value);
          }
        },
        type:{
          get(){
            return this.$store.state.b.content.type;
          },
          set(value){
            this.$store.dispatch('b/setType',value);
          }
        },
        cate:{
          get(){
            return this.$store.state.b.content.cate;
          },
          set(value){
            this.$store.dispatch('b/setCate',value);
          }
        },
        colorPk:{
          get(){
            return this.$store.state.b.content.color;
          },
          set(value){
            this.$store.dispatch('b/setColor',value);
          }
        }
    },
    mounted() {
      this.getType();
      this.getCate();
    },

    methods: {
        async getType(){
          let url = `admin/ajax/tags/controller/type`;
          let result = await api.request('get',url);
          this.$store.state.b.type = result.data.data;
        },
        async getCate(){
          let url = `admin/ajax/tags/controller/cate`;
          let result = await api.request('get',url);
          this.$store.state.b.cate = result.data.data;
        },
        changeColor(color) {
              this.$store.dispatch('b/setColor',color.hex);
              this.color = color.hex;
        },
        openSucker(isOpen) {
            if (isOpen) {
                // ... canvas be created
                // this.suckerCanvas = canvas
                // this.suckerArea = [x1, y1, x2, y2]
            } else {
                // this.suckerCanvas && this.suckerCanvas.remove
            }
        }
    }
}
</script>

<style>

</style>
