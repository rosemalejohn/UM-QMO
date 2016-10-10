import Dashboard from './components/pages/Dashboard.vue'
import AccountForm from './components/pages/AccountForm.vue'
import Files from './components/pages/Files.vue'
import Accounts from './components/pages/Users.vue'
import ViewAccount from './components/pages/ViewAccount.vue'
import Departments from './components/pages/Departments.vue'
import DepartmentForm from './components/pages/DepartmentForm.vue'
import Error404 from './components/errors/404.vue'

export default {

	routes: [
		{ path: '/', name: 'Dashboard', component: Dashboard },
		
		{ path: '/files', name: 'Files', component: Files },

		{ path: '/accounts', name: 'Accounts', component: Accounts },
		{ path: '/accounts/new', name: 'Add new account', component: AccountForm },
		{ path: '/accounts/:userId', name: 'Show account', component: ViewAccount },
		{ path: '/accounts/:userId/edit', name: 'Edit account', component: AccountForm },

		{ path: '/departments', name: 'Departments', component: Departments },
		{ path: '/departments/new', name: 'Add new department', component: DepartmentForm },
		{ path: '/departments/:departmentId', name: 'Show department', component: Departments },
		{ path: '*', 'name': 'Page not found', component: Error404 }
	]
	
}