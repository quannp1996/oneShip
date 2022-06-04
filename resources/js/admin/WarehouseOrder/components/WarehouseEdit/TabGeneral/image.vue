<template>
<div>
    <el-upload
        action="#" :auto-upload="false"
        class="avatar-uploader"
        :show-file-list="false" :on-change='uploadFilesTag'
        :on-success="handleAvatarSuccess"
        :before-upload="beforeAvatarUpload">
        <img v-if="imageUrl" :src="herf+'/upload/'+type+'/thumb_350x0/'+imageUrl" class="avatar">
        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
        
    </el-upload>
    
    <el-button type="danger" icon="el-icon-delete" circle @click='clearImage'></el-button>

</div>
    
</template>
<style>
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
import axios from 'axios';

export default {
    name:'imageEdit',
     data() {
      return {
          type:'tags',
          herf: window.location.origin
      };
    },
    computed:{
        imageUrl(){
            return this.$store.state.b.content.image
        }
    },
    methods: {
        handleAvatarSuccess(res, file) {
            this.imageUrl = URL.createObjectURL(file.raw);
        },
        beforeAvatarUpload(file) {
            const isJPG = file.type === 'image/jpeg';
            const isLt2M = file.size / 1024 / 1024 < 2;

            if (!isJPG) {
            this.$message.error('Avatar picture must be JPG format!');
            }
            if (!isLt2M) {
            this.$message.error('Avatar picture size can not exceed 2MB!');
            }
            return isJPG && isLt2M;
        },
        clearImage(){
            this.$store.dispatch('b/setImg','');
        },
        async uploadFilesTag(req) {
            const formdata = new FormData();
            formdata.append('Filedata', req.raw);
            formdata.append('object_id', this.$store.state.b.content.id);
            const config = {
                headers: {'Content-Type': 'multipart/form-data','X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
            };
            await axios.post('/admin/ajax/tags/controller/imgUpload', formdata, config)
            .then(res => {
                if(!res.data.data.error) {
                    this.$store.dispatch('b/setImg',res.data.data.fileName);
                    console.log('image upload succeed.');
                }
            })
            .catch(err => {
                console.log(err.msg)
            })
        },
    }

}
</script>

<style>

</style>