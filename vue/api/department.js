import Vue from 'vue'

export default {

	GetAll() {
		return Vue.http.get('/api/departments');
	},

	GetFiles(department) {
		return Vue.http.get(`/api/departments/${department.id}/files`);
	},

	GetUsers(department) {
		return Vue.http.get(`/api/departments/${department.id}/users`);
	},

	Add(department) {
		return Vue.http.post('/api/departments', department);
	},

	Update(department) {
		return Vue.http.put(`/api/departments/${department.id}`, department);
	},

	Delete(department) {
		return Vue.http.delete(`/api/departments/${department.id}`);
	},

	DeleteMultiple(departments) {
		return Vue.http.post(`/api/departments/delete-multiple`, {departments});
	}

}