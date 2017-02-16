import Vue from 'vue'

export default {

	GetAll() {
		return Vue.http.get('/api/requests');
	},

	Get(requestId) {
		return Vue.http.get('/api/requests/'+requestId);
	},

	Update(request) {
		return Vue.http.put('/api/requests/'+request.id,request);
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