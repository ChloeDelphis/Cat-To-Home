import { createStore } from 'vuex'

export default createStore({
  state: {
    token: null
  },
  getters: {
    getToken: (state) => {
      // Si le token n'existe pas dans le store
      if(state.token === null) {
        // Je le recupere depuis le sessionStorage
        state.token = sessionStorage.getItem('token');
      }
      return state.token;
    }
  },
  mutations: {
    deleteToken: (state) => {
      state.token = null;
      sessionStorage.removeItem('token');
    },
    // On va recuperer le token de connexion
    // Le stocker dans sessionStorage et faire
    // La liaison avec le store vueX
    setToken: (state, newToken) => {
      sessionStorage.setItem('token', newToken);
      state.token = sessionStorage.getItem('token');
    }
  },
  actions: {
  },
  modules: {
  }
})
