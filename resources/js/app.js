require('./bootstrap');

import 'es6-promise/auto';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';
import vmodal from 'vue-js-modal';
import Vue from 'vue';
import Vuex from 'vuex';
import { ValidationProvider} from 'vee-validate/dist/vee-validate.full.esm';
import { ValidationObserver} from 'vee-validate';
import { routes } from './router.js';
import storeData from './store';
import swal from 'sweetalert';
import {initialize} from './general';


// installation
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(vmodal);
// Vue.use(swal);


// Set Vue authentication
Vue.use(VueAxios, axios);
// axios.defaults.baseURL = 'http://localhost:8000/';
axios.defaults.baseURL = 'http://illusdream.test/'
// window.Promise = require('es6-promise').Promise;

const store = new Vuex.Store(storeData);
const Swal = swal;

const router = new VueRouter({ 
    mode: 'hash',
    routes 
});

window.axios = axios;
window.eventBus = new Vue({})


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


//vee-validation components
// Vue.component('ValidationProvider', ValidationProvider);
// Vue.component('ValidationObserver', ValidationObserver);

//components
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navigation-bar', require('./components/NavigationBar.vue').default);

Vue.component('dashboard', require('./dashboard/dashboard.vue').default);

initialize(store, router);

//Load Index
window.Vue = new Vue({
    el: '#app',
    store,
    Swal,
    router,
    render: h => h(App),
})
