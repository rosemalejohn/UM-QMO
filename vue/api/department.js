import Vue from 'vue'

export default {

	GetAll() {
		return Vue.http.get('/departments');
	},

	GetFiles(department) {
		return Vue.http.get(`/departments/${department.id}/files`);
	},

	GetUsers(department) {
		return Vue.http.get(`/departments/${department.id}/users`);
	},

	Add(department) {
		return Vue.http.post('/departments', department);
	},

	Update(department) {
		return Vue.http.put(`/departments/${department.id}`, department);
	},

	Delete(department) {
		return Vue.http.delete(`/departments/${department.id}`);
	},

	DeleteMultiple(departments) {
		return Vue.http.delete(`/departments/delete-multiple`, departments);
	}

}