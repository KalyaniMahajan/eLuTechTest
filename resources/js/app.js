/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App.vue';
Vue.use(VueAxios, axios);

import HomeComponent from './components/Home.vue';
import CreateComponent from './components/Add.vue';
import IndexComponent from './components/Index.vue';
import EditComponent from './components/Edit.vue';
import RegisterComponent from './components/Auth/Register.vue';
import LoginComponent from './components/Auth/Login.vue';

const auth = (to, from, next) => {
    if (localStorage.getItem("auth")) {
      return next();
    } else {
      return next("/login");
    }
  };
  
const routes = [
    {
        name: 'home',
        path: '/',
        component: HomeComponent,
    },
    {
        name: 'login',
        path: '/login',
        component: LoginComponent
    },
    {
        name: 'register',
        path: '/register',
        component: RegisterComponent
    },
    {
      name: 'create',
      path: '/create',
      component: CreateComponent,
      beforeEnter: auth,
    },
    {
        name: 'posts',
        path: '/posts',
        component: IndexComponent,
        beforeEnter: auth,
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditComponent,
        beforeEnter: auth,
    }
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');