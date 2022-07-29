import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://cat_to_home.local/wp-json/wp/v2',
    headers: {
        Accept: 'application/json, image/*',
        'Content-Type': 'application/json',
        // Cette syntaxe permet d'effectuer une requete qui necessite d'etre connecté
        //Authorization: 'Bearer ' + sessionStorage.getItem('token') + ''
    },
    timeout: 10000
});


export default {
    async create(params) {
        // On passe le token de connexion
        apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
        try {
            const response = await apiClient.post('/cat', params);
            return response.data
        } catch(error) {
            return error.response.data
        }
    },
    async uploadPicture(id, name, params, file) {
        apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token');
        apiClient.defaults.headers.post['Content-Disposition'] = 'attachment; filename="' + name + '"';

        try {
            const response = await apiClient.post('/media?post=' + id, file, params);
            return response.data;
        } catch (error) {
            return error.response.data;
        }
    },
    async addFeaturedMedia(id, params) {
        try {
            apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token');
            const response = await apiClient.post('cat/'+ id, params);
            return response.data;
        } catch (error) {
            return error.response.data;
        }
    },
    async uploadLocation(id, params) {
        apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token');

        try {
            const response = await apiClient.post('/location?post=' + id, params);
            return response.data;
        } catch (error) {
            return error.response.data;
        }
    },
    async addLocation(id, params) {
        try {
            apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token');
            const response = await apiClient.post('cat/'+ id, params);
            return response.data;
        } catch (error) {
            return error.response.data;
        }
    },
}