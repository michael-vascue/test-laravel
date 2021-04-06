// import VueRouter from 'vue-router';
// import Vue from 'vue'

import dashboard from './dashboard/dashboard.vue';
import login from './account/Login.vue'
import register from './account/Register.vue'


// Vue.router = router;
// Vue.use(VueRouter);

// const router = new VueRouter({
//     history:true,
//     mode: 'history',
//     routes,
// });

//Routes
export const routes = [
    { path: '/dashboard', component: dashboard, name: 'dashboard', meta: {auth: true}},
    { path: '/signin', component: login, name: 'login', meta: {auth: false}},
    { path: '/register', component: register, name: 'register', meta: {auth: false}},

    // Default Path
    { path: '*', redirect: '/dashboard' }

];







// module.exports = {
//     routes: [
//         { path: '/dashboard ', component: require('./dashboard/dashboard.vue').default},
//         { path: '/signup', component: require('./account/SignUp.vue').default},
    
//     ]
// } 