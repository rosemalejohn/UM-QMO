import Vue from 'vue'

export default {

	Logout() {
		return Vue.http.post('/logout');
	},

	GetAll() {
		return Vue.http.get('/users');
	},

	AddUser() {
		return Vue.http.post('/users', user);
	},

	UpdateUser(user) {
		return Vue.http.put(`/users/${user.id}`, user);
	},

	DeleteUser(user) {
		return Vue.http.delete(`/users/${user.id}`);
	},

	DeleteMultiple(users) {
		return Vue.http.delete('/users/delete-multiple', users);
	},

	UpdatePassword(user_id, data) {
		return Vue.http.put(`/users/${user_id}`, data);
	}

}