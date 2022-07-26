import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    meta : {title: 'Accueil'}
  },
  {
    path: '/cat/add',
    name: 'cat_add',
    component: () => import(/* webpackChunkName: "cat_add" */ '../views/CatAddView.vue'),
    meta : {title: 'Creation d\'une fiche d\'adoption'}
  },
  {
    path: '/cats',
    name: 'cats',
    component: () => import(/* webpackChunkName: "cats" */ '../views/CatListView.vue'),
    meta : {title: 'Liste des chats'}
  },
  {
    path: '/cat/:id?',
    name: 'cat',
    component: () => import(/* webpackChunkName: "cat" */ '../views/CatDetailView.vue'),
    meta : {title: 'Détail de la fiche'}
  },
  {
    path: '/registration',
    name: 'registration',
    component: () => import(/* webpackChunkName: "registration" */ '../views/RegistrationView.vue'),
    meta : {title: 'Inscription'}
  },
  {
    path: '/login',
    name: 'login',
    component: () => import(/* webpackChunkName: "login" */ '../views/ConnexionView.vue'),
    meta : {title: 'Connexion'}
  },
{
    path: '/404',
    name: '404',
    component: () => import(/* webpackChunkName: "404" */ '../views/Error404View.vue'),
    meta : {title: 'NotFound'}
  },
  {
    path: '/legals-mention',
    name: 'legals-mention',
    component: () => import(/* webpackChunkName: "login" */ '../views/LegalMentionView.vue'),
    meta : {title: 'MentionsLegales'}
  },
   {
    path: '/contact',
    name: 'contact',
    component: () => import(/* webpackChunkName: "login" */ '../views/ContactView.vue'),
    // meta : {title: 'Contact'}
  },

  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
    path: '/profile',
    name: 'profile',
    // route level code-splitting
    // this generates a separate chunk (profile.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "profile" */ '../views/ProfileView.vue')
  },

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

const DEFAULT_TITLE = 'Cat to home';
router.beforeEach((to, from, next) => {
  document.title = to.meta.title ?? DEFAULT_TITLE;
  next();
});

export default router
