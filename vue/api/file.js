import Vue from 'vue'

export default {

	GetAll() {
		return Vue.http.get('/files');
	},

	GetByDepartment(department) {
		return Vue.http.get(`/files/${department.id}/by-department`);
	},

	GetByCategory(category) {
		return Vue.http.get(`/files/${category.id}/by-category`);
	},

	Add(file) {
		return Vue.http.post('/files', file);
	},

	Update(file) {
		return Vue.http.put(`/files/${file.id}`, file);
	},

	Delete(file) {
		return Vue.http.delete(`/files/${file.id}`);
	},

	Search(search) {
		return Vue.http.get(`/files/${search}/by-search`);
	}

}