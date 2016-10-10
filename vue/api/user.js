import Vue from 'vue'

export default {

	Logout() {
		return Vue.http.post('/logout');
	},

	GetAll() {
		return Vue.http.get('/api/users');
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
		return Vue.http.delete('/api/users/delete-multiple', users);
	},

	UpdatePassword(user_id, data) {
		return Vue.http.put(`/api/users/${user_id}`, data);
	}

}