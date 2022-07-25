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
    meta : {title: 'creation d\'une fiche d\'adoption'}
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
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
