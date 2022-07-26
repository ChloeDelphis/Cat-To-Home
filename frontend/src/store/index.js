import { createStore } from 'vuex'

export default createStore({
  state: {
    token: null,
    userId: null
  },
  getters: {
    getToken: (state) => {
      // Si le token n'existe pas dans le store
      if(state.token === null) {
        // Je le recupere depuis le sessionStorage
        state.token = sessionStorage.getItem('token');
      }
      return state.token;
    },

    getUserId : (state) => {
      // Si l'utilisateur n'existe pas dans le store
      if(state.userId === null) {
        // Je le recupere depuis le sessionStorage
        state.userId = sessionStorage.getItem('token');
      }
      return state.userId;
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
    },


     deleteUserId: (state) => {
      state.userId = null;
      sessionStorage.removeItem('userId');
    },
    // On va recuperer l'id de connexion
    // Le stocker dans sessionStorage et faire
    // La liaison avec le store vueX
    setUserId: (state, newUser) => {
      sessionStorage.setItem('userId', newUser);
      state.userId = sessionStorage.getItem('userId');
    }
  },
  actions: {
  },
  modules: {
  }
})
