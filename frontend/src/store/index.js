import { createStore } from 'vuex'

export default createStore({
  state: {
    token: null,
    userId: null,
    role: null
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
        state.userId = sessionStorage.getItem('userId');
      }
      return state.userId;
    },
    getRole: (state) => {

      if(state.role === null) {
        state.role = sessionStorage.getItem('role');
      }
      return state.role;
    }
  },
  mutations: {
    deleteToken: (state) => {
      state.token = null;
      sessionStorage.removeItem('token');
    },
    deleteRole: (state) => {
      state.role = null;
      sessionStorage.removeItem('role');
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
    },
    setRole: (state, newRole) => {
      sessionStorage.setItem('role', newRole);
      state.role = sessionStorage.getItem('role');
    }
  },
  actions: {
    deleteUser({commit}) {
      commit('deleteUserId');
      commit('deleteToken');
      commit('deleteRole');
    },
    createUser({commit, token, userId, role}) {
      commit('setToken', token);
      commit('setUserId', userId);
      commit('setRole', role);
    }
  },
  modules: {
  }
})
