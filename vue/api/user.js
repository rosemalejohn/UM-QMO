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

	DeleteUsers(users) {
		return Vue.http.delete('/users/delete-multiple', users);
	}

}