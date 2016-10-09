import Vue from 'vue'
import VueResource from 'vue-resource'
import VueRouter from 'vue-router'
import routes from './routes'

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

const router = new VueRouter(routes)																																																																																																																																																																																																																																																																																																						

const app = new Vue({
  router
}).$mount('#app')