import Vue from 'vue'

export default {

	GetAuthenticatedUser() {
		return Vue.http.get('/api/user');
	},

	Logout() {
		return Vue.http.post('/logout');
	},

	GetAll() {
		return Vue.http.get('/api/users');
	},

	Get(user_id) {
		return Vue.http.get(`/api/users/${user_id}`);
	},

	AddUser(user) {
		return Vue.http.post('/api/users', user);
	},

	UpdateUser(user) {
		return Vue.http.put(`/api/users/${user.id}`, user);
	},

	DeleteUser(user) {
		return Vue.http.delete(`/api/users/${user.id}`);
	},

	DeleteMultiple(users) {
		return Vue.http.post('/api/users/delete-multiple', {users});
	},

	UpdatePassword(data) {
		return Vue.http.put(`/api/users/update-password`, data);
	},

	GetFiles(user_id) {
		return Vue.http.get(`/api/users/${user_id}/files`);
	},

	ToggleCanUploadFiles(user_id){
		return Vue.http.patch(`/api/users/${user_id}/toggle-can-upload-files`);
	}

}