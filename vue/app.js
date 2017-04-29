import Vue from 'vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'
import VueFullCalendar from 'vue-full-calendar'
import routes from './routes'
import _ from 'lodash'
import filepicker from 'filepicker-js'
import Cookie from 'js-cookie'

import AppRoot from './components/AppRoot.vue'
import Header from './components/Header.vue'
import Sidebar from './components/Sidebar.vue'
import Footer from './components/Footer.vue'
import Content from './components/Content.vue'

Vue.use(VueResource)
Vue.use(VueRouter)
Vue.use(VueFullCalendar)

Vue.http.options.root = '/api';
Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;

Vue.component('app-root', AppRoot)
Vue.component('app-header', Header)
Vue.component('app-sidebar', Sidebar)
Vue.component('app-content', Content)
Vue.component('app-footer', Footer)

filepicker.setKey('AHkVcDwF6Q3yYcIB8JNDiz');

window.router = new VueRouter(routes)
window.cookie = Cookie;																																																																																																																																																																																																																																																																																														

const app = new Vue({
	router
}).$mount('#app')