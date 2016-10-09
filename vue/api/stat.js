import Vue from 'vue'

export default {

	GetTotalFilesUploaded () {
		return Vue.http.get('/api/files/count');
	},

	GetTotalUsers() {
		return Vue.http.get('/api/users/count');
	},

	GetTotalFilesUploadedByDate(date) {
		return Vue.http.get(`/api/files/count/${date}/by-date`);
	}

}