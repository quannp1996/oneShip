import moment from 'moment';
export default {
  methods: {
    format_date(value) {
      if (value) {
          return moment(value * 1000).format('MM/DD/YYYY hh:mm');
      }
  },
  }, // End method
}; // End class