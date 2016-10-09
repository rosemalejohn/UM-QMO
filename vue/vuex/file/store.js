import Vue from 'vue'
import Vuex from 'vuex'

import category from './../category/store'
import department from './../department/store'

Vue.use(Vuex)

const state = {
	id: 0,
	url: '',
	filename: '',
	mimetype: '',
	size: 0,
	category,
	department,
	created_at: null,
	updated_at: null
}

const mutations = {
	
}

export default new Vuex.store({
	state,
	mutations
});