import Vue from 'vue'

export default {

	GetAll() {
		return Vue.http.get('/api/memos');
	},

	AddMemo(memo) {
		return Vue.http.post('/api/memos', memo);
	},

	UpdateMemo(memo) {
		return Vue.http.put(`/api/memos/${memo.id}`, memo);
	},

	DeleteMemo(memo) {
		return Vue.http.delete(`/api/memos/${memo.id}`);
	}

}