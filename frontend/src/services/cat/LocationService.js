import axios from 'axios';

const instance = axios.create({
    baseURL: 'https://geo.api.gouv.fr/departements',
    Headers: {
        Accept: 'application/json', 
        'Content-Type': 'application/json' 
    }
  });

export default {
    async find(params) {
        try {
            const response = await instance.get('?nom=' + params);
            return response.data;
        } catch (error) {
            return error.response;
        }
    }
}
