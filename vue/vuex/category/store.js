import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
	id: 0,
	name: '',
	created_at: '',
	updated_at: ''
}

const mutations = {

}

export default new Vuex.store({
	state,
	mutations
})