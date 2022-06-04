<template>
<div>
    <div>
      <h2>Ảnh đại diện</h2>
        <el-upload
            action="#" :auto-upload="false"
            class="avatar-uploader"
            :show-file-list="false" :on-change='uploadFilesImg'
            :on-success="handleAvatarSuccess"
            :before-upload="beforeAvatarUpload">
            <img v-if="imageUrl" :src="herf+'/upload/'+type+'/thumb_800x0/'+imageUrl" class="avatar">
            <i v-else class="el-icon-plus avatar-uploader-icon"></i>

        </el-upload>

        <el-button type="danger" icon="el-icon-delete" circle @click='clearImage'></el-button>
    </div>
    <hr>
    <div>
      <h2>Ảnh đại diện mobile</h2>
        <el-upload
            action="#" :auto-upload="false"
            class="avatar-uploader"
            :show-file-list="false" :on-change='uploadFilesImgMobi'
            :on-success="handleAvatarSuccessMobi"
            :before-upload="beforeAvatarUploadMobi">
            <img v-if="imageUrlMobi" :src="herf+'/upload/'+type+'/thumb_800x0/'+imageUrlMobi" class="avatar">
            <i v-else class="el-icon-plus avatar-uploader-icon"></i>

        </el-upload>

        <el-button type="danger" icon="el-icon-delete" circle @click='clearImageMobi'></el-button>
    </div>
    <hr>
    <div>
      <h2>Ảnh slider</h2>
      <el-upload
        action="" ref="upload"
        list-type="picture-card"
        :auto-upload="false"
        :on-change='uploadFiles' :file-list="fileList" >
          <i slot="default" class="el-icon-plus"></i>
          <div slot="file" slot-scope="{file}">
            <img
              class="el-upload-list__item-thumbnail"
              :src="file.url" alt=""
            >
            <span class="el-upload-list__item-actions">
              <span
                class="el-upload-list__item-preview"
                @click="handlePictureCardPreview(file)"
              >
                <i class="el-icon-zoom-in"></i>
              </span>
              <span
              v-if="!disabled"
              class="el-upload-list__item-delete"
                @click="handleEdit(file)"
              >
                <i class="el-icon-edit"></i>
              </span>
              <span
                v-if="!disabled"
                class="el-upload-list__item-delete"
                @click="handleDownload(file)"
              >
                <i class="el-icon-download"></i>
              </span>
              <span
                v-if="!disabled"
                class="el-upload-list__item-delete"
                @click="handleRemove(file)"
              >
                <i class="el-icon-delete"></i>
              </span>
            </span>
          </div>
      </el-upload>
      <el-dialog :visible.sync="dialogVisible">
      <img width="100%" :src="dialogImageUrl" alt="">
    </el-dialog>
    </div>
    <el-dialog
      title="Edit"
      :visible.sync="dialogEditVisible"
      width="40%"
      :before-close="handleClose"
    >
      <div class="margin-bottom-30">
        <label class="margin-top-10">Thứ tự: </label>
      <el-input placeholder="Nhập thứ tự" v-model="editImage.sort" class="input-edit"></el-input>
      </div>
      <div class="margin-bottom-30">
        <label class="margin-top-10">Link: </label>
      <el-input placeholder="Nhập link" v-model="editImage.link" class="input-edit"></el-input>
      </div>
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogEditVisible = false">Cancel</el-button>
        <el-button type="primary" @click="handleUpdateImage">Lưu</el-button>
      </span>
    </el-dialog>
</div>

</template>
<style>
  @import "../../../css/imageUpload.css";
</style>
<script>
import axios from 'axios';
import api from '../../../helpers/api';

