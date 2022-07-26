import axios from 'axios';

const instance = axios.create({
    baseURL: 'http://cat_to_home.local/wp-json/wp/v2',
    Headers: {
        Accept: 'application/json', 
        'Content-Type': 'application/json' 
    }
  });

export default {
    // permet de récupérer toutes les locations
    async findAll() {
        const response = await instance.get("/location");
        return response.data;
    },

    async find(params) {
        try {
            const response = await instance.get('?nom=' + params);
            return response;
        } catch (error) {
            return error.response;
        }
    }
}
