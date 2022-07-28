import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://cat_to_home.local/wp-json/wp/v2',
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        // Cette syntaxe permet d'effectuer une requete qui necessite d'être connecté
        // Authorization: 'Bearer ' + sessionStorage.getItem('token') + ''
    },
    timeout: 10000
});

export default {
    // permet de récupérer toutes les fiches adotpions de chats
    async findAll() {
        const response = await apiClient.get("/cat?_embed");
        return response.data;
    },
    
    async findAllByOrder(params) {
        try {
            const response = await apiClient.get('/cat?_embed&order=' + params);
            return response.data;
        } catch (error) {
            return error.response;
        }
    },

    // Permet de récupérer une fiche adoption de chat avec son ID
    async find(id) {
        try{
            const response = await apiClient.get("/cat/" + id + "?_embed");
            return response.data
        } catch(error) {
            return error.response.data
        }    
    },

    // Récupère les IDs des fiches en fonction de l'age mis en param
    async findAllByAge(param) {
        try{
            const response = await apiClient.get("/cat/filter/" + param);
            return response.data
        } catch(error) {
            return error.response.data
        }    
    },
    // Récupère les IDs des fiches en fonction de l'age mis en param
    async findAllByIds(param) {
        try{
            const response = await apiClient.get("/cat?_embed&include=" + param);
            return response.data
        } catch(error) {
            return error.response.data
        }    
    },

    async delete(id){
        try{
            const response = await apiClient.delete('/cat/' + id);
            return response.data
        } catch(error) {
            return error.response.data
        }
    },

    async update(id){
        try{
            const response = await apiClient.post('/cat/' + id);
            return response.data
        } catch(error) {
            return error.response.data
        }
    },

    async findByOwnerId(id) {
        try{
            const response = await apiClient.get('/cat?_embed&author=' + id);
            return response.data
        } catch(error) {
            return error.response.data
        }
    }
}