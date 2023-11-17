import { createRouter, createWebHistory } from 'vue-router';
import CartPage from "../components/Cart/CartPage.vue";

const routes = [
  {
    path: '/',
    name: 'cart',
    component: CartPage,
    props: true, 
  },
  
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;