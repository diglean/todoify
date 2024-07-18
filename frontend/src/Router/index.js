import { createMemoryHistory, createRouter, createWebHistory } from 'vue-router'

import Login from '../Pages/Login.vue'
import LandingPage from '../Pages/LandingPage.vue'
import Register from '../Pages/Register.vue'
import Profile from '../Pages/Profile.vue'
import NewTask from '../Pages/NewTask.vue'
import ListTasks from '../Pages/ListTasks.vue'

import { useAuth } from '@/stores/auth'
import ListUsers from '@/Pages/ListUsers.vue'

const routes = [
  { path: '/', name: 'landingPage', component: LandingPage },
  { path: '/login', name: 'login', component: Login },
  { path: '/register', name: 'register', component: Register },
  { path: '/profile', name: 'profile', component: Profile, meta: { auth: true } },
  { path: '/new-task', name: 'newTask', component: NewTask },
  { path: '/list-tasks', name: 'listTasks', component: ListTasks, meta: { auth: true } },
  { path: '/list-users', name: 'listUsers', component: ListUsers, meta: { auth: true } },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach(async (to, from, next) => {
  if (to.meta?.auth) {
    const auth = useAuth();

    if (auth.token && auth.user) {
      const isAuthenticated = await auth.checkToken();

      if (isAuthenticated) {
        next();
      } else {
        next({ name: 'login' });
      }
    } else {
      next({ name: 'login' });
    }
  } else {
    next();
  }
})

export default router;
