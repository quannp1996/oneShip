export default {
  methods: {
    countBy(data) {
      return data.reduce((arr, number) => {
        if (arr[number]) {
          arr[number] = arr[number] + 1;
        }else {
          arr[number] = 1;
        };

        return arr;
      }, {});
    }
  } // End method
} // End class
