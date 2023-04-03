import { createRouter, createWebHistory } from "vue-router";

import CheckoutPage from '../components/pages/CheckoutPage.vue';
import SuccessPage from '../components/pages/SuccessPage.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: CheckoutPage
    },
    {
        path: '/success',
        name: 'success',
        component: SuccessPage
    }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

export default router;
