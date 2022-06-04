export default {
  methods: {
    numberFormat(number) {
      return new Intl.NumberFormat('vi-VN', {
          style: 'currency',
          currency: 'VND',
      }).format(number);
  },
  }, // End method
}; // End class