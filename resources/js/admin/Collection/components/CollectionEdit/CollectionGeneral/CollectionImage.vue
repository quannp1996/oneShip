<template>
    <div>
        <el-card class="box-card">
            <h2>Ảnh slider</h2>
            <el-upload
              action="" ref="upload"
              list-type="picture-card"
              :auto-upload="false"
              :file-list="fileListImage"
              multiple
              :on-change='uploadFiles'
            >
                <i slot="default" class="el-icon-plus"></i>
                <div slot="file" slot-scope="{file}">
                  <img
                    class="el-upload-list__item-thumbnail"
                    :src="file.image_small" alt=""
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
                      @click="handleRemove(file)"
                    >
                      <i class="el-icon-delete"></i>
                    </span>
                  </span>
                </div>
            </el-upload>
            <br>
            <div class="row">
                <div class="col-sm-3">
                    <label>Ảnh đại diện</label>
                    <el-upload action="#" :auto-upload="false" class="avatar-uploader" :show-file-list="false"
                               :on-change='uploadFilesImageCollection' :on-success="handleAvatarSuccess"
                               :before-upload="beforeAvatarUpload">
                        <img v-if="imageUrl" :src="herf+'/upload/'+type+'/thumb_1300x0/'+imageUrl" class="avatar">
                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                    </el-upload>
                    <el-button type="danger" icon="el-icon-delete" circle @click='clearImage'></el-button>
                </div>
                <!-- <div class="col-sm-3">
                    <label>Album Ảnh</label>
                    <el-upload action="#" :auto-upload="false" class="avatar-uploader" :show-file-list="false"
                               :on-change='uploadFilesImageHoverCollection' :on-success="handleImageHoverSuccess"
                               :before-upload="beforeImageHoverUpload">
                        <img v-if="imageHover" :src="herf+'/upload/'+type+'/thumb_1300x0/'+imageHover" class="avatar">
                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                    </el-upload>
                    <el-button type="danger" icon="el-icon-delete" circle @click='clearImageHover'></el-button>
                </div> -->
            </div>

        </el-card>
        <el-dialog :visible.sync="dialogVisible">
            <img width="100%" :src="dialogImageUrl" alt="">
        </el-dialog>
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
    @import "../../../css/imagebox.css";
    @import "../../../css/imageUpload.css";
</style>
<script>
    import api from '../../../helpers/api';
    import axios from 'axios';

    export default {
        data() {
            return {
                dialogImageUrl: '',
                dialogVisible: false,
                editImage: {},
                dialogEditVisible: false,
                disabled: false,
                attachments: [],
                collectionId: this.$route.query.id ?? '',
                herf: window.location.origin,
                type: 'collection',
            };
        },
        mounted() {
            if (typeof this.$route.query.id != 'undefined') {
                this.collectionImgByID();
            }
        },
        computed: {
            imageUrl() {
                return this.$store.state.b.general.image;
            },
            imageHover() {
                return this.$store.state.b.general.image_hover;
            },
            fileListImage() {
                return this.$store.state.b.general.images;
            },
        },
        methods: {
            change(file, fileList) {
                this.fileList = fileList;
            },
            handleClose(done) {
                this.$confirm('Bạn có chắc muốn đóng?', 'Cảnh báo!', {
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Bỏ qua',
                })
                    .then((_) => {
                        done();
                    })
                    .catch((_) => {
                    });
            },
            handleEdit(file) {
                this.editImage = file;
                this.dialogEditVisible = true;
            },
            async handleUpdateImage() {
                const editImage = this.editImage;
                const dataImg = this.$store.state.c.fileList;
                const url = 'admin/ajax/collection/controller/itemImgUpdate';
                const campaign = await api.request('POST', url, {editImage});
                if (!campaign.data.error) {
                    dataImg.forEach((element, index) => {
                        if (element.id == campaign.data.data.id) {
                            this.$store.state.c.fileList[index].sort = campaign.data.data.sort;
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
            clearImage() {
                this.$store.dispatch('b/setImg', '');
            },
            clearImageHover() {
                this.$store.dispatch('b/setImgHover', '');
            },
            getAndSetData(content) {
                this.$store.dispatch('c/imagetData', content);
            },
            handleRemove(file) {
                this.removeImg(file.id);
            },
            handlePictureCardPreview(file) {
                this.dialogImageUrl = file.img;
                this.dialogVisible = true;
            },
            handleDownload(file) {
                window.location.assign(file.url);
            },

            async removeImg(img_id) {
                if (confirm('Bạn có chắc chắn muốn xóa ?')) {
                    if (typeof this.fileListImage != 'undefined') {
                        const newList = this.fileListImage.filter( item => {
                            return item.id != img_id;
                        });
                        this.$store.dispatch('b/images', newList);
                    }
                }
            },
            async collectionImgByID() {
                const url = `admin/ajax/collection/${this.$route.query.id}/controller/imgData`;
                const collection = await api.request('GET', url);
                if (collection) {
                    const file = [];
                    if (typeof collection.data.data != 'undefined') {
                        Array.from(collection.data.data).forEach((child) => {
                            file.push({
                                name: child.img,
                                id: child.id,
                                link: child.link,
                                url: child.imglarge,
                                sort: child.sort,
                            });
                        });
                    }
                    this.fileList = file;
                    this.$store.dispatch('c/fileList', this.fileList);

                    // this.getAndSetData(products.data.data);
                }
            },
            async uploadFilesImageCollection(req) {
                const formdata = new FormData();
                formdata.append('Filedata', req.raw);
                // formdata.append('object_id', this.productId);
                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                };
                axios.post('/admin/ajax/collection/controller/imgUpload', formdata, config)
                    .then((res) => {
                        if (res.data.error == 1) {
                            alert('File ảnh không đúng định dạng')
                        } else {
                            if (typeof res.data.data.images != 'undefined') {

                                Array.from(res.data.data.images).forEach((child) => {
                                    this.$store.dispatch('b/setImg', child.img);
                                });
                            }
                            console.log('image upload succeed.');
                        }

                    })
                    .catch((err) => {
                        console.log(err.message);
                    });
            },
            async uploadFilesImageHoverCollection(req) {
                const formdata = new FormData();
                formdata.append('Filedata', req.raw);
                formdata.append('type', 2);
                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                };
                axios.post('/admin/ajax/collection/controller/imgUpload', formdata, config)
                    .then((res) => {
                        if (res.data.error == 1) {
                            alert('File ảnh không đúng định dạng')
                        } else {
                            if (typeof res.data.data.images != 'undefined') {
                                Array.from(res.data.data.images).forEach((child) => {
                                    this.$store.dispatch('b/setImgHover', child.image_hover);
                                });
                            }
                            console.log('image upload succeed.');
                        }

                    })
                    .catch((err) => {
                        console.log(err.message);
                    });
            },
            handleAvatarSuccess(res, file) {
                this.imageUrl = URL.createObjectURL(file.raw);
            },
            handleImageHoverSuccess(res, file) {
                this.imageHover = URL.createObjectURL(file.raw);
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
            beforeImageHoverUpload(file) {
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
            async uploadFiles(req) {
                const formdata = new FormData();
                formdata.append('Filedata', req.raw);
                formdata.append('object_id', this.collectionId);
                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                };
                axios.post('/admin/ajax/collection/controller/imgUpload', formdata, config)
                    .then((res) => {
                        this.$store.dispatch('b/pushImages', res.data.data.image);
                    })
                    .catch((err) => {
                        console.log(err.message);
                    });
            },

        },
    };
</script>
