import { createWebHistory, createRouter } from "vue-router";
import home from '../layouts/home.vue';
import login from '../components/login.vue'
import register from '../components/register.vue'
import forgotpassword from '../components/forgotpassword.vue'

const routes = [
    {path : '/', name : 'Home', component : home },
    {path : '/login', name : 'Login', component : login},
    {path : '/register', name : 'Register', component : register},
    {path : '/forgotpassword', name : 'ForgotPassword', component : forgotpassword},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;