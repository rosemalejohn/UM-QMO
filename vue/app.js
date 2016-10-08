import Vue from 'vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'

// Main components
import Header from './components/Header.vue'
import Sidebar from './components/Sidebar.vue'
import Footer from './components/Footer.vue'
import Content from './components/Content.vue'

Vue.use(VueResource)
Vue.use(VueRouter)

Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;

Vue.component('app-header', Header)
Vue.component('app-sidebar', Sidebar)
Vue.component('app-footer', Footer)
Vue.component('app-content', Content)

//pages 
import Dashboard from './components/pages/Dashboard.vue'
import AccountForm from './components/pages/AccountForm.vue'
import Files from './components/pages/Files.vue'
import Accounts from './components/pages/Users.vue'

const routes = [
	{ path: '/', name: 'dashboard', component: Dashboard },
	{ path: '/accounts/new', name: 'new-account', component: AccountForm },
	{ path: '/files', name: 'files', component: Files },
	{ path: '/accounts', name: 'accounts', component: Accounts },
]

const router = new VueRouter({
	routes
})																																																																																																																																																																																																																																																																																																						

const app = new Vue({
  router
}).$mount('#app')