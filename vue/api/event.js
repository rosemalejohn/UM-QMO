import Vue from 'vue'

export default {

	GetAll() {
		return Vue.http.get('/api/files');
	},

	Add(event) {
		return Vue.http.post('/api/events', event);
	},
	
	getEvents(){
		return Vue.http.get('/api/events');
	}

}