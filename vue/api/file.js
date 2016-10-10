import Vue from 'vue'

export default {

	GetAll() {
		return Vue.http.get('/api/files');
	},

	GetByDepartment(department) {
		return Vue.http.get(`/api/departments/${department.id}/files`);
	},

	GetByCategory(category) {
		return Vue.http.get(`/api/categories/${category.id}/files`);
	},

	Add(file) {
		return Vue.http.post('/api/files', file);
	},

	AddFiles(files) {
		return Vue.http.post('/api/files/upload-multiple', files);
	},

	Update(file) {
		return Vue.http.put(`/api/files/${file.id}`, file);
	},

	Delete(file) {
		return Vue.http.delete(`/api/files/${file.id}`);
	},

	Search(search) {
		return Vue.http.get(`/api/files/${search}/by-search`);
	}

}