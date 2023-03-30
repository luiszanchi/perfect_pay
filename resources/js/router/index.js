import { createRouter, createWebHistory } from "vue-router";

import HelloTemplate from '../components/templates/HelloTemplate.vue';

const routes = [
    {
        path: '/',
        name: 'home',
        component: HelloTemplate
    }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

export default router;
