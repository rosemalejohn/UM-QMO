import Dashboard from './components/pages/Dashboard.vue'
import AccountForm from './components/pages/AccountForm.vue'
import Files from './components/pages/Files.vue'
import DepartmentFiles from './components/pages/DepartmentFiles.vue'
import Accounts from './components/pages/Users.vue'
import ViewAccount from './components/pages/ViewAccount.vue'
import Profile from './components/pages/ViewAccount.vue'
import Departments from './components/pages/Departments.vue'
import DepartmentForm from './components/pages/DepartmentForm.vue'
import Report from './components/pages/Report.vue'
import Requests from './components/pages/Requests.vue'
import ChangePasswordForm from './components/pages/ChangePasswordForm.vue'
import Error404 from './components/errors/404.vue'
import ViewFile from './components/pages/ViewFile.vue'
import Memos from './components/pages/Memos.vue'
import UploadResources from './components/forms/FilesUpload.vue'
import ViewCategory from './components/pages/ViewCategory.vue'

export default {

	mode: 'history',

	routes: [
		{ path: '/', name: 'Dashboard', component: Dashboard },
		
		{ path: '/files', name: 'Files', component: Files },
		{ path: '/files/view', name: 'File viewer', component: ViewFile },
		{ path: '/files/resources', name: 'Upload resources', component: UploadResources },

		{ path: '/categories/:categoryId', name: 'Show category', component: ViewCategory},

		{ path: '/profile', name: 'Profile', component: Profile },

		{ path: '/accounts', name: 'Accounts', component: Accounts },
		{ path: '/accounts/new', name: 'Add new account', component: AccountForm },
		{ path: '/accounts/:userId', name: 'Show account', component: ViewAccount },
		{ path: '/accounts/:userId/edit', name: 'Edit account', component: AccountForm },

		{ path: '/departments', name: 'Departments', component: Departments },
		{ path: '/departments/new', name: 'Add new department', component: DepartmentForm },
		{ path: '/departments/:departmentId', name: 'Show department', component: Accounts },
		{ path: '/departments/:departmentId/files', name: 'Department files', component: DepartmentFiles },

		{ path: '/reports', name: 'Reports', component: Report },

		{ path: '/request', name: 'Request', component: Requests },

		{ path: '/change-password', name: 'Change password', component: ChangePasswordForm },

		{ path: '/memos', name: 'Memos', component: Memos },

		{ path: '*', 'name': 'Page not found', component: Error404 }


	]
	
}