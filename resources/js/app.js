import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import Navigation from './components/Navigation.vue'
import { routes } from './routes.js';
import Home from './components/Home.vue';
const router = createRouter({
    history: createWebHistory(),
    routes: routes
});
const app = createApp(Home);
app.use(router);
app.component('navigation',Navigation);
app.use(VueAxios, axios);
app.mount('#app');