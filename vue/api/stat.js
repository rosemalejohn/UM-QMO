import Vue from 'vue'

export default {

	GetTotalFilesUploaded () {
		return Vue.http.get('/api/files/count');
	},

	GetTotalUsers() {
		return Vue.http.get('/api/users/count');
	},

	GetTotalDepartments() {
		return Vue.http.get('/api/departments/count');
	},

	GetTotalFilesUploadedByDate(date) {
		return Vue.http.get(`/api/files/count/${date}/by-date`);
	},

	GetTotalFilesUploadedByMonth(year) {
		return Vue.http.get(`/api/files/graph-uploaded-yearly/${year}`);
	},

	GetTotalMemos() {
		return Vue.http.get('/api/memos/count');
	}

}