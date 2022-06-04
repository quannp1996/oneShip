import axios from 'axios';

export default {
  request(method='GET', endpoint='', payload='',contentType='application/json') {
    return axios({
      method: method,
      url: '/' + endpoint,
      data: payload,
      headers: {
        'Content-Type': contentType,
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    });
  }
} // End class
