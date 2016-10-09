import Vue from 'vue'

export default {

	GetTotalFilesUploaded () {
		return Vue.http.get('/files/count');
	},

	GetTotalUsers() {
		return Vue.http.get('/users/count');
	},

	GetTotalFilesUploadedByDate(date) {
		return Vue.http.get(`/files/count/${date}/by-date`);
	}

}