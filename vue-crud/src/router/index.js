import { createRouter, createWebHistory } from 'vue-router'
import SongView from '../views/Songs/View.vue'
import SongCreate from '../views/Songs/Create.vue'
import SongEdit from '../views/Songs/Edit.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/songs',
      name: 'songs',
      component: SongView
    },
    {
      path: '/songs/create',
      name: 'songCreate',
      component: SongCreate
    },
    {
      path: '/songs/:id/edit',
      name: 'songEdit',
      component: SongEdit
    },
  ]
})

export default router
