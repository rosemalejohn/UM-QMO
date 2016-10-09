import Vue from 'vue'

export default {

	GetAll() {
		return Vue.http.get('/api/categories');
	},

	GetFiles(category) {
		return Vue.http.get(`/api/categories/${category.id}/files`);
	},

	Add(category) {
		return Vue.http.post('/api/categories', category);
	},

	Update(category) {
		return Vue.http.put(`/api/categories/${category.id}`, category);
	},

	Delete(category) {
		return Vue.http.delete(`/api/categories/${category.id}`);
	}

}