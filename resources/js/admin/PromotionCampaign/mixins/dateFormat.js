import moment from 'moment';
export default {
  methods: {
    format_date(value) {
      if (value) {
          return moment(value * 1000).format('YYYY-MM-DD HH:mm:ss');
      }
    },
  }, // End method
}; // End class