import App from './App.vue';
import Vue from 'vue';
import VueRouter from 'vue-router';
import { routes } from './router.js';
import vmodal from 'vue-js-modal';

require('./bootstrap');

Vue.use(VueRouter);
Vue.use(vmodal);

const router = new VueRouter({ 
    mode: 'history',
    routes 
});



// window.Vue = require('vue').default;

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


//components
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navigation-bar', require('./components/NavigationBar.vue').default);

Vue.component('dashboard', require('./dashboard/dashboard.vue').default);
// Vue.component('login', require('./account/Login.vue').default);
// Vue.component('')


// const app = new Vue({
//     el: '#app',
//     router,
// });

window.Vue = new Vue({
    el: '#app',
    router,
    render: h => h(App),
})
