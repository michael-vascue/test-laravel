// import VueRouter from 'vue-router';
// import Vue from 'vue'

import dashboard from './dashboard/dashboard.vue';
import login from './account/Login.vue'
import register from './account/Register.vue'
import gallery from './pages/IllustrationGallery.vue'
import createillus from './pages/CreateIllust.vue'
import profile from './pages/UserProfile.vue'

// Vue.router = router;
// Vue.use(VueRouter);

// const router = new VueRouter({
//     history:true,
//     mode: 'history',
//     routes,
// });

//Routes
export const routes = [
    { path: '/', component: dashboard, name: 'dashboard', meta: {auth: true}},
    { path: '/signin', component: login, name: 'login', meta: {auth: false}},
    { path: '/register', component: register, name: 'register', meta: {auth: false}},
    { path: '/gallery', component: gallery, name: 'gallery'},
    { path: '/createillus', component: createillus, name: 'createillus'},
    { path: '/profile', component: profile, name: 'profile' },

    // Default Path
    { path: '*', redirect: '/' }

];







// module.exports = {
//     routes: [
//         { path: '/dashboard ', component: require('./dashboard/dashboard.vue').default},
//         { path: '/signup', component: require('./account/SignUp.vue').default},
    
//     ]
// } 