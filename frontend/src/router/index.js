import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import store from '../store/index.js'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    meta : {title: 'Accueil'}
  },
  {
    path: '/chat/ajout',
    name: 'cat_add',
    component: () => import(/* webpackChunkName: "cat_add" */ '../views/CatAddView.vue'),
    meta : {title: 'Creation d\'une fiche d\'adoption'}
  },
  {
    path: '/cats/:ordre?/:localisation?/:age?',
    name: 'cats',
    component: () => import(/* webpackChunkName: "cats" */ '../views/CatListView.vue'),
    meta : {title: 'Liste des chats'}
  },
  {
    path: '/chat/:id?',
    name: 'cat',
    component: () => import(/* webpackChunkName: "cat" */ '../views/CatDetailView.vue'),
    meta : {title: 'Détail de la fiche'}
  },
  {
    path: '/inscription',
    name: 'registration',
    component: () => import(/* webpackChunkName: "registration" */ '../views/RegistrationView.vue'),
    meta : {title: 'Inscription'}
  },
  {
    path: '/connexion',
    name: 'login',
    component: () => import(/* webpackChunkName: "login" */ '../views/LoginView.vue'),
    meta : {title: 'Connexion'}
  },
  {
    path: '/reinitialisation-mot-de-passe',
    name: 'reinitPassword',
    component: () => import(/* webpackChunkName: "reinitPassword" */ '../views/ReinitPassView.vue'),
    meta : {title: 'Réinitialisation du mot de passe'}
  },
{
    path: '/:pathMatch(.*)*',
    name: '404',
    component: () => import(/* webpackChunkName: "404" */ '../views/Error404View.vue'),
    meta : {title: 'Non trouvé'}
  },
  {
    path: '/403',
    name: '403',
    component: () => import(/* webpackChunkName: "403" */ '../views/Error403View.vue'),
    meta : {title: 'Non autorisé'}
  },
  {
    path: '/mentions-legales',
    name: 'legals-mention',
    component: () => import(/* webpackChunkName: "login" */ '../views/LegalMentionView.vue'),
    meta : {title: 'MentionsLegales'}
  },
   {
    path: '/contact',
    name: 'contact',
    component: () => import(/* webpackChunkName: "login" */ '../views/ContactView.vue'),
    meta : {title: 'Contact'}
  },

  {
    path: '/a-propos',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue'),
    meta : {title: 'A propos'}

  },
  {
    path: '/profil/:id?',
    name: 'profile',
    // route level code-splitting
    // this generates a separate chunk (profile.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "profile" */ '../views/ProfileView.vue'),
 meta : {title: 'Detail du profil'}
  },

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  scrollBehavior () {
    return {top: null, behavior: 'smooth' }
  }
})

const DEFAULT_TITLE = 'Cat to home';
router.beforeEach((to, from, next) => {
  document.title = to.meta.title ?? DEFAULT_TITLE;
  next();
  // En tant que non connecté je n'accède pas à un profile spécifique
  if(to.name === 'profile' && store.getters.getToken == null ) {
    // console.log('ici')
    router.push({ name: "403" });
  }
  // En tant que connecté je n'accède pas à un profile autre que le mien
  if(to.name === 'profile' && to.params.id !== store.getters.getUserId ) {
    // console.log('ici')
    router.push({ name: "403" });
  }
   // En tant que non connecté je n'accède pas à un profile spécifique
  if(to.name === 'cat_add' && store.getters.getToken == null ) {
    // console.log('ici')
    router.push({ name: "403" });
  }
    
});


export default router
