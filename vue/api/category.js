import Vue from 'vue'

export default {

	GetAll() {
		return Vue.http.get('/api/categories');
	},

	GetFiles(category_id) {
		return Vue.http.get(`/api/categories/${category_id}/files`);
	},

	Add(category) {
		return Vue.http.post('/api/categories', category);
	},

	Update(category) {
		return Vue.http.put(`/api/categories/${category.id}`, category);
	},

	Delete(category_id) {
		return Vue.http.delete(`/api/categories/${category_id}`);
	},

	AddFiles(category_id, fileArray) {
		return Vue.http.post(`/api/categories/${category_id}/files`, { fileArray });
	} 

}