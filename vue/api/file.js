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

	AddFiles(fileArray) {
		return Vue.http.post('/api/files/upload-multiple', {fileArray});
	},

	Update(file) {
		return Vue.http.put(`/api/files/${file.id}`, file);
	},

	Delete(file) {
		return Vue.http.delete(`/api/files/${file.id}`);
	},

	DeleteMultiple(fileArray) {
		return Vue.http.post('/api/files/delete-multiple', {fileArray});
	},

	Search(search) {
		return Vue.http.get(`/api/files/${search}/by-search`);
	}

}