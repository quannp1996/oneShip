export default {
    namespaced: true,
    state: {
        fileList: [],
        imageVarials: [],
        optionCanAddImg: [],
    },
    mutations: {
        deleteImageVarials(state, payloadData) {
            const unique = (value, index, self) => {
                return self.indexOf(value) === index;
            };
            state.imageVarials.forEach((element, index) => {
                element.forEach((items, indexItem) => {
                    if (items.name == payloadData.name) {
                        const data = state.imageVarials[index];
                        delete state.imageVarials[index][indexItem];
                        state.imageVarials[index] = data.filter(unique);
                        // state.imageVarials[index] = Object.assign([], state.imageVarials[index], state.imageVarials[index]);
                    }
                });
            });
            state.imageVarials = Object.assign([], state.imageVarials, state.imageVarials);
        },
        setFilelist(state, payloadData) {
             console.log(payloadData);
             console.log('dmmm');
            if(payloadData.length > 0){
                state.fileList = payloadData;
            }else{
                console.log(payloadData);
                state.fileList = Object.assign([], state.fileList , state.fileList );
            }

        },
        deleteFilelistByID(state, payloadData) {
            state.fileList.forEach((element, index) => {
                if (payloadData === element.id) {
                    state.fileList.splice(index, 1);
                }
            });
        },
        optionCanAddImg(state, payloadData) {
            state.optionCanAddImg = payloadData;
        },
        setImageVarials(state, payload) {
            state.imageVarials = payload;
        },
        setImageVarialsAdd(state, payload) {
            state.imageVarials = [];
        },
        imageVarials(state, payloadData) {
            console.log(payloadData);
            if (typeof state.imageVarials[payloadData[1]] === 'undefined') {
                state.imageVarials[payloadData[1]] = [];
            }
            const data = {
                name: payloadData[0],
                sort: payloadData[1],
            };
            state.imageVarials[payloadData[1]].push(data);
            state.imageVarials = Object.assign([], state.imageVarials, state.imageVarials);
        },
        setFilelistAddPrd(state, payloadData) {
            if (state.fileList.length == 0) {
                state.fileList = [];
            }
            state.fileList.push({
                img: payloadData.image,
                imglarge: payloadData.imglarge,
                object_id: '',
                type: payloadData.type,
                id: payloadData.id,
                created: payloadData.created,
            });
            // state.fileList = payloadData;
        },
        setFilelistAddPrdVarials(state, payloadData) {
            console.log(payloadData);
            if (state.imageVarials[payloadData[1]].length == 0) {
                state.imageVarials[payloadData[1]] = [];
            }
            state.imageVarials[payloadData[1]].push({
                img: payloadData[0],
            });
            // state.fileList = payloadData;
        },
    },
    actions: {
        setFilelist({commit}, content) {
            commit('setFilelist', content);
        },
        imageVarials({commit}, content) {
            commit('imageVarials', content);
        },
        setFilelistAddPrd({commit}, content) {
            commit('setFilelistAddPrd', content);
        },
        setFilelistAddPrdVarials({commit}, content) {
            commit('setFilelistAddPrdVarials', content);
        },
        setImageVarials({commit}, content) {
            commit('setImageVarials', content);
        },
        setImageVarialsAdd({commit}, content) {
            commit('setImageVarialsAdd', content);
        },
        optionCanAddImg({commit}, content) {
            commit('optionCanAddImg', content);
        },
        deleteImageVarials({commit}, content) {
            commit('deleteImageVarials', content);
        },
        deleteFilelistByID({commit}, content) {
            commit('deleteFilelistByID', content);
        },
    },
    getters: {},
};
