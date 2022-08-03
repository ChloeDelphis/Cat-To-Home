import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://cat_to_home.local/wp-json/wp/v2',
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
    },
    timeout: 10000
});

export default {
    async send(params) {
        try {
            const response = await apiClient.post('/users/send/contact', params);
            return response.data;
        } catch (error) {
            return error.response.data;
        }
    }
}