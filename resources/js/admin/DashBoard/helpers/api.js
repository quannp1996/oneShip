import axios from 'axios';

export default {
  request(method='GET', endpoint='', payload='') {
    return axios({
      method: method,
      url: '/' + endpoint,
      data: payload,
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    });
  }
} // End class
