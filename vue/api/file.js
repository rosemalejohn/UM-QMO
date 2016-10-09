import Vue from 'vue'

export default {

	GetAll() {
		return Vue.http.get('/files');
	},

	GetByDepartment(department) {
		return Vue.http.get(`/departments/${department.id}/files`);
	},

	GetByCategory(category) {
		return Vue.http.get(`/categories/${category.id}/files`);
	},

	Add(file) {
		return Vue.http.post('/files', file);
	},

	AddFiles(files) {
		return Vue.http.post('/files/upload-multiple', files);
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