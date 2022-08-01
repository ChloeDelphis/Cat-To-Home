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

export default{
    // permet de récupérer les chats favoris d'un utilisateur donné en utilisant son bearer token
    async findAll(){
        try{
            const response = await apiClient.get("/users/favorites");
            return response.data;
        } catch (error){
            return error.response.data
        }
    },
}
