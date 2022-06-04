<template>
  <div id="collectionApp">
       <router-view></router-view>
  </div>
</template>
<script>
// import CollectionList from './CollectionList.vue'
export default {
  name: 'collectionApp',
  components: { },
  data() {
    return {
    };
  },
  computed: {
    // result () {
    //   return this.$store.state.result
    // }
  },
  mounted() {

  },

  methods: {
  },
}; // End class

</script>