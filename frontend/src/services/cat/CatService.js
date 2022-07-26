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
    // permet de créer un nouvel utlisateur
    async findAll() {
        const response = await apiClient.get("/cat?_embed");
        return response.data;
    },
    
    async findAllBy(params) {
        try {
            const response = await apiClient.get('/cat?_embedaorder=' + params);
            return response.data;
        } catch (error) {
            return error.response;
        }
    }
}