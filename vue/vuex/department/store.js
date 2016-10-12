import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
Vue.config.debug = true

const state = {
	id: '',
	name: '',
	code: '',
	created_at: '',
	updated_at: ''
}

const mutations = {

}

export default new Vuex.store({
	state,
	mutations
})