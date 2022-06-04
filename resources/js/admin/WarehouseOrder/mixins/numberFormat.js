export default {
  methods: {
    numberFormat(number) {
      return new Intl.NumberFormat('vi-VN').format(number);
  },
  }, // End method
}; // End class