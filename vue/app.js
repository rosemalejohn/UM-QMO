import Vue from 'vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'

import Header from './components/Header.vue'
import Sidebar from './components/Sidebar.vue'
import Footer from './components/Footer.vue'
import Content from './components/Content.vue'

Vue.use(VueResource)
Vue.use(VueRouter)

Vue.component('app-header', Header)
Vue.component('app-sidebar', Sidebar)
Vue.component('app-footer', Footer)
Vue.component('app-content', Content)

// pages

import Dashboard from './components/pages/Dashboard.vue'

const routes = [
	{ path: '/', component: Dashboard }
]

const router = new VueRouter({
	routes
})

const app = new Vue({
  router
}).$mount('#app')