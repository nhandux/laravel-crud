require('./bootstrap');
window.Vue = require('vue');

import App from '../asset/components/App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import VModal from 'vue-js-modal';
import Notifications from 'vue-notification';

Vue.use(VModal);
Vue.use(Notifications);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
