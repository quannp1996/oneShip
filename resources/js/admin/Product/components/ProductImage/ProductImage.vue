<template>
    <div>
        <div>
            <h2>Ảnh slider</h2>
            <el-upload
                action=""
                ref="upload"
                list-type="picture-card"
                :auto-upload="false"
                :on-change="uploadFiles"
                :file-list="fileListVIP"
                multiple
            >
                <i slot="default" class="el-icon-plus"></i>
                <div slot="file" slot-scope="{ file }">
                    <img
                        class="el-upload-list__item-thumbnail"
                        :src="herf + '/upload/' + type + '/thumb_350x0/' + file.img"
                        alt=""
                    />
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
                @click="handleRemove(file)"
            >
              <i class="el-icon-delete"></i>
            </span>
          </span>
                </div>
            </el-upload>
            <br>
            <el-dialog :visible.sync="dialogVisible">
                <img width="100%" :src="dialogImageUrl" alt=""/>
            </el-dialog>
        </div>
        <hr>
        <div>
            <h2>Bản thiết kế</h2>
            <el-upload
                action="#"
                :auto-upload="false"
                class="avatar-uploader"
                :show-file-list="false"
                :on-change="uploadFilesImageDesignProduct"
                :before-upload="beforeAvatarUpload"
            >
                <img
                    v-if="imageDesignUrl"
                    :src="herf + '/upload/' + type + '/thumb_350x0/' + imageDesignUrl"
                    class="avatar"
                />

                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
            </el-upload>
            <el-button
                type="danger"
                icon="el-icon-delete"
                circle
                @click="clearImageDesign"
            ></el-button>
        </div>
        <hr>
        <div>
            <h2>Ảnh đại diện</h2>
            <el-upload
                action="#"
                :auto-upload="false"
                class="avatar-uploader"
                :show-file-list="false"
                :on-change="uploadFilesImageProduct"
                :before-upload="beforeAvatarUpload"
            >
                <img
                    v-if="imageUrl"
                    :src="herf + '/upload/' + type + '/thumb_350x0/' + imageUrl"
                    class="avatar"
                />
                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
            </el-upload>

            <el-button
                type="danger"
                icon="el-icon-delete"
                circle
                @click="clearImage"
            ></el-button>
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
            <span slot="footer" class="dialog-footer">
        <el-button @click="dialogEditVisible = false">Cancel</el-button>
        <el-button type="primary" @click="handleUpdateImage">Lưu</el-button>
      </span>
        </el-dialog>
    </div>
</template>
<style>
    @import "../../css/imageUpload.css";
