import dashboard from './dashboard/dashboard.vue'
import login from './account/Login.vue'
import register from './account/Register.vue'
import gallery from './pages/IllustrationGallery.vue'
import createillus from './pages/CreateIllust.vue'
import profile from './pages/UserProfile.vue'
import my_illust from './pages/MyIllustration.vue'

//Routes
export const routes = [
    { path: '/', component: dashboard, name: 'dashboard', meta: {auth: true}},
    { path: '/signin', component: login, name: 'login', meta: {auth: false}},
    { path: '/register', component: register, name: 'register', meta: {auth: false}},
    { path: '/gallery', component: gallery, name: 'gallery'},
    { path: '/createillus', component: createillus, name: 'createillus'},
    { path: '/profile', component: profile, name: 'profile' },
    { path: '/my_illust', component: my_illust, name: 'my_illust' },

    // Default Path
    { path: '*', redirect: '/' }

];







// module.exports = {
//     routes: [
//         { path: '/dashboard ', component: require('./dashboard/dashboard.vue').default},
//         { path: '/signup', component: require('./account/SignUp.vue').default},
    
//     ]
// } 