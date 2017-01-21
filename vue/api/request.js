import Vue from 'vue'

export default {

	GetAll() {
		return Vue.http.get('/api/requests');
	},

	ApproveMultiple(requests) {
		return Vue.http.post('/api/requests/approve-multiple', {requests});
	},

	RejectMultiple(requests) {
		return Vue.http.post('/api/requests/reject-multiple', {requests});
	},

	getNewRequestCount(){
		return Vue.http.get('/api/requests/new-requests-count');
	}

}