</style>
<script>
    import api from '../../helpers/api';
    import axios from 'axios';

    export default {
        data() {
            return {
                editImage: {},
                dialogEditVisible: false,
                dialogImageUrl: '',
                dialogVisible: false,
                disabled: false,
                attachments: [],
                fileList: [],
                productId: Number(window.product_id),
                herf: window.location.origin,
                type: 'product',
            };
        },
        mounted() {
            this.productImgByID();
        },
        computed: {
            imageUrl() {
                return this.$store.state.b.content.image;
            },
            imageDesignUrl() {
                return this.$store.state.b.content.image_design;
            },
            fileListVIP() {
                return this.$store.state.c.fileList;
            },
        },
        methods: {
            change(file, fileList) {
                this.fileList = fileList;
            },
            handleAvatarSuccess(res, file) {
                // this.imageUrl = URL.createObjectURL(file.raw);
            },
            handleImageDesignSuccess(res, file) {
                // this.imageDesignUrl = URL.createObjectURL(file.raw);
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
            getAndSetData(content) {
                this.$store.dispatch('c/setFilelist', content);
            },
            handleRemove(file) {
                this.removeImg(file.id);
            },
            handlePictureCardPreview(file) {
                this.dialogImageUrl = file.image;
                this.dialogVisible = true;
            },
            handleEdit(file) {
                this.editImage = file;
                this.dialogEditVisible = true;
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
            clearImage() {
                this.$store.dispatch('b/setImg', '');
            },
            clearImageDesign() {
                this.$store.dispatch('b/setImgDesign', '');
            },
            async handleUpdateImage() {
                const editImage = this.editImage;
                const dataImg = this.$store.state.c.fileList;
                const url = 'admin/ajax/products/controller/itemImgUpdate';
                const products = await api.request('POST', url, {editImage});
                if (!products.data.error) {
                    dataImg.forEach((element, index) => {
                        if (element.id == products.data.data.id) {
                            this.$store.state.c.fileList[index].sort = products.data.data.sort;
                        }
                    });
                    this.openSuccess(products.data.msg);
                    this.dialogEditVisible = false;
                } else {
                    this.openError(products.data.msg);
                }
            },

            async uploadFilesImageProduct(req) {
                this.uploadImage(req, 'image');
            },

            async uploadFilesImageDesignProduct(req) {
                this.uploadImage(req, 'image_design');
            },
            async uploadImage(req, field){
                const formdata = new FormData();
                formdata.append('Filedata', req.raw);
                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .content,
                    },
                };
                await axios
                .post('/admin/ajax/products/controller/imgUpload', formdata, config)
                .then((res) => {
                    if (res.data.error == 1){
                        alert('File ảnh không đúng định dạng')
                    }else{
                        if (!res.data.data.error) {
                            if(field == 'image'){
                                this.$store.dispatch('b/setImg', res.data.data.fileName);
                                this.$store.dispatch(
                                    'b/setImgUrl',
                                    `${herf}/upload/product/original/${res.data.data.fileName}`,
                                );
                            }else{
                                this.$store.dispatch('b/setImgDesign', res.data.data.fileName);
                                this.$store.dispatch(
                                    'b/setImgDesignUrl',
                                    `${herf}/upload/product/original/${res.data.data.fileName}`,
                                );
                            }
                            
                        }
                    }
                })
                .catch((err) => {
                    console.log(err.msg);
                });
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
            async removeImg(imgId) {
                if (confirm('Bạn có chắc chắn muốn xóa? Thay đổi sẽ được lưu lại ngay')) {
                    const url = `admin/ajax/products/${this.productId}-${imgId}/controller/itemImgDel`;
                    const products = await api.request('GET', url);
                    if (!isNaN(this.productId)) {
                        console.log('test');
                        const file = [];
                        Array.from(products.data.data.images).forEach((child) => {
                            file.push({
                                name: child.img,
                                uid: child.id,
                                url: child.imglarge,
                            });
                        });
                        this.fileList = file;
                        this.getAndSetData(products.data.data.images);
                    } else {
                        this.$store.dispatch('c/deleteFilelistByID', imgId);
                    }
                }
            },
            async productImgByID() {
                const url = `admin/ajax/products/${this.productId}/controller/imgData`;
                const products = await api.request('GET', url);
                if (products) {
                    const file = [];

                        if (typeof products.data.data != 'undefined') {
                            this.$store.dispatch('c/setFilelist', products.data.data);
                            Array.from(products.data.data).forEach((child) => {
                                file.push({
                                    name: child.img,
                                    uid: child.id,
                                    url: child.imglarge,
                                    sort: child.sort,
                                    link: child.link,
                                    id: child.id,
                                });
                            });
                        }
                        this.fileList = file;

                    // this.getAndSetData(products.data.data);
                }
            },
            async uploadFiles(req) {
                const formdata = new FormData();
                formdata.append('Filedata', req.raw);
                formdata.append('object_id', this.productId);

                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .content,
                    },
                };
                axios
                    .post('/admin/ajax/products/controller/imgUpload', formdata, config)
                    .then((res) => {
                        if (res.data.error) {
                            this.$store.dispatch('c/setFilelist', []);
                        }
                        if (res.data.error == 1){
                            alert('File ảnh không đúng định dạng')
                        }else {
                            const file = [];
                            if (typeof res.data.data.images != 'undefined') {
                                this.$store.dispatch('c/setFilelist', res.data.data.images);
                                Array.from(res.data.data.images).forEach((child) => {
                                    file.push({
                                        name: child.img,
                                        uid: child.id,
                                        url: child.imglarge,
                                    });
                                });
                            } else {
                                this.$store.dispatch('c/setFilelistAddPrd', res.data.data.fileName);
                            }
                            this.fileList = file;
                            console.log('image upload succeed.');
                        }
                    })
                    .catch((err) => {
                        console.log(err.message);
                    });
            },
        },
    };
</script>
