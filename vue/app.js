import Vue from 'vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'
import routes from './routes'

// Main components
import App from './App.vue'

import _ from 'lodash'
import filepicker from 'filepicker-js'


Vue.use(VueResource)
Vue.use(VueRouter)

Vue.http.options.root = '/api';
Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;

Vue.component('app', App)

filepicker.setKey('Ac9vyh2qlRFyU6Puvy687z');

window.router = new VueRouter(routes)																																																																																																																																																																																																																																																																																																						

const app = new Vue({
  router
}).$mount('#app')