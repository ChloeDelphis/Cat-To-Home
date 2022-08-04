import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://cat_to_home.local/wp-json/wp/v2',
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        // Cette syntaxe permet d'effectuer une requete qui necessite d'être connecté
        Authorization: 'Bearer ' + sessionStorage.getItem('token') + ''
    },
    timeout: 10000
});

export default {
    // permet de récupérer les chats favoris d'un utilisateur donné en utilisant son bearer token
    async findAll() {
        try {
            apiClient.defaults.headers.common['Authorization'] = '';
            const response = await apiClient.get("/users/favorites");
            return response.data;
        } catch (error) {
            return error.response.data
        }
    },

    // Permet d'ajouter un chat aux favoris
    async addToFavorites(params) {
        try {
            apiClient.defaults.headers.common['Authorization'] = '';
            const response = await apiClient.post('/users/favorites/add', params);
            return response.data
        } catch (error) {
            return error.response.data
        }
    },


    // Permet de retirer un chat des favoris
    async removeFromFavorites(data) {
        try {
            apiClient.defaults.headers.common['Authorization'] = '';
            // delete requests with a body need it to be set under a data key (and not params)
            const response = await apiClient.delete('/users/favorites/delete', {data});
            return response.data
        } catch (error) {
            return error.response.data
        }
    },
}
