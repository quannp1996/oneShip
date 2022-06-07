const orderApp = new Vue({
    el: '#orderApp',
    data: {
        userId: null,
        sender: {},
        receiver: {},
        package: [{}],
        listSender: [],
        listReceiver: []
    },
    mounted: function(){
    },
    methods: {
        addNewPackge: function(){
            this.package.push({});
        },
        removePackage: function(key){
            console.log(key);
            this.package = this.package.splice(1, key);
        }
    }
})