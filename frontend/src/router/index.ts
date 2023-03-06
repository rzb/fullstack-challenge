import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import UsersIndexView from '../views/Users/IndexView.vue';
import UsersShowView from '../views/Users/ShowView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/users",
      name: "user-index",
      component: UsersIndexView,
    },
    {
      path: "/users/:id",
      name: "user-show",
      component: UsersShowView,
    }
  ],
});

export default router;
