
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

import StaffIndex from './components/staff/index.vue';
import StaffCreate from './components/staff/create.vue';
import StaffEdit from './components/staff/edit.vue';

const routes = [

    {path: '/staff', component: StaffIndex, name: 'staffIndex'},
    {path: '/staff/create', component: StaffCreate, name: 'staffCreate'},
    {path: '/staff/:id/edit', component: StaffEdit, name: 'editStaff'},
    

]

const router = new VueRouter({ routes })

const app = new Vue({ router }).$mount('#app')