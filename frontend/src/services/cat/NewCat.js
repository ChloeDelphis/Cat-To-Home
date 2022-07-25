import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://cat_to_home.local/wp-json/wp/v2',
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        // Cette syntaxe permet d'effectuer une requete qui necessite d'etre connecté
        //Authorization: 'Bearer ' + sessionStorage.getItem('token') + ''
    },
    timeout: 10000
});


export default {
    async create(params) {
        // On passe le token de connexion
        // apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
        try {
            const response = await apiClient.post('/cat', params);
            return response.data
        } catch(error) {
            return error.response.data
        }
    },
}