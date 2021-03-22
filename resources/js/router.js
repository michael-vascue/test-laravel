// import dashboard from './dashboard/dashboard.vue'
// import newnew from './dashboard/newnew.vue';

// export const routes = [
//     { path: '/dashboard', component: dashboard, name: 'dashboard' },
//     { path: '/dashboard/new', component: newnew, name: 'newnew'},

// ];


module.exports = {
    routes: [
        { path: '/dashboard ', component: require('./dashboard/dashboard.vue').default},
        { path: '/dboard/new', component: require('./dashboard/newnew.vue').default},
    ]
} 