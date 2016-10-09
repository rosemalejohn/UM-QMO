import Vue from 'vue'

export default {

	GetAll() {
		return Vue.http.get('/categories');
	},

	GetFiles(category) {
		return Vue.http.get(`/categories/${category.id}/files`);
	},

	Add(category) {
		return Vue.http.post('/categories', category);
	},

	Update(category) {
		return Vue.http.put(`/categories/${category.id}`, category);
	},

	Delete(category) {
		return Vue.http.delete(`/categories/${category.id}`);
	}

}