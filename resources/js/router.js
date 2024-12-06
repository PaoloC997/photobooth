import Vue from 'vue'
import Router from 'vue-router'
import Fotos from './components/Fotos.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/fotos',
      name: 'fotos',
      component: Fotos
    }
  ]
})