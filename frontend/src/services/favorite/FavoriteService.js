import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://cat_to_home.local/wp-json/wp/v2',
    headers: {
        Accept: 'application/json',
<<<<<<< HEAD
        'Content-Type': 'application/json',
=======
        'Content-Type': 'application/json'
>>>>>>> master
    },
    timeout: 10000
});

export default {
    // permet de récupérer les chats favoris d'un utilisateur donné en utilisant son bearer token
    async findAll() {
        try {
<<<<<<< HEAD
            // On passe le token de connexion
            apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';            
=======
>>>>>>> master
            const response = await apiClient.get("/users/favorites");
            return response.data;
        } catch (error) {
            return error.response.data
        }
    },

    // Permet d'ajouter un chat aux favoris
    async addToFavorites(params) {
        try {
<<<<<<< HEAD
            apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
=======
>>>>>>> master
            const response = await apiClient.post('/users/favorites/add', params);
            return response.data
        } catch (error) {
            return error.response.data
        }
    },


    // Permet de retirer un chat des favoris
    async removeFromFavorites(data) {
        try {
<<<<<<< HEAD
            apiClient.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('token') + '';
=======
>>>>>>> master
            // delete requests with a body need it to be set under a data key (and not params)
            const response = await apiClient.delete('/users/favorites/delete', {data});
            return response.data
        } catch (error) {
            return error.response.data
        }
    },
}
