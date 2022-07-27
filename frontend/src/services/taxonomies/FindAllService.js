import axios from 'axios';

const instance = axios.create({
    baseURL: 'http://cat_to_home.local/wp-json/wp/v2',
    Headers: {
        Accept: 'application/json', 
        'Content-Type': 'application/json' 
    }
  });

export default {
    async findAllEnvironment() {
        try {
            const response = await instance.get("/environment");
            return response.data;
        } catch (error) {
            return error.response.data;
        }
    },
    async findAllSex() {
        try {
            const response = await instance.get("/sex");
            return response.data;
        } catch (error) {
            return error.response.data;
        }
    },
    async findAllVaccinate() {
        try {
            const response = await instance.get("/vaccinate");
            return response.data;
        } catch (error) {
            return error.response.data;
        }
    },
}