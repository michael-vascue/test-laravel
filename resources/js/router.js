import VueRouter from 'vue-router';
import Vue from 'vue'

import dashboard from './dashboard/dashboard.vue'
import login from './account/Login.vue'

Vue.use(VueRouter);

// export const routes = [
//     { path: '/dashboard', component: dashboard, name: 'dashboard' },
//     { path: '/dashboard/new', component: newnew, name: 'newnew'},

// ];

export const routes = [
    { path: '/dashboard', component: dashboard, name: 'dashboard'},
    // { path: '/dashboard/new', component: newnew, name: 'newnew'},
    { path: '/signin', component: login, name: 'login'},

    // Default Path

    { path: '*', redirect: '/dashboard' }

];

const router = new VueRouter({
    routes
})

// export default router;

// module.exports = {
//     routes: [
//         { path: '/dashboard ', component: require('./dashboard/dashboard.vue').default},
//         { path: '/signup', component: require('./account/SignUp.vue').default},
    
//     ]
// } 