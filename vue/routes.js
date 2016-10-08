import Dashboard from './components/pages/Dashboard.vue'
import AccountForm from './components/pages/AccountForm.vue'
import Files from './components/pages/Files.vue'
import Accounts from './components/pages/Users.vue'
import Departments from './components/pages/Departments.vue'
import Error404 from './components/errors/404.vue'

export default {
	routes: [
		{ path: '/', name: 'Dashboard', component: Dashboard },
		{ path: '/accounts/new', name: 'Add new account', component: AccountForm },
		{ path: '/files', name: 'Files', component: Files },
		{ path: '/accounts', name: 'Accounts', component: Accounts },
		{ path: '/departments', name: 'Departments', component: Departments },
		{ path: '*', 'name': 'Page not found', component: Error404 }
	]
}