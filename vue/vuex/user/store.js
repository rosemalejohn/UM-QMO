import Vue from 'vue'
import Vuex from 'vuex'
import department from './../department/store'

Vue.use(Vuex)

const store = {
	id: 0,
	name: '',
	id_number: '',
	gender: 'male',
	position: '',
	department,
	photo_url: '',
	email: '',
	type: '',
	created_at: '',
	updated_at: ''
}

const mutations = {

}

export default new Vuex.store({
	state,
	mutations
})