import { createRouter, createWebHistory } from 'vue-router';
import Main from '../components/Main.vue';

import Gallery from '../components/Gallery.vue';

const routes = [
  {
    path: '/',
    name: 'Main',
    component: Main,
  },
  {
    path: '/Gallery',
    name: 'Gallery',
    component: Gallery,
  },
];

const router = createRouter({
  history: createWebHistory('/'),
  routes,
});

export default router;