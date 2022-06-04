export default {
  methods: {
    showMessage(message='', type='', duration=10000) {
      return this.$message({
        showClose: true,
        message: message,
        type: type,
        duration: duration,
        dangerouslyUseHTMLString: true,
      });
    },
  }, // End method
}; // End class
