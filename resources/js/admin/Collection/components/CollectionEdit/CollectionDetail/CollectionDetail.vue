<template>
    <el-form label-width="120px">
        <div>
            <el-form-item label="Trạng thái">
                <el-radio-group v-model="statusPick">
                    <el-radio-button label="1">Hiện</el-radio-button>
                    <el-radio-button label="0">Ẩn</el-radio-button>
                </el-radio-group>
            </el-form-item>
            <el-form-item label="Showroom">
                <el-radio-group v-model="showroomPick">
                    <el-radio-button label="1">Có</el-radio-button>
                    <el-radio-button label="0">Không</el-radio-button>
                </el-radio-group>
            </el-form-item>
            <el-form-item label="Thứ tự">
                <el-input v-model="sort_order"></el-input>
            </el-form-item>
        </div>
    </el-form>
</template>
<style lang="scss" scoped>
    .backgroundColor {
        width: 40px;
        height: 40px;
        float: left;
        border: black solid 1px;
    }
</style>
<script>
    import colorPicker from '@caohenghu/vue-colorpicker';

    export default {
        components: {colorPicker},
        data() {
            return {
                radio1: '',
                suckerCanvas: null,
                suckerArea: [],
                isSucking: false,
                color: '',
            };
        },
        computed: {
            goodPriceStatus: {
                set(value) {
                    this.$store.dispatch('b/setGoodPrice', value);
                },
                get() {
                    return this.$store.state.b.general.is_good_price;
                },
            },
            statusPick: {
                set(value) {
                    this.$store.dispatch('b/setStatus', value);
                },
                get() {
                    return this.$store.state.b.general.status;
                },
            },

            showroomPick: {
                set(value) {
                    this.$store.dispatch('b/setShowroom', value);
                },
                get() {
                    return this.$store.state.b.general.is_showroom;
                },
            },

            sort_order: {
                set(value) {
                    this.$store.dispatch('b/setSort_order', value);
                },
                get() {
                    return this.$store.state.b.general.sort_order;
                },
            },
            colorPk: {
                get() {
                    return this.$store.state.b.general.color;
                },
                set(value) {
                    this.color = value;
                    this.$store.dispatch('b/setColor', value);
                },
            },
        },
        methods: {
            changeColor(color) {
                this.$store.dispatch('b/setColor', color.hex);
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
            },
        },
    };
</script>