export default {
    name: 'imageEdit',
     data() {
      return {
        fileList: this.$store.state.b.fileList,
        type: 'promotioncampaign',
        herf: window.location.origin,
        disabled: false,
        dialogVisible: false,
        dialogImageUrl: '',
        editImage: {},
        dialogEditVisible: false,
      };
    },
    mounted() {
      if (typeof this.$route.query.id != 'undefined') {
          this.sliderImgByID();
      }
    },
    computed: {
        imageUrl() {
            return this.$store.state.b.content.image;
        },
        imageUrlMobi() {
            return this.$store.state.b.content.image_mobile;
        },
    },
    methods: {
        handleEdit(file) {
          this.editImage = file;
          this.dialogEditVisible = true;
        },
        handleAvatarSuccess(res, file) {
            this.imageUrl = URL.createObjectURL(file.raw);
        },
        async handleUpdateImage() {
          const editImage = this.editImage;
          const dataImg = this.$store.state.b.fileList;
          const url = 'admin/ajax/promotionCampaign/controller/itemImgUpdate';
          const campaign = await api.request('POST', url, { editImage });
          if (!campaign.data.error) {
            dataImg.forEach((element, index) => {
              if (element.id == campaign.data.data.id) {
                this.$store.state.b.fileList[index].sort = campaign.data.data.sort;
              }
            });
            this.openSuccess(campaign.data.msg);
            this.dialogEditVisible = false;
          } else {
            this.openError(campaign.data.msg);
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
        handleAvatarSuccessMobi(res, file) {
            this.imageUrlMobi = URL.createObjectURL(file.raw);
        },
        beforeAvatarUploadMobi(file) {
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
        clearImage() {
            this.$store.dispatch('b/setImg', '');
        },
        clearImageMobi() {
            this.$store.dispatch('b/setImgMobi', '');
        },
        async uploadFilesImg(req) {
            const formdata = new FormData();
            formdata.append('Filedata', req.raw);
            formdata.append('object_id', this.$store.state.b.content.id);
            const config = {
                headers: { 'Content-Type': 'multipart/form-data', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            };
            await axios.post('/admin/ajax/promotionCampaign/controller/imgUpload', formdata, config)
            .then((res) => {
                if (!res.data.data.error) {
                    this.$store.dispatch('b/setImg', res.data.data.fileName);
                    console.log('image upload succeed.');
                }
            })
            .catch((err) => {
                console.log(err.msg);
            });
        },
        async uploadFilesImgMobi(req) {
            const formdata = new FormData();
            formdata.append('Filedata', req.raw);
            formdata.append('object_id', this.$store.state.b.content.id);
            const config = {
                headers: { 'Content-Type': 'multipart/form-data', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            };
            await axios.post('/admin/ajax/promotionCampaign/controller/imgUpload', formdata, config)
            .then((res) => {
                if (!res.data.data.error) {
                    this.$store.dispatch('b/setImgMobi', res.data.data.fileName);
                    console.log('image upload succeed.');
                }
            })
            .catch((err) => {
                console.log(err.msg);
            });
        },
        async uploadFiles(req) {
            const formdata = new FormData();
            formdata.append('Filedata', req.raw);
            formdata.append('promotion_campaign_id', this.$route.query.id);

            const config = {
                headers: { 'Content-Type': 'multipart/form-data', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            };
            axios.post('/admin/ajax/promotionCampaign/controller/imgUploadSlider', formdata, config)
            .then((res) => {
                const file=[];
                if (typeof res.data.data.images != 'undefined') {
                    Array.from(res.data.data.images).forEach((child) => {
                    file.push({
                    name: child.img,
                    url: child.image,
                    sort: child.sort,
                    id: child.id,
                    promotion_campaign_id: child.promotion_campaign_id,
                    });
                });
                }

                this.fileList.push(file[0]);

                this.$store.dispatch('b/fileList', this.fileList);
                console.log('image upload succeed.');
            })
            .catch((err) => {
                console.log(err.message);
            });
        },
        handleRemove(file) {
            this.removeImg(file.uid);
        },
        handlePictureCardPreview(file) {
            this.dialogImageUrl = file.url;
            this.dialogVisible = true;
        },
        handleDownload(file) {
            window.location.assign(file.url);
        },
        async removeImg(imgId) {
        if (confirm('Bạn có chắc chắn muốn xóa ?')) {
            // let url = `admin/ajax/collection/${this.$route.query.id }-${imgId}/controller/itemImgDel`;
            // let collection = await api.request('GET', url);
            if (typeof this.fileList != 'undefined') {
              const file=[];
              const unique = (value, index, self) => {
                      return self.indexOf(value) === index;
              };
              Array.from(this.fileList).forEach((child, index) => {
                if (imgId == child.uid) {
                    delete this.fileList[index];
                    this.fileList = this.fileList.filter(unique);
                }
                this.$store.dispatch('b/fileList', this.fileList);
              });
              // this.fileList = file;
              // this.getAndSetData(collection.data.data);
            }
        }
      },
      async sliderImgByID() {
        const url = `admin/ajax/promotionCampaign/${this.$route.query.id}/controller/imgData`;
        const promotionCampaign = await api.request('GET', url);
        if (promotionCampaign) {
          const file=[];
          if (typeof promotionCampaign.data.data != 'undefined') {
            Array.from(promotionCampaign.data.data).forEach((child) => {
              file.push({
              name: child.img,
              url: child.image,
              sort: child.sort,
              id: child.id,
              link: child.link,
              promotion_campaign_id: child.promotion_campaign_id,
            });
          });
          }
          this.fileList = file;
          this.$store.dispatch('b/fileList', this.fileList);

          // this.getAndSetData(products.data.data);
        }
      },
    },

};
</script>

<style>

</style>
