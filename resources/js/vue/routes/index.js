import { createWebHistory, createRouter } from "vue-router";
import home from '../layouts/home.vue';
    import login from '../components/login.vue';
    import register from '../components/register.vue';
    import forgotpassword from '../components/forgotpassword.vue';
    import respasstwostep from '../components/respasstwostep.vue';

import AdminHome from '../admin/home.vue';
    import allblogs from '../admin/allblogs.vue';
    import dashboard from '../admin/dashboard.vue';
    import addblog from '../admin/addblog.vue';
    import blogdetails from '../admin/blogdetails.vue';
const routes = [
    {path : '/', name : 'Home', component : home , meta : { requireAuth : false }},
    {path : '/login', name : 'Login', component : login, meta : { requireAuth : false }},
    {path : '/register', name : 'Register', component : register, meta : { requireAuth : false }},
    {path : '/forgotpassword', name : 'ForgotPassword', component : forgotpassword, meta : { requireAuth : false }},
    {path : '/respasstwostep', name : 'respasstwostep', component : respasstwostep, meta : { requireAuth : false }},
    
    {path : '/Home', name : 'AdminHome', component : AdminHome, meta : { requireAuth : true },
        children : [
            {name : 'dashboard',path:  'dashboard',component: dashboard},
            {name : 'allblogs',path:  'allblogs',component: allblogs,},
            {name : 'blogdetails', path: 'blogdetails/:slug', component: blogdetails},
            {name : 'addblog',path:  'addblog',component: addblog},
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to,from) => {
    if(to.meta.requireAuth && !localStorage.getItem('token')){
        return {name : 'Login'};
    } else if(to.meta.requireAuth == false && localStorage.getItem('token')) {
        return {name : 'AdminHome'};
    }
});
export default router